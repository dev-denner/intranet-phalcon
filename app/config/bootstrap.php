<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */
use SysPhalcon\Library\Auth\Auth as Auth;
use SysPhalcon\Library\Mail\Mail as Mail;
use SysPhalcon\Library\FlashMessage\Closable as Closable;
use SysPhalcon\Plugins\Access as Access;
use SysPhalcon\Plugins\Elements as Elements;
use SysPhalcon\Plugins\NotFound as NotFound;
use Phalcon\Assets\Manager as AssetsManager;
use Phalcon\Cache\Frontend\Data as CacheFront;
use Phalcon\Cache\Backend\Memcache as CacheBack;
use Phalcon\Db\Adapter\Pdo\Oracle as Oracle;
use Phalcon\Db\Adapter\Pdo\Mysql as Mysql;
use Phalcon\Events\Manager as EventsManager;
use Phalcon\Http\Response\Cookies as Cookies;
use Phalcon\Loader as Loader;
use Phalcon\Logger\Adapter\File as LoggerFile;
use Phalcon\Logger\Formatter\Line as LoggerFormatter;
use Phalcon\Mvc\Application as Application;
use Phalcon\Mvc\Dispatcher as Dispatcher;
use Phalcon\Mvc\Model\Manager as ModelsManager;
use Phalcon\Mvc\Model\Metadata\Files as MetadataFiles;
use Phalcon\Mvc\Model\Metadata\Apc as MetadataApc;
use Phalcon\Mvc\Model\Metadata\Memory as MetadataMemory;
use Phalcon\Mvc\Router as Router;
use Phalcon\Mvc\Url as Url;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Security as Security;
use Phalcon\Session\Adapter\Database as Session;
use SysPhalcon\Plugins\DbListener;
use Respect\Validation\Validator as Validator;
use Phalcon\Filter;
use Phalcon\Translate\Adapter\NativeArray as Translator;
use Phalcon\Breadcrumbs;
use Phalcon\Di\FactoryDefault as Di;
use Dotenv\Dotenv as Dotenv;

/**
 *
 */
class Bootstrap
{

    /**
     *
     * @var object
     */
    private $_di;

    /**
     *
     * @var array
     */
    private $loaders = [
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
        //'response',
        'view',
        'elements',
        'mail',
        'cookies',
        'security',
        'router',
        'assets',
        'auth',
        'access',
        'validator',
        'filter',
        'translate',
        'breadcrumbs',
    ];

    /**
     *
     * @param Di $di
     */
    public function __construct(Di $di)
    {
        $this->_di = $di;
    }

    /**
     *
     * @param type $options
     * @return type
     */
    public function run($options)
    {

        foreach ($this->loaders as $service) {
            $function = 'init' . ucfirst($service);

            $this->$function($options);
        }

        $app = new Application();

        $application = $this->initModules($app);
        $this->initRouters($application);

        $application->setDI($this->_di);

        return $application->handle()->getContent();
    }

