<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Intranet;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\Dispatcher;

/**
 * Class Module
 * @package Nucleo
 */
class Module implements ModuleDefinitionInterface {

    private $_config;

    /**
     * Constructor
     *
     * @param $di
     */
    public function __construct() {
        $this->_config = include __DIR__ . '/config/config.php';
    }

    /**
     * Register a specific autoloader for the module
     * @param \Phalcon\DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null) {

        $config = $this->_config;

        $loader = new Loader();
        $loader->registerNamespaces(
                array(
                    __NAMESPACE__ . '\Controllers' => __DIR__ . '/controllers',
                    __NAMESPACE__ . '\Models' => __DIR__ . '/models',
                    __NAMESPACE__ . '\Forms' => __DIR__ . '/forms',
                )
        );

        $loader->registerDirs(
                array(
                    $config->application->controllersDir,
                    $config->application->modelsDir,
                    $config->application->migrationsDir,
                    $config->application->formsDir,
                )
        );

        $loader->register();
    }

    /**
     * Register specific services for the module
     * @param \Phalcon\DiInterface $di
     */
    public function registerServices(DiInterface $di) {

        return $di;
    }

}
