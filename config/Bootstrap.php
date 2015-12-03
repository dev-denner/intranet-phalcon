<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Bootstrap
 *
 * @author DennerFernandes
 */
use Phalcon\Mvc\Application as Application;
use Phalcon\Config\Adapter\Ini as Config;
use Phalcon\Loader as Loader;
use Phalcon\Flash\Session as Flash;
use Phalcon\Mvc\Url as Url;
use Phalcon\Mvc\Dispatcher as Dispatcher;
use Phalcon\Mvc\View\Engine\Volt as Volt;
use Phalcon\Mvc\View as View;
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
        'view',
        'logger',
        'database',
        'session',
        'cache',
        'elements',
        'crypt',
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
    } catch (Phalcon\Exception $e) {
      echo $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode();
      echo nl2br(htmlentities($e->getTraceAsString()));
      echo ErrorPlugin::exception($e);
    } catch (PDOException $e) {
      echo $e->getMessage() . PHP_EOL . $e->getFile() . PHP_EOL . $e->getLine() . PHP_EOL . $e->getCode();
    }
  }

  protected function initConfig($options = array()) {
    $config = APP_PATH . '/config/config.ini';

    $this->_di->setShared('config', function() use ($config) {
      return new Config($config);
    });
  }

  protected function initLoader($options = array()) {

    $config = $this->_di->get('config');

    $loader = new Loader();

    $loader->registerDirs(
            array(
                APP_PATH . $config->application->pluginsDir,
                APP_PATH . $config->application->libraryDir,
            )
    );

    $loader->register();
  }

  protected function initEnvironment($options = array()) {

    $config = $this->_di->get('config');

    $debug = (isset($config->application->debug)) ? (bool) $config->application->debug : false;

    if ($debug) {
      ini_set('display_errors', true);
      error_reporting(E_ALL);
      $debug = new Phalcon\Debug();
      $debug->listen();
    } else {
      ini_set('display_errors', false);
      error_reporting(-1);
    }

    set_error_handler(array('ErrorPlugin', 'normal'));
    set_exception_handler(array('ErrorPlugin', 'exception'));
    register_shutdown_function(array('ErrorPlugin', 'shutdown'));
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

      $eventsManager = $di->getShared('eventsManager');

      $eventsManager->attach('dispatch:beforeException', new \Plug\NotFoundPlugin());
      $eventsManager->attach('dispatch', new \Plug\AclPlugin($di));

      $dispatcher = new Dispatcher();
      $dispatcher->setEventsManager($eventsManager);

      return $dispatcher;
    });
  }

  protected function initView($options = array()) {

    $config = $this->_di->get('config');
    $di = $this->_di;

    $this->_di->setShared('volt', function($view, $di) use ($config) {
      $volt = new Volt($view, $di);
      $volt->setOptions(
              array(
                  'compiledPath' => APP_PATH . $config->volt->path,
                  'compiledExtension' => $config->volt->extension,
                  'compiledSeparator' => $config->volt->separator,
                  'stat' => (bool) $config->volt->stat,
              )
      );
      return $volt;
    });

    $this->_di->setShared('view', function() use ($config, $di) {
      $view = new View();
      $view->setViewsDir(APP_PATH . $config->application->viewsDir);
      $view->registerEngines(array('.volt' => 'volt'));
      return $view;
    });
  }

  protected function initLogger($options = array()) {

    $config = $this->_di->get('config');

    $this->_di->setShared('logger', function() use ($config) {
      $logger = new LoggerFile(APP_PATH . $config->logger->file . date('Y-m-d') . '.log');
      $formatter = new LoggerFormatter($config->logger->format);
      $logger->setFormatter($formatter);

      return $logger;
    });
  }

  protected function initDatabase($options = array()) {

    $config = $this->_di->get('config');
    $logger = $this->_di->get('logger');

    $debug = (isset($config->application->debug)) ? (bool) $config->application->debug : false;

    $this->_di->setShared('db', function() use ($config, $logger, $debug) {

      if ($debug) {
        $eventsManager = new EventsManager();

        $eventsManager->attach('db', function($event, $connection) use($logger) {
          if ($event->getType() == 'beforeQuery') {
            $logger->log($connection->getSQLStatement(), Logger::INFO);
          }
        });
      }

      $params = array(
          'host' => $config->database->host,
          'username' => $config->database->username,
          'password' => $config->database->password,
          'dbname' => $config->database->dbname,
          'schema' => $config->database->schema,
      );

      $conn = new Phalcon\Db\Adapter\Pdo\Mysql($params);

      if ($debug) {
        $conn->setEventsManager($eventsManager);
      }
      return $conn;
    });

    $this->_di->setShared('modelsMetadata', function() use ($config) {

      if (isset($config->metadata->on)) {
        if ($config->metadata->adapter == 'Files') {
          $modelsMetadata = new MetadataFiles(array('metaDataDir' => $config->metadata->path));
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

  protected function initCrypt($application) {

    $config = $this->_di->get('config');

    $this->_di->set('crypt', function () use ($config) {
      $crypt = new Crypt();
      $crypt->setKey($config->application->cryptSalt);
      return $crypt;
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
      $assets
              ->addJs('//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js', false)
              ->addJs('//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', false);
      return $assets;
    });
  }

  protected function initModules($application) {
    $application->registerModules(array(
        'nucleo' => array(
            'className' => 'Nucleo\Module',
            'path' => __DIR__ . '/../apps/Nucleo/Module.php'
        ),
        'cnab' => array(
            'className' => 'Cnab\Module',
            'path' => __DIR__ . '/../apps/cnab/Module.php'
        ),
        'imports' => array(
            'className' => 'Imports\Module',
            'path' => __DIR__ . '/../apps/imports/Module.php'
        ),
    ));
  }

  protected function initRouters($application) {

    $router = $this->_di->get('router');

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
