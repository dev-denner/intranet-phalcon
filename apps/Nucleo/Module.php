<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\View\Engine\Volt;
use Phalcon\Db\Adapter\Pdo\Mysql as DbAdapter;
use Phalcon\Mvc\ModuleDefinitionInterface;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Config\Adapter\Ini;

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
    $this->_config = new Ini(APP_PATH . "/apps/Nucleo/config/config.ini");
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
                'Nucleo\Controllers' => __DIR__ . '/Controllers',
                'Nucleo\Models' => __DIR__ . '/Models',
                'Nucleo\Forms' => __DIR__ . '/Forms',
                'Nucleo\Library' => __DIR__ . '/Library',
            )
    );

    $loader->registerDirs(
            array(
                APP_PATH . $config->application->controllersDir,
                APP_PATH . $config->application->modelsDir,
                APP_PATH . $config->application->viewsDir,
                APP_PATH . $config->application->migrationsDir,
                APP_PATH . $config->application->pluginsDir,
                APP_PATH . $config->application->libraryDir,
                APP_PATH . $config->application->formsDir,
            )
    );

    $loader->register();
  }

  /**
   * Register specific services for the module
   * @param \Phalcon\DiInterface $di
   */
  public function registerServices(DiInterface $di) {
    $config = $this->_config;

    //Registering a dispatcher
    $di->set('dispatcher', function() {
      $dispatcher = new Dispatcher();
      $dispatcher->setDefaultNamespace('Nucleo');
      return $dispatcher;
    });

    //Registering the view component

    $vDI = $di;

    $di->set(
            'volt', function($view, $vDI) use($config) {
      $volt = new Volt($view, $vDI);
      $volt->setOptions(
              array(
                  'compiledPath' => APP_PATH . $config->volt->path,
                  'compiledExtension' => $config->volt->extension,
                  'compiledSeparator' => $config->volt->separator,
                  'stat' => (bool) $config->volt->stat,
              )
      );

      $compiler = $volt->getCompiler();

      //Add funcao
      $compiler->addFunction('is_a', 'is_a');

      return $volt;
    }
    );

    /**
     * Configura o serviÃ§o de view
     */
    $di->set('view', function() use ($config, $vDI) {
      $view = new View();
      $view->setViewsDir(APP_PATH . $config->application->viewsDir);
      $view->registerEngines(array('.volt' => 'volt'));
      return $view;
    }
    );

    /**
     * Database connection is created based in the parameters defined in the configuration file
     */
    $di->set('db', function () use ($config) {
      return new DbAdapter($config->database->toArray());
    });
    
    return $di;
  }

}
