<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */
use DevDenners\Library\Auth as Auth;
use DevDenners\Library\FlashMessage\Closable as Closable;
use DevDenners\Plugins\NotFound as NotFound;
use Phalcon\Assets\Manager as AssetsManager;
use Phalcon\Crypt as Crypt;
use Phalcon\Cache\Frontend\Data as CacheFront;
use Phalcon\Cache\Bachend\File as CacheBack;
use Phalcon\Db\Adapter\Pdo\Oracle as Oracle;
use Phalcon\Db\Adapter\Pdo\Mysql as Mysql;
use Phalcon\Debug as Debug;
use Phalcon\Exception as Exception;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Http\Response\Cookies as Cookies;
use Phalcon\Loader as Loader;
use Phalcon\Logger as Logger;
use Phalcon\Logger\Adapter\File as LoggerFile;
use Phalcon\Logger\Formatter\Line as LoggerFormatter;
use Phalcon\Mvc\Application as Application;
use Phalcon\Mvc\Dispatcher as Dispatcher;
use Phalcon\Mvc\Model\Manager as ModelsManager;
use Phalcon\Mvc\Model\Metadata\Files as MetadataFiles;
use Phalcon\Mvc\Model\Metadata\Memory as MetadataMemory;
use Phalcon\Mvc\Model\MetaData\Strategy\Annotations as Annotations;
use Phalcon\Mvc\Router as Router;
use Phalcon\Mvc\Url as Url;
use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Security as Security;
use Sid\Phalcon\Seeder\Seeder as Seeder;

class Bootstrap {

  private $_di;

  public function __construct($di) {
    $this->_di = $di;
  }

