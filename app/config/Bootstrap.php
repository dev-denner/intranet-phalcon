<?php

/**
 * Description of Bootstrap
 *
 * @author denner.fernandes
 * @since       10/07/2015 15:49:32
 */
use Phalcon\Exception as Exception;

class Bootstrap {

  private $_di;

  /**
   * Constructor
   * 
   * @param $di
   */
  public function __construct($di) {
    $this->_di = $di;
  }

  /**
   * Realiza todas as inicializações
   * 
   * @param $options
   *
   * @return mixed
   */
  public function run($options) {
    $loaders = array(
        'config',
        'loader',
        'environment',
        'timezone',
        'debug',
        'flash',
        'url',
        //'dispatcher',
        'view',
        'logger',
        'database',
        'session',
        'cache',
        'behaviors',
        'router'
    );

    try {

      foreach ($loaders as $service) {
        $function = 'init' . ucfirst($service);

        $this->$function($options);
      }

      $application = new Phalcon\Mvc\Application();
      $application->setDI($this->_di);

      return $application->handle()->getContent();
    } catch (Exception $e) {
      echo $e->getMessage();
    } catch (\PDOException $e) {
      echo $e->getMessage();
    }
  }

  // Protected functions

  /**
   * Inicializa a configuração. Lê-lo de sua localização e 
   * armazena-o no recipiente Di para facilitar o acesso
   *
   * @param array $options
   */
  protected function initConfig($options = array()) {
    $configFile = APP_PATH . '/app/config/config.ini';

    // Create the new object
    $config = new Phalcon\Config\Adapter\Ini($configFile);

    // Store it in the Di container
    $this->_di->set('config', $config);
  }

  /**
   * Inicializa os loaders
   *
   * @param array $options
   */
  protected function initLoader($options = array()) {
    $config = $this->_di->get('config');

    $loader = new Phalcon\Loader();

    $loader->registerDirs(
            array(
                APP_PATH . $config->application->controllersDir,
                APP_PATH . $config->application->modelsDir,
                APP_PATH . $config->application->viewsDir,
                APP_PATH . $config->application->pluginsDir,
                APP_PATH . $config->application->libraryDir,
                APP_PATH . $config->application->formsDir,
            )
    );

    // Registro de namespaces
    $loader->registerNamespaces(array('ModelBehaviors' => APP_PATH . $config->application->modelsDir . '\Behaviors\\'));

    $loader->register();
  }

  /**
   * Inicializa o ambiente
   *
   * @param array $options
   */
  protected function initEnvironment($options = array()) {
    $config = $this->_di->get('config');

    $debug = (isset($config->application->debug)) ? (bool) $config->application->debug : false;

    if ($debug) {
      ini_set('display_errors', true);
      error_reporting(E_ALL);
    } else {
      ini_set('display_errors', false);
      error_reporting(-1);
    }

    set_error_handler(array('ErrorPlugin', 'normal'));
    set_exception_handler(array('ErrorPlugin', 'exception'));
    register_shutdown_function(array('ErrorPlugin', 'shutdown'));
  }

  /**
   * Inicializa o timezone
   *
   * @param array $options
   */
  protected function initTimezone($options = array()) {
    $config = $this->_di->get('config');

    $timezone = (isset($config->application->timezone)) ? $config->application->timezone : 'America/Sao_Paulo';

    date_default_timezone_set($timezone);

    $this->_di->set('timezone_default', $timezone);
  }

  /**
   * Inicializa as session-flash
   *
   * @param array $options
   */
  protected function initFlash($options = array()) {
    $this->_di->set(
            'flash', function() {
      $params = array(
          'error' => 'alert alert-danger',
          'success' => 'alert alert-success',
          'notice' => 'alert alert-info',
      );

      return new Phalcon\Flash\Session($params);
    }
    );
  }

  /**
   * Inicializa a baseUri
   *
   * @param array $options
   */
  protected function initUrl($options = array()) {
    $config = $this->_di->get('config');

    /**
     * O componente de URL é usado para gerar todos os tipos de URLs na aplicação
     */
    $this->_di->set(
            'url', function() use ($config) {
      $url = new Phalcon\Mvc\Url();
      $url->setBaseUri($config->application->baseUri);
      return $url;
    }
    );
  }

  /**
   * Inicializa o dispatcher
   *
   * @param array $options
   */
  protected function initDispatcher($options = array()) {
    $di = $this->_di;

    $this->_di->set(
            'dispatcher', function() use ($di) {

      $evManager = $di->getShared('eventsManager');
      $acl = new AclPlugin($di);

      /**
       * Listening to events in the dispatcher using the
       * Acl plugin
       */
      $evManager->attach('dispatch', $acl);
      $dispatcher = new Phalcon\Mvc\Dispatcher();
      $dispatcher->setEventsManager($evManager);

      return $dispatcher;
    }
    );
  }

