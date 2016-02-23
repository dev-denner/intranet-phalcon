<?php

/**
 * Description of Bootstrap
 *
 * @author DennerFernandes
 */
use Phalcon\Mvc\Application as Application;
use Phalcon\Loader as Loader;
use Phalcon\Flash\Session as Flash;
use Phalcon\Mvc\Url as Url;
use Phalcon\Mvc\Dispatcher as Dispatcher;
use Phalcon\Logger as Logger;
use Phalcon\Logger\Adapter\File as LoggerFile;
use Phalcon\Logger\Formatter\Line as LoggerFormatter;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Mvc\Model\Metadata\Files as MetadataFiles;
use Phalcon\Mvc\Model\Metadata\Memory as MetadataMemory;
use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Cache\Frontend\Data as CacheFront;
use Phalcon\Cache\Bachend\File as CacheBack;
use Phalcon\Security as Security;
use Phalcon\Mvc\Router as Router;
use Phalcon\Assets\Manager as AssetsManager;
use Phalcon\Crypt as Crypt;
use Phalcon\Http\Response\Cookies as Cookies;
use Phalcon\Db\Adapter\Pdo\Oracle as Oracle;
use Phalcon\Db\Adapter\Pdo\Mysql as Mysql;

class Bootstrap {

  private $_di;

  public function __construct($di) {
    $this->_di = $di;
  }

  public function run($options) {

    $loaders = array(
        'config',
        'loader',
        'environment',
        'timezone',
        'flash',
        'url',
        'dispatcher',
        'logger',
        'database',
        'session',
        'cache',
        'elements',
        'crypt',
        'cookies',
        'security',
        'router',
        'assets',
    );

    try {

      foreach ($loaders as $service) {
        $function = 'init' . ucfirst($service);

        $this->$function($options);
      }

      $application = new Application();

      $this->initModules($application);
      $this->initRouters($application);

      $application->setDI($this->_di);

      return $application->handle()->getContent();
    } catch (\Phalcon\Exception $e) {
      echo $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode();
      echo nl2br(htmlentities($e->getTraceAsString()));
    } catch (\PDOException $e) {
      echo $e->getMessage() . PHP_EOL . $e->getFile() . PHP_EOL . $e->getLine() . PHP_EOL . $e->getCode();
    }
  }

  protected function initConfig($options = array()) {
    $config = include APP_PATH . '/app/config/config.php';
    $databases = include APP_PATH . '/app/config/database.php';

    $this->_di->setShared('config', function() use ($config) {
      return $config;
    });

    $this->_di->setShared('databases', function() use ($databases) {
      return $databases;
    });
  }

  protected function initLoader($options = array()) {

    $config = $this->_di->get('config');

    $loader = new Loader();

    $loader->registerNamespaces(
            array(
                'System\Library' => __DIR__ . '/../library',
                'System\Forms' => __DIR__ . '/../forms',
                'System\Plugins' => __DIR__ . '/../plugins',
                'System\Helpers' => __DIR__ . '/../helpers',
            )
    );

    $loader->registerDirs(
            array(
                $config->application->pluginsDir,
                $config->application->libraryDir,
                $config->application->helpersDir,
                $config->application->formsDir,
            )
    );

    $loader->register();
  }

  protected function initEnvironment($options = array()) {

    $config = $this->_di->get('config');

    $environment = $config->application->environment != 'production' ? true : false;

    if ($environment) {
      ini_set('display_errors', true);
      error_reporting(E_ALL);
      $debug = new Phalcon\Debug();
      $debug->listen();
    } else {
      ini_set('display_errors', false);
      error_reporting(-1);
    }

    set_error_handler(array('\System\Plugins\Error', 'normal'));
    set_exception_handler(array('System\Plugins\Error', 'exception'));
    register_shutdown_function(array('System\Plugins\Error', 'shutdown'));
  }

  protected function initTimezone($options = array()) {

    $config = $this->_di->get('config');

    $timezone = (isset($config->application->timezone)) ? $config->application->timezone : 'America/Sao_Paulo';

    date_default_timezone_set($timezone);

    $this->_di->setShared('timezone_default', $timezone);
  }

