<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */
use DevDenners\Library\Auth\Auth as Auth;
use DevDenners\Library\Mail\Mail as Mail;
use DevDenners\Library\FlashMessage\Closable as Closable;
use DevDenners\Plugins\Access as Access;
use DevDenners\Plugins\Elements as Elements;
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
use Phalcon\Mvc\Model\Metadata\Apc as MetadataApc;
use Phalcon\Mvc\Model\Metadata\Memory as MetadataMemory;
use Phalcon\Mvc\Model\MetaData\Strategy\Annotations as Annotations;
use Phalcon\Mvc\Router as Router;
use Phalcon\Mvc\Url as Url;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Session\Adapter\Files as Session;
use Phalcon\Security as Security;

/**
 *
 */
class Bootstrap {

    /**
     *
     * @var type
     */
    private $_di;

    /**
     *
     * @param type $di
     */
    public function __construct($di) {
        $this->_di = $di;
    }

    /**
     *
     * @param type $options
     * @return type
     */
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
            'view',
            'elements',
            'mail',
            'cookies',
            'security',
            'router',
            'assets',
            'auth',
            'access',
        ];

        try {

            foreach ($loaders as $service) {
                $function = 'init' . ucfirst($service);

                $this->$function($options);
            }

            $application = new Application();

            $application = $this->initModules($application);
            $this->initRouters($application);

            $application->setDI($this->_di);

            return $application->handle()->getContent();
        } catch (\Phalcon\Exception $e) {
            echo '<pre>', $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode();
            echo nl2br(htmlentities($e->getTraceAsString())), '</pre>';
        } catch (\PDOException $e) {
            echo '<pre>', $e->getMessage() . PHP_EOL . $e->getFile() . PHP_EOL . $e->getLine() . PHP_EOL . $e->getCode(), '</pre>';
        }
    }

    /**
     *
     * @param type $options
     */
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

    /**
     *
     * @param type $options
     */
    protected function initLoader($options = []) {

        $config = $this->_di->get('config');

        $loader = new Loader();

        $loader->registerNamespaces([
            'DevDenners\Controllers' => __DIR__ . '/../shared/controllers',
            'DevDenners\Models' => __DIR__ . '/../shared/models',
            'DevDenners\Library' => __DIR__ . '/../library',
            'DevDenners\Forms' => __DIR__ . '/../forms',
            'DevDenners\Plugins' => __DIR__ . '/../plugins',
            'DevDenners\Helpers' => __DIR__ . '/../helpers',
            //models
            'Intranet\Models' => APP_PATH . '/app/modules/intranet/models',
            'Nucleo\Models' => APP_PATH . '/app/modules/nucleo/models',
            'Cnab\Models' => APP_PATH . '/app/modules/cnab/models',
            'Imports\Models' => APP_PATH . '/app/modules/imports/models',
            'Telephony\Models' => APP_PATH . '/app/modules/telephony/models',
        ]);

        $loader->registerDirs([
            $config->application->pluginsDir,
            $config->application->libraryDir,
            $config->application->helpersDir,
            $config->application->formsDir,
        ]);

        $loader->register();
    }

    /**
     *
     * @param type $options
     */
    protected function initEnvironment($options = []) {

        $config = $this->_di->get('config');

        $environment = $config->application->environment != 'production' ? true : false;

        if ($environment) {
            ini_set('display_errors', true);
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

    /**
     *
     * @param type $options
     */
    protected function initTimezone($options = []) {

        $config = $this->_di->get('config');

        $timezone = (isset($config->application->timezone)) ? $config->application->timezone : 'America/Sao_Paulo';

        date_default_timezone_set($timezone);

        $this->_di->setShared('timezone_default', $timezone);
    }

    /**
     *
     * @param type $options
     */
    protected function initFlash($options = []) {

        $this->_di->setShared('flash', function() {
            return new Closable();
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initUrl($options = []) {

        $config = $this->_di->get('config');

        $this->_di->setShared('url', function() use ($config) {
            $url = new Url();
            $url->setBaseUri($config->application->baseUri);

            return $url;
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initDispatcher($options = []) {

        $di = $this->_di;
        $this->_di->setShared('dispatcher', function() use ($di) {

            $eventsManager = new EventsManager();
            $eventsManager->attach('dispatch', new NotFound());
            $dispatcher = new Dispatcher();
            $dispatcher->setEventsManager($eventsManager);
            $dispatcher->setDefaultNamespace('Nucleo');

            return $dispatcher;
        });
    }

    /**
     *
     * @param type $options
     */
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

    /**
     *
     * @param type $options
     */
    protected function initDatabase($options = []) {

        $config = $this->_di->get('config');
        $databases = $this->_di->get('databases');
        $logger = $this->_di->get('loggerDb');

        $environment = $config->application->environment != 'production' ? true : false;

        foreach ($databases->database as $key => $value) {

            $this->_di->setShared($key, function() use ($value, $logger, $environment, $key) {

                if ($environment) {
                    $eventsManager = new EventsManager();

                    $eventsManager->attach($key, function($event, $connection) use($logger) {
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
                    'charset' => $value->charset,
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

                    return $modelsMetadata;
                } if ($config->model->metadata->adapter == 'Apc') {
                    $modelsMetadata = new MetadataApc(array(
                        'prefix' => 'mpe-intranet-',
                        'lifetime' => 86400
                    ));
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
    }

    /**
     *
     * @param type $options
     */
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

    /**
     *
     * @param type $options
     */
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

    /**
     *
     * @param type $options
     */
    protected function initView($options = []) {

        $config = $this->_di->get('config');

        $di = $this->_di;

        if (!file_exists($config->volt->path)) {
            mkdir($config->volt->path, 0777, true);
        }

        $this->_di->setShared('volt', function($view, $di) use($config) {
            $volt = new Volt($view, $di);
            $volt->setOptions(
                    [
                        'compiledPath' => $config->volt->path,
                        'compiledExtension' => $config->volt->extension,
                        'compiledSeparator' => $config->volt->separator,
                        'stat' => (bool) $config->volt->stat,
                    ]
            );

            $compiler = $volt->getCompiler();

            $compiler->addFunction('is_a', 'is_a');

            return $volt;
        });


        $this->_di->setShared('view', function() use ($config) {
            $view = new View();
            $view->setViewsDir($config->application->viewsDir);
            $view->setMainView('index');
            $view->setLayoutsDir('layouts/');
            $view->setPartialsDir('partials/');
            $view->registerEngines([
                '.volt' => 'volt',
                '.phtml' => 'Phalcon\Mvc\View\Engine\Php']);
            return $view;
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initElements($options = []) {

        $this->_di->setShared('elements', function() {
            return new Elements();
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initCookies($options = []) {

        $this->_di->setShared('cookies', function () {
            $cookies = new Cookies();
            $cookies->useEncryption(false);

            return $cookies;
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initAuth($options = []) {

        $this->_di->setShared('auth', function () {
            return new Auth();
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initAccess($options = []) {

        $config = $this->_di->get('config');
        $path = $config->access->path;

        $this->_di->setShared('access', function () use($path) {
            return new Access($path);
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initMail($options = []) {

        $this->_di->setShared('mail', function () {
            return new Mail();
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initSecurity($options = []) {

        $this->_di->setShared('security', function() {
            $security = new Security();
            $security->setWorkFactor(12);

            return $security;
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initRouter($options = []) {

        $this->_di->setShared('router', function () {

            $router = new Router();

            $router->setDefaultModule('intranet');
            $router->setDefaultNamespace('Intranet\Controllers');
            $router->removeExtraSlashes(true);

            return $router;
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initAssets($options = []) {

        $this->_di->setShared('assets', function () {

            $assets = new AssetsManager();
            $assets->collection('headerCss');
            $assets->collection('headerJs');
            $assets->collection('footerJs');
            return $assets;
        });
    }

    /**
     *
     * @param type $application
     * @return type
     */
    protected function initModules($application) {
        $application->registerModules([
            'intranet' => [
                'className' => 'Intranet\Module',
                'path' => APP_PATH . '/app/modules/intranet/Module.php'
            ],
            'nucleo' => [
                'className' => 'Nucleo\Module',
                'path' => APP_PATH . '/app/modules/nucleo/Module.php'
            ],
            'telephony' => [
                'className' => 'Telephony\Module',
                'path' => APP_PATH . '/app/modules/telephony/Module.php'
            ],
            'cnab' => [
                'className' => 'Cnab\Module',
                'path' => APP_PATH . '/app/modules/cnab/Module.php'
            ],
            'imports' => [
                'className' => 'Imports\Module',
                'path' => APP_PATH . '/app/modules/imports/Module.php'
            ],
        ]);
        return $application;
    }

    /**
     *
     * @param type $application
     */
    protected function initRouters($application) {

        $router = $this->_di->get('router');
        $router->add('/', [
            'namespace' => 'Intranet\Controllers',
            'module' => 'intranet',
            'controller' => 'index',
            'action' => 'index',
        ]);
        $router->notFound([
            'namespace' => 'Nucleo\Controllers',
            'module' => 'nucleo',
            'controller' => 'errors',
            'action' => 'show404'
        ]);
        $router->add('/forbidden', [
            'namespace' => 'Nucleo\Controllers',
            'module' => 'nucleo',
            'controller' => 'errors',
            'action' => 'show401'
        ]);
        $router->add('/not-found', [
            'namespace' => 'Nucleo\Controllers',
            'module' => 'nucleo',
            'controller' => 'errors',
            'action' => 'show404'
        ]);
        $router->add('/internal-error', [
            'namespace' => 'Nucleo\Controllers',
            'module' => 'nucleo',
            'controller' => 'errors',
            'action' => 'show500'
        ]);
        $router->add('/confirm/{code}/{email}', [
            'namespace' => 'Nucleo\Controllers',
            'module' => 'nucleo',
            'controller' => 'users',
            'action' => 'confirmEmail'
        ]);
        $router->add('/reset-password/{code}/{email}', [
            'namespace' => 'Nucleo\Controllers',
            'module' => 'nucleo',
            'controller' => 'users',
            'action' => 'resetPassword'
        ]);
        $router->add('/change-password', [
            'namespace' => 'Nucleo\Controllers',
            'module' => 'nucleo',
            'controller' => 'users',
            'action' => 'changePassword'
        ]);
        $router->add('/login', [
            'namespace' => 'Nucleo\Controllers',
            'module' => 'nucleo',
            'controller' => 'session',
            'action' => 'index'
        ]);
        $router->add('/login/:action', [
            'namespace' => 'Nucleo\Controllers',
            'module' => 'nucleo',
            'controller' => 'session',
            'action' => 1
        ]);
        $router->add('/produtos', [
            'namespace' => 'Intranet\Controllers',
            'module' => 'intranet',
            'controller' => 'consultas',
            'action' => 'produtosServicos'
        ]);
        $router->add('/fornecedores', [
            'namespace' => 'Intranet\Controllers',
            'module' => 'intranet',
            'controller' => 'consultas',
            'action' => 'fornecedores'
        ]);
        $router->add('/profile', [
            'namespace' => 'Nucleo\Controllers',
            'module' => 'nucleo',
            'controller' => 'users',
            'action' => 'profile'
        ]);

        foreach ($application->getModules() as $key => $module) {
            $namespace = str_replace('Module', 'Controllers', $module['className']);
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

        $router->handle();

        $this->_di->setShared("router", $router);
    }

}