    /**
     *
     * @param type $options
     */
    protected function initConfig($options = [])
    {

        $dotenv = new Dotenv(APP_PATH);

        $pasta = 'production';

        if (file_exists(APP_PATH . '/app/config/development/')) {
            $pasta = 'development';
            $dotenv = new Dotenv(APP_PATH, '.env_dev');
        }

        $dotenv->load();
        
        $config = include APP_PATH . "/app/config/{$pasta}/config.php";
        $databases = include APP_PATH . "/app/config/{$pasta}/database.php";

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
    protected function initLoader($options = [])
    {

        $config = $this->_di->get('config');

        $loader = new Loader();

        $loader->registerNamespaces([
            'SysPhalcon\Controllers' => APP_PATH . '/app/shared/controllers',
            'SysPhalcon\Models' => APP_PATH . '/app/shared/models',
            'SysPhalcon\Library' => APP_PATH . '/app/library',
            'SysPhalcon\Forms' => APP_PATH . '/app/forms',
            'SysPhalcon\Plugins' => APP_PATH . '/app/plugins',
            'SysPhalcon\Helpers' => APP_PATH . '/app/helpers',
            //models
            'Intranet\Models' => APP_PATH . '/app/modules/intranet/models',
            'Nucleo\Models' => APP_PATH . '/app/modules/nucleo/models',
            'Cnab\Models' => APP_PATH . '/app/modules/cnab/models',
            'Imports\Models' => APP_PATH . '/app/modules/imports/models',
            'Telephony\Models' => APP_PATH . '/app/modules/telephony/models',
            'Forms\Models' => APP_PATH . '/app/modules/forms/models',
            'Catraca\Models' => APP_PATH . '/app/modules/catraca/models',
            'Otrs\Models' => APP_PATH . '/app/modules/otrs/models',
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
    protected function initEnvironment($options = [])
    {

        $config = $this->_di->get('config');

        $environment = $config->application->environment != 'production' ? true : false;

        if ($environment) {
            ini_set('display_errors', true);
            if (is_file(APP_PATH . '/app/library/WhoopsServiceProvider.php')) {
                require_once APP_PATH . '/app/library/WhoopsServiceProvider.php';
            }

            new \Whoops\Provider\Phalcon\WhoopsServiceProvider($this->_di);
        } else {
            ini_set('display_errors', false);
            error_reporting(-1);
        }

        set_error_handler(['\SysPhalcon\Plugins\Error', 'normal']);
        set_exception_handler(['\SysPhalcon\Plugins\Error', 'exception']);
        register_shutdown_function(['\SysPhalcon\Plugins\Error', 'shutdown']);
    }

    /**
     *
     * @param type $options
     */
    protected function initTimezone($options = [])
    {

        $config = $this->_di->get('config');

        $timezone = (isset($config->application->timezone)) ? $config->application->timezone : 'America/Sao_Paulo';

        date_default_timezone_set($timezone);

        $this->_di->setShared('timezone_default', $timezone);
    }

    /**
     *
     * @param type $options
     */
    protected function initFlash($options = [])
    {

        $this->_di->setShared('flash', function() {
            return new Closable();
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initUrl($options = [])
    {

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
    protected function initDispatcher($options = [])
    {

        $di = $this->_di;
        $this->_di->setShared('dispatcher', function() use ($di) {

            $eventsManager = new EventsManager();
            $eventsManager->attach('dispatch:beforeException', new NotFound());
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
    protected function initLogger($options = [])
    {

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
            if (!file_exists($config->logger->file . 'db/')) {
                mkdir($config->logger->file . 'db/', 0777, true);
            }
            $logger = new LoggerFile($config->logger->file . 'db/' . date('Y-m-d') . '.log');
            $formatter = new LoggerFormatter($config->logger->format);
            $logger->setFormatter($formatter);

            return $logger;
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initDatabase($options = [])
    {

        $config = $this->_di->get('config');
        $databases = $this->_di->get('databases');

        $environment = $config->application->environment != 'production' ? true : false;

        foreach ($databases->database as $key => $value) {

            $this->_di->setShared($key, function() use ($value, $environment, $key) {

                if ($environment) {
                    $eventsManager = new EventsManager();
                    $dbListener = new DbListener();
                    $eventsManager->attach($key, $dbListener);
                }

                $params = [
                    'host' => $value->host,
                    'username' => $value->username,
                    'password' => $value->password,
                    'dbname' => $value->dbname,
                    'schema' => $value->schema,
                    'charset' => $value->charset,
                    'persistent' => $value->persistent,
                    'options' => [
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                        PDO::ATTR_PERSISTENT => $value->persistent,
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING,
                    ],
                ];

                switch ($value->adapter) {
                    case 'Oracle':
                        $conn = new Oracle($params);
                        $params['options'][PDO::ATTR_CASE] = PDO::CASE_UPPER;
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
                } elseif ($config->model->metadata->adapter == 'Apc') {
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
    protected function initSession($options = [])
    {

        $this->_di->setShared('session', function() {

            $connection = new Mysql([
                'host' => 'localhost',
                'username' => 'root',
                'password' => '!mpe123',
                'dbname' => 'intranet',
            ]);


            $session = new Session([
                'db' => $connection,
                'table' => 'session_data'
            ]);

            if ($session->status() !== $session::SESSION_ACTIVE) {
                $session->start();
            }

            return $session;
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initCache($options = [])
    {

        $config = $this->_di->get('config');

        $this->_di->setShared('cache', function() use ($config) {
            $lifetime = $config->cache->lifetime;

            $frontEndOptions = ['lifetime' => $lifetime];

            $frontCache = new CacheFront($frontEndOptions);

            $cache = new CacheBack($frontCache, [
                'host' => 'localhost',
                'port' => 11211,
                'persistent' => false,
            ]);

            return $cache;
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initResponse($options = [])
    {

        $config = $this->_di->get('config');

        $this->_di->setShared('response', function() use ($config) {
            $response = new \Phalcon\Http\Response();

            $environment = $config->application->environment != 'production' ? true : false;

            if ($environment) {

                $s = strtotime('midnight +2 day') - time();

                $ExpireDate = new \DateTime();
                $ExpireDate->modify('+' . $s . ' seconds');

                $response->setExpires($ExpireDate);

                $response->setHeader('Pragma', 'cache');
                $response->setHeader('Cache-Control', "public, max-age={$s}, s-max={$s}, must-revalidate, proxy-revalidate");
            }
            return $response;
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initView($options = [])
    {

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
                          'compileAlways' => (bool) $config->volt->compileAlways,
                          'stat' => (bool) $config->volt->stat,
                      ]
            );

            $compiler = $volt->getCompiler();

            $compiler->addFunction('dump', 'dump');
            $compiler->addFunction('count', 'count');
            $compiler->addFunction('number_format', 'number_format');
            $compiler->addFunction('str_replace', 'str_replace');
            $compiler->addFunction('explode', 'explode');
            $compiler->addFunction('implode', 'implode');
            $compiler->addFunction('array_unique', 'array_unique');

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
    protected function initElements($options = [])
    {

        $this->_di->setShared('elements', function() {
            return new Elements();
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initCookies($options = [])
    {

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
    protected function initAuth($options = [])
    {

        $this->_di->setShared('auth', function () {
            return new Auth();
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initAccess($options = [])
    {

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
    protected function initMail($options = [])
    {

        $this->_di->setShared('mail', function () {
            return new Mail();
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initSecurity($options = [])
    {

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
    protected function initValidator($options = [])
    {

        $this->_di->setShared('validator', function() {
            return new Validator();
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initFilter($options = [])
    {

        $this->_di->setShared('filter', function() {
            return new Filter();
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initRouter($options = [])
    {

        $this->_di->setShared('router', function () {

            $router = new Router();

            $router->setDefaultModule('intranet');
            $router->setDefaultNamespace('Intranet\Controllers');
            $router->removeExtraSlashes(true);

            return $router;
        });
    }

    protected function initTranslate($options = [])
    {

        $messages = [
            'nucleo' => 'Núcleo',
            'intranet' => 'Intranet',
            'telephony' => 'Telefonia',
            'forms' => 'Formulários',
            'otrs' => 'Otrs',
            //controlles
            'index' => 'Índice',
            'categories' => 'Categorias',
            'consultas' => 'Consultas',
            'actions' => 'Ações',
            'controllers' => 'Controladores',
            'departments' => 'Departamentos',
            'empresas' => 'Empresas',
            'funcionarios' => 'Funcionários',
            'groups' => 'Grupos',
            'users_groups' => 'Usuários x Grupos',
            'menus' => 'Menus',
            'modules' => 'Módulos',
            'perfils' => 'Perfis',
            'users' => 'Usuários',
            'documents' => 'Documentos',
            'access_line' => 'Acessos Exclusivos a Linhas',
            'cell_phone_line' => 'Cadastro de Linhas',
            'reports' => 'Relatórios',
            'gestao_acessos' => 'Gestão de Acessos - Formulários',
            'gestao_acessos_indicadores_sgi' => 'Gestão de Acessos - Indicadores SGI',
            'processos' => 'Processos',
            'atendimento' => 'Relatório de Chamados',
            'recibo_ferias' => 'Recibo de Férias',
            'indicadores_sgi' => 'Indicadores',
            'solicitacoes_acessos' => 'Acessos a Serviços de TI',
            'cadastro_clientes' => 'Cadastro de Clientes',
            'cadastro_produtos' => 'Cadastro de Produtos',
            'cadastro_servicos' => 'Cadastro de Serviços',
            'cadastro_fornecedores' => 'Cadastro de Fornecedores',
            'solicitacoes_garantias' => 'Seguro Garantia',
            'cadastro_centro_custos' => 'Cadastro de Centro de Custo',
            'cadastro_filiais' => 'Abertura de Filial',
            'coleta_rescisao' => 'Coleta de Informações para Rescisão Contratual',
            'solicitacoes_externas' => 'Solicitações Externas',
            //actions
            'fornecedores' => 'Fornecedores',
            'produtosServicos' => 'Produtos e Serviços',
            'centroCustos' => 'Centros de Custos',
            'requisitoMinimo' => 'Requisitos Mínimos',
            'naturezaFinanceira' => 'Naturezas Financeiras',
            'tes' => 'TES - Tipos de Entradas e Saídas',
            'secao' => 'Seções',
            'categories_documents' => 'Categorias de Documentos',
            'contaCelularAdmin' => 'Extrato Geral de Conta',
            'importTelephony' => 'Importar Extrato de Conta',
            'profile' => 'Perfil',
            'new' => 'Novo',
            'edit' => 'Editar',
            'comercialDocs' => 'Comercial',
            'comercialCats' => 'Comercial',
            'comercialProcess' => 'Comercial',
            'contabilidadeFiscalDocs' => 'Contabilidade e Fiscal',
            'contabilidadeFiscalCats' => 'Contabilidade e Fiscal',
            'contabilidadeFiscalProcess' => 'Contabilidade e Fiscal',
            'gestaoPessoasDocs' => 'Gestão de Pessoas (RH/DP)',
            'gestaoPessoasCats' => 'Gestão de Pessoas (RH/DP)',
            'gestaoPessoasProcess' => 'Gestão de Pessoas (RH/DP)',
            'financeiroDocs' => 'Financeiro',
            'financeiroCats' => 'Financeiro',
            'financeiroProcess' => 'Financeiro',
            'juridicoCats' => 'Jurídico',
            'juridicoDocs' => 'Jurídico',
            'juridicoProcess' => 'Jurídico',
            'sgiDocs' => 'SGI',
            'sgiCats' => 'SGI',
            'sgiProcess' => 'SGI',
            'suprimentosDocs' => 'Suprimentos',
            'suprimentosCats' => 'Suprimentos',
            'suprimentosProcess' => 'Suprimentos',
            'ticDocs' => 'TIC e Processos',
            'ticCats' => 'TIC e Processos',
            'ticProcess' => 'TIC e Processos',
            'clientes' => 'Clientes',
            'gestaoPessoasPortalRh' => 'Portal RH',
            'view' => 'Visualização',
            'controle' => 'Controle',
        ];

        $this->_di->setShared('translate', function() use ($messages) {
            return new Translator(['content' => $messages]);
        });
    }

    protected function initBreadcrumbs($options = [])
    {

        $this->_di->setShared('breadcrumbs', function() {
            return new Breadcrumbs;
        });
    }

    /**
     *
     * @param type $options
     */
    protected function initAssets($options = [])
    {

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
    protected function initModules($application)
    {
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
            'forms' => [
                'className' => 'Forms\Module',
                'path' => APP_PATH . '/app/modules/forms/Module.php'
            ],
            'catraca' => [
                'className' => 'Catraca\Module',
                'path' => APP_PATH . '/app/modules/catraca/Module.php'
            ],
            'otrs' => [
                'className' => 'Otrs\Module',
                'path' => APP_PATH . '/app/modules/otrs/Module.php'
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
    protected function initRouters($application)
    {

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
            'controller' => 'session',
            'action' => 'resetPassword'
        ]);
        $router->add('/change-password', [
            'namespace' => 'Nucleo\Controllers',
            'module' => 'nucleo',
            'controller' => 'session',
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