  protected function initFlash($options = array()) {

    $this->_di->setShared('flash', function() {
      $params = array(
          'error' => 'alert alert-danger',
          'success' => 'alert alert-success',
          'notice' => 'alert alert-info',
          'warning' => 'alert alert-warning'
      );

      return new Flash($params);
    });
  }

  protected function initUrl($options = array()) {

    $config = $this->_di->get('config');

    $this->_di->setShared('url', function() use ($config) {
      $url = new Url();
      $url->setBaseUri($config->application->baseUri);

      return $url;
    });
  }

  protected function initDispatcher($options = array()) {

    $di = $this->_di;

    $this->_di->setShared('dispatcher', function() use ($di) {

      $eventsManager = new EventsManager();

      //$eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin());

      $eventsManager->attach('dispatch', new System\Plugins\NotFound());
      $dispatcher = new Dispatcher();
      $dispatcher->setEventsManager($eventsManager);
      $dispatcher->setDefaultNamespace('Nucleo');

      return $dispatcher;
    });
  }

  protected function initLogger($options = array()) {

    $config = $this->_di->get('config');

    $this->_di->setShared('logger', function() use ($config) {
      if (!file_exists($config->logger->file)) {
        mkdir($config->logger->file, 0777, true);
      }
      $logger = new LoggerFile($config->logger->file . date('Y-m-d') . '.log');
      $formatter = new LoggerFormatter($config->logger->format);
      $logger->setFormatter($formatter);

      return $logger;
    });

    $this->_di->setShared('loggerDb', function() use ($config) {
      if (!file_exists($config->logger->file . '/db/')) {
        mkdir($config->logger->file . '/db/', 0777, true);
      }
      $logger = new LoggerFile($config->logger->file . '/db/' . date('Y-m-d') . '.log');
      $formatter = new LoggerFormatter($config->logger->format);
      $logger->setFormatter($formatter);

      return $logger;
    });
  }

  protected function initDatabase($options = array()) {

    $config = $this->_di->get('config');
    $databases = $this->_di->get('databases');
    $logger = $this->_di->get('loggerDb');

    $environment = $config->application->environment != 'production' ? true : false;

    foreach ($databases->database as $key => $value) {

      $this->_di->setShared($key, function() use ($value, $logger, $environment) {

        if ($environment) {
          $eventsManager = new EventsManager();

          $eventsManager->attach('db', function($event, $connection) use($logger) {
            if ($event->getType() == 'beforeQuery') {
              $logger->log($connection->getSQLStatement(), Logger::INFO);
            }
          });
        }

        $params = array(
            'host' => $value->host,
            'username' => $value->username,
            'password' => $value->password,
            'dbname' => $value->dbname,
            'schema' => $value->schema,
            'options' => [PDO::ATTR_CASE => PDO::CASE_UPPER, PDO::ATTR_PERSISTENT => TRUE,],
        );

        switch ($value->adapter) {
          case 'Oracle':
            $conn = new Oracle($params);
            break;
          case 'Mysql':
            $conn = new Mysql($params);
            break;
        }

        if ($environment) {
          $conn->setEventsManager($eventsManager);
        }
        return $conn;
      });
    }

    $this->_di->setShared('modelsMetadata', function() use ($config) {

      if (isset($config->model->metadata->on) && $config->model->metadata->on) {
        if ($config->model->metadata->adapter == 'Files') {

          if (!file_exists($config->model->metadata->path)) {
            mkdir($config->model->metadata->path, 0777, true);
          }

          $modelsMetadata = new MetadataFiles(
                  array(
              'metaDataDir' => $config->model->metadata->path
                  )
          );
          $modelsMetadata->setStrategy(
                  new \Phalcon\Mvc\Model\MetaData\Strategy\Annotations()
          );
          return $modelsMetadata;
        } else {
          return new MetadataMemory();
        }
      } else {
        return new MetadataMemory();
      }
    });

    $this->_di->setShared('seeder', function () {
      $seeder = new \Sid\Phalcon\Seeder\Seeder();
      return $seeder;
    });
  }

  protected function initSession($options = array()) {

    $this->_di->setShared('session', function() {
      $session = new Session();
      if (!$session->isStarted()) {
        $session->start();
      }
      return $session;
    });
  }