  /**
   * Inicializa as views e o Volt
   *
   * @param array $options
   */
  protected function initView($options = array()) {
    $config = $this->_di->get('config');
    $di = $this->_di;

    $this->_di->set(
            'volt', function($view, $di) use($config) {
      $volt = new Phalcon\Mvc\View\Engine\Volt($view, $di);
      $volt->setOptions(
              array(
                  'compiledPath' => APP_PATH . $config->volt->path,
                  'compiledExtension' => $config->volt->extension,
                  'compiledSeparator' => $config->volt->separator,
                  'stat' => (bool) $config->volt->stat,
              )
      );

      $compiler = $volt->getCompiler();

      //Add função
      $compiler->addFunction('is_a', 'is_a');

      return $volt;
    }
    );

    /**
     * Configura o serviço de view
     */
    $this->_di->set(
            'view', function() use ($config, $di) {
      $view = new Phalcon\Mvc\View();
      $view->setViewsDir(APP_PATH . $config->application->viewsDir);
      $view->registerEngines(array('.volt' => 'volt'));
      return $view;
    }
    );
  }

  /**
   * Inicializa o logger
   *
   * @param array $options
   */
  protected function initLogger($options = array()) {
    $config = $this->_di->get('config');

    $this->_di->set(
            'logger', function() use ($config) {
      $logger = new Phalcon\Logger\Adapter\File(APP_PATH . $config->logger->file);

      $formatter = new Phalcon\Logger\Formatter\Line($config->logger->format);
      $logger->setFormatter($formatter);

      return $logger;
    }
    );
  }

  /**
   * Inicializa o banco de dados e o adaptador de metadados
   *
   * @param array $options
   */
  protected function initDatabase($options = array()) {
    $config = $this->_di->get('config');
    $logger = $this->_di->get('logger');

    $debug = (isset($config->application->debug)) ? (bool) $config->application->debug : false;

    foreach ($config->database as $key => $value) {

      if ($key == 'default') {

        $nomeDb = 'db';
      } else {

        $nomeDb = 'db_' . $key;
      }

      $this->_di->set($nomeDb, function() use ($debug, $config, $logger, $key, $nomeDb) {

        if ($debug) {
          $eventsManager = new Phalcon\Events\Manager();

          // Ouve todos os eventos de banco de dados
          $eventsManager->attach($nomeDb, function($event, $connection) use ($logger) {
            
            if ($event->getType() == 'beforeQuery') {
              $logger->log($connection->getSQLStatement(), Phalcon\Logger::INFO);
            }
          });
        }

        $params = array(
            'host' => $config->database->$key->host,
            'username' => $config->database->$key->username,
            'password' => $config->database->$key->password,
            'dbname' => $config->database->$key->dbname,
            'schema' => $config->database->$key->schema,
        );

        $adapter = 'Phalcon\Db\Adapter\Pdo\\' . $config->database->$key->adapter;

        $conn = new $adapter($params);

        if ($debug) {
          // Atribuir o Gerenciador de eventos para a instância do adaptador do banco de dados
          $conn->setEventsManager($eventsManager);
        }

        return $conn;
      });
    }

    /**
     * Se a configuração especificar o uso de adaptador de metadados usá-lo ou usar a memória de outra forma
     */
    $this->_di->set('modelsMetadata', function() use ($config) {
      if (isset($config->models->metadata->on)) {
        if ($config->models->metadata->adapter == 'Files') {
          return new Phalcon\Mvc\Model\Metadata\Files(
                  array('metaDataDir' => $config->models->metadata->path)
          );
        } else {
          return new Phalcon\Mvc\Model\Metadata\Memory();
        }
      } else {
        return new Phalcon\Mvc\Model\Metadata\Memory();
      }
    }
    );
  }

  /**
   * Inicializa o session
   *
   * @param array $options
   */
  protected function initSession($options = array()) {
    $this->_di->set(
            'session', function() {
      $session = new Phalcon\Session\Adapter\Files();
      if (!$session->isStarted()) {
        $session->start();
      }
      return $session;
    }
    );
  }

  /**
   * Inicializa o cache
   *
   * @param array $options
   */
  protected function initCache($options = array()) {
    $config = $this->_di->get('config');

    $this->_di->set(
            'cache', function() use ($config) {
      // Get the parameters
      $lifetime = $config->cache->lifetime;
      $cacheDir = $config->cache->cacheDir;
      $frontEndOptions = array('lifetime' => $lifetime);
      $backEndOptions = array('cacheDir' => APP_PATH . $cacheDir);

      $frontCache = new Phalcon\Cache\Frontend\Data($frontEndOptions);
      $cache = new Phalcon\Cache\Backend\File($frontCache, $backEndOptions);

      return $cache;
    }
    );
  }

  /**
   * Inicializa o model behaviors
   *
   * @param array $options
   */
  protected function initBehaviors($options = array()) {
    $session = $this->_di->getShared('session');

    // Timestamp
    $this->_di->set(
            'Timestamp', function() use ($session) {
      $timestamp = new ModelBehaviors\Timestamp($session);
      return $timestamp;
    }
    );
  }

  /**
   * Inicializa as funções de debug
   *
   * @param array $options
   */
  protected function initDebug($options = array()) {
    $config = $this->_di->get('config');
    $debug = (isset($config->application->debug)) ? (bool) $config->application->debug : false;

    if ($debug) {
      require_once APP_PATH . '/app/plugins/DebugPlugin.php';
    }
  }

  /**
   * Inicializa ao router.
   *
   * @param array $options
   */
  protected function initRouter($options = array()) {

    $this->_di->set('Router', function() {
      $router = new Phalcon\Mvc\Router($session);

      $router->add(
              '/:controller/a/:action/:params', array(
          'controller' => 1,
          'action' => 2,
          'params' => 3,
              )
      );
      $router->handle();

      return $router;
    });
  }

}