  public function run($options) {

    $loaders = [
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
        'auth',
    ];

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
    } catch (Exception $e) {
      echo $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode();
      echo nl2br(htmlentities($e->getTraceAsString()));
    } catch (\PDOException $e) {
      echo $e->getMessage() . PHP_EOL . $e->getFile() . PHP_EOL . $e->getLine() . PHP_EOL . $e->getCode();
    }
  }

  protected function initConfig($options = []) {
    $config = include APP_PATH . '/app/config/config.php';
    $databases = include APP_PATH . '/app/config/database.php';

    $this->_di->setShared('config', function() use ($config) {
      return $config;
    });

    $this->_di->setShared('databases', function() use ($databases) {
      return $databases;
    });
  }

  protected function initLoader($options = []) {

    $config = $this->_di->get('config');

    $loader = new Loader();

    $loader->registerNamespaces([
        'DevDenners\Library' => __DIR__ . '/../library',
        'DevDenners\Forms' => __DIR__ . '/../forms',
        'DevDenners\Plugins' => __DIR__ . '/../plugins',
        'DevDenners\Helpers' => __DIR__ . '/../helpers',
    ]);

    $loader->registerDirs(
            [
                $config->application->pluginsDir,
                $config->application->libraryDir,
                $config->application->helpersDir,
                $config->application->formsDir,
    ]);

    $loader->register();
  }

  protected function initEnvironment($options = []) {

    $config = $this->_di->get('config');

    $environment = $config->application->environment != 'production' ? true : false;

    if ($environment) {
      ini_set('display_errors', true);
      error_reporting(E_ALL);
      $debug = new Debug();
      $debug->listen();
    } else {
      ini_set('display_errors', false);
      error_reporting(-1);
    }

    set_error_handler(['\DevDenners\Plugins\Error', 'normal']);
    set_exception_handler(['DevDenners\Plugins\Error', 'exception']);
    register_shutdown_function(['DevDenners\Plugins\Error', 'shutdown']);
  }

  protected function initTimezone($options = []) {

    $config = $this->_di->get('config');

    $timezone = (isset($config->application->timezone)) ? $config->application->timezone : 'America/Sao_Paulo';

    date_default_timezone_set($timezone);

    $this->_di->setShared('timezone_default', $timezone);
  }

  protected function initFlash($options = []) {

    $this->_di->setShared('flash', function() {
      return new Closable();
    });
  }

  protected function initUrl($options = []) {

    $config = $this->_di->get('config');

    $this->_di->setShared('url', function() use ($config) {
      $url = new Url();
      $url->setBaseUri($config->application->baseUri);

      return $url;
    });
  }

  protected function initDispatcher($options = []) {

    $di = $this->_di;

    $this->_di->setShared('dispatcher', function() use ($di) {

      $eventsManager = new EventsManager();

      //$eventsManager->attach('dispatch:beforeDispatch', new SecurityPlugin());

      $eventsManager->attach('dispatch', new NotFound());
      $dispatcher = new Dispatcher();
      $dispatcher->setEventsManager($eventsManager);
      $dispatcher->setDefaultNamespace('Nucleo');

      return $dispatcher;
    });
  }

  protected function initLogger($options = []) {

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

  protected function initDatabase($options = []) {

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

        $params = [
            'host' => $value->host,
            'username' => $value->username,
            'password' => $value->password,
            'dbname' => $value->dbname,
            'schema' => $value->schema,
            'options' => [PDO::ATTR_CASE => PDO::CASE_UPPER, PDO::ATTR_PERSISTENT => TRUE,],
        ];

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

          $modelsMetadata = new MetadataFiles(['metaDataDir' => $config->model->metadata->path]
          );
          $modelsMetadata->setStrategy(
                  new Annotations()
          );
          return $modelsMetadata;
        } else {
          return new MetadataMemory();
        }
      } else {
        return new MetadataMemory();
      }
    });

    $this->_di->setShared('modelsManager', function() {
      return new ModelsManager();
    });

    $this->_di->setShared('seeder', function () {
      $seeder = new Seeder();
      return $seeder;
    });
  }

  protected function initSession($options = []) {

    $this->_di->setShared('session', function() {
      $session = new Session(
              ['uniqueId' => 'api_phalcon-']
      );
      if (!$session->isStarted()) {
        $session->start();
      }
      return $session;
    });
  }

  protected function initCache($options = []) {

    $config = $this->_di->get('config');

    $this->_di->setShared('cache', function() use ($config) {
      $lifetime = $config->cache->lifetime;

      if (!file_exists($config->cache->cacheDir)) {
        mkdir($config->cache->cacheDir, 0777, true);
      }

      $cacheDir = $config->cache->cacheDir;
      $frontEndOptions = ['lifetime' => $lifetime];
      $backEndOptions = ['cacheDir' => $cacheDir];

      $frontCache = new CacheFront($frontEndOptions);
      $cache = new CacheBack($frontCache, $backEndOptions);
    });
  }

  protected function initElements($options = []) {

    $this->_di->setShared('elements', function() {
      return new Elements();
    });
  }

  protected function initCrypt($options = []) {

    $config = $this->_di->get('config');

    $this->_di->set('crypt', function () use ($config) {
      $crypt = new Crypt();
      $crypt->setMode(MCRYPT_MODE_CFB);
      $crypt->setKey($config->application->cryptSalt);
      return $crypt;
    });
  }

  protected function initCookies($options = []) {

    $crypt = $this->_di->get('crypt');

    $this->_di->set('cookies', function () use ($crypt) {
      $cookies = new Cookies();
      $cookies->useEncryption($crypt);
      return $cookies;
    });
  }

  protected function initSecurity($options = []) {

    $this->_di->setShared('security', function() {
      $security = new Security();
      $security->setWorkFactor(12);

      return $security;
    });
  }

  protected function initRouter($options = []) {

    $this->_di->setShared('router', function () {

      $router = new Router();

      $router->setDefaultModule('nucleo');
      $router->setDefaultNamespace('Nucleo\Controllers');

      return $router;
    });
  }

  protected function initAssets($options = []) {

    $this->_di->setShared('assets', function () {

      $assets = new AssetsManager();
      $assets->collection('headerCss');
      $assets->collection('headerJs');
      $assets->collection('footerJs');
      return $assets;
    });
  }

  protected function initAuth($options = []) {

    $this->_di->setShared('auth', function () {
      return new Auth();
    });
  }

  protected function initModules($application) {
    $application->registerModules([
        'nucleo' => [
            'className' => 'Nucleo\Module',
            'path' => APP_PATH . '/app/modules/nucleo/module.php'
        ],
        'cnab' => [
            'className' => 'Cnab\Module',
            'path' => APP_PATH . '/app/modules/cnab/module.php'
        ],
        'imports' => [
            'className' => 'Imports\Module',
            'path' => APP_PATH . '/app/modules/imports/module.php'
        ],
    ]);
  }

  protected function initRouters($application) {

    $router = $this->_di->get('router');
    $router->removeExtraSlashes(true);
    $router->notFound([
        'namespace' => 'Nucleo\Controllers',
        'module' => 'nucleo',
        'controller' => 'errors',
        'action' => 'show404'
    ]);

    $router->add('/', [
        'namespace' => 'Nucleo\Controllers',
        'module' => 'nucleo',
        'controller' => 'index',
        'action' => 'index',
    ]);

    $router->add('show404', [
        'namespace' => 'Nucleo\Controllers',
        'module' => 'nucleo',
        'controller' => 'index',
        'action' => 'show404'
    ]);
    $router->add('show500', [
        'namespace' => 'Nucleo\Controllers',
        'module' => 'nucleo',
        'controller' => 'index',
        'action' => 'show500'
    ]);

    foreach ($application->getModules() as $key => $module) {
      $namespace = str_replace('Module', 'Controllers', $module["className"]);
      $router->add('/' . $key . '/:params', [
          'namespace' => $namespace,
          'module' => $key,
          'controller' => 'index',
          'action' => 'index',
          'params' => 1
      ])->setName($key);

      $router->add('/' . $key . '/:controller/:params', [
          'namespace' => $namespace,
          'module' => $key,
          'controller' => 1,
          'action' => 'index',
          'params' => 2
      ]);
      $router->add('/' . $key . '/:controller/:action/:params', [
          'namespace' => $namespace,
          'module' => $key,
          'controller' => 1,
          'action' => 2,
          'params' => 3
      ]);
    }

    $this->_di->set("router", $router);
  }

}