  protected function initCache($options = array()) {

    $config = $this->_di->get('config');

    $this->_di->setShared('cache', function() use ($config) {
      $lifetime = $config->cache->lifetime;

      if (!file_exists($config->cache->cacheDir)) {
        mkdir($config->cache->cacheDir, 0777, true);
      }

      $cacheDir = $config->cache->cacheDir;
      $frontEndOptions = array('lifetime' => $lifetime);
      $backEndOptions = array('cacheDir' => $cacheDir);

      $frontCache = new CacheFront($frontEndOptions);
      $cache = new CacheBack($frontCache, $backEndOptions);
    });
  }

  protected function initElements($options = array()) {

    $this->_di->setShared('elements', function() {
      return new Elements();
    });
  }

  protected function initCrypt($options = array()) {

    $config = $this->_di->get('config');

    $this->_di->set('crypt', function () use ($config) {
      $crypt = new Crypt();
      $crypt->setMode(MCRYPT_MODE_CFB);
      $crypt->setKey($config->application->cryptSalt);
      return $crypt;
    });
  }

  protected function initCookies($options = array()) {

    $crypt = $this->_di->get('crypt');

    $this->_di->set('cookies', function () use ($crypt) {
      $cookies = new Cookies();
      $cookies->useEncryption($crypt);
      return $cookies;
    });
  }

  protected function initSecurity($options = array()) {

    $this->_di->setShared('security', function() {
      $security = new Security();
      $security->setWorkFactor(12);

      return $security;
    });
  }

  protected function initRouter($options = array()) {

    $this->_di->setShared('router', function () {

      $router = new Router();

      $router->setDefaultModule('nucleo');
      $router->setDefaultNamespace('Nucleo\Controllers');

      return $router;
    });
  }

  protected function initAssets($options = array()) {

    $this->_di->setShared('assets', function () {

      $assets = new AssetsManager();
      $assets->collection('header')
              ->addCss('assets/css/main.css', true);

      $assets->collection('footer')
              ->addJs('assets/js/libs/jquery-2.1.4.min.js', true)
              ->addJs('assets/js/libs/bootstrap.min.js', true)
              ->addJs('assets/js/main.js', true);
      return $assets;
    });
  }

  protected function initModules($application) {
    $application->registerModules(array(
        'nucleo' => array(
            'className' => 'Nucleo\Module',
            'path' => APP_PATH . '/app/modules/nucleo/module.php'
        ),
        'cnab' => array(
            'className' => 'Cnab\Module',
            'path' => APP_PATH . '/app/modules/cnab/module.php'
        ),
        'imports' => array(
            'className' => 'Imports\Module',
            'path' => APP_PATH . '/app/modules/imports/module.php'
        ),
    ));
  }

  protected function initRouters($application) {

    $router = $this->_di->get('router');
    $router->removeExtraSlashes(true);
    $router->notFound(array(
        'namespace' => 'Nucleo\Controllers',
        'module' => 'nucleo',
        'controller' => 'errors',
        'action' => 'show404'
    ));

    $router->add('/', array(
        'namespace' => 'Nucleo\Controllers',
        'module' => 'nucleo',
        'controller' => 'index',
        'action' => 'index')
    );

    $router->add('show404', array(
        'namespace' => 'Nucleo\Controllers',
        'module' => 'nucleo',
        'controller' => 'index',
        'action' => 'show404')
    );
    $router->add('show500', array(
        'namespace' => 'Nucleo\Controllers',
        'module' => 'nucleo',
        'controller' => 'index',
        'action' => 'show500')
    );

    foreach ($application->getModules() as $key => $module) {
      $namespace = str_replace('Module', 'Controllers', $module["className"]);
      $router->add('/' . $key . '/:params', array(
          'namespace' => $namespace,
          'module' => $key,
          'controller' => 'index',
          'action' => 'index',
          'params' => 1
      ))->setName($key);
      $router->add('/' . $key . '/:controller/:params', array(
          'namespace' => $namespace,
          'module' => $key,
          'controller' => 1,
          'action' => 'index',
          'params' => 2
      ));
      $router->add('/' . $key . '/:controller/:action/:params', array(
          'namespace' => $namespace,
          'module' => $key,
          'controller' => 1,
          'action' => 2,
          'params' => 3
      ));
    }

    $this->_di->set("router", $router);
  }

}
