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
                'Nucleo\Controllers' => __DIR__ . '/controllers',
                'Nucleo\Models' => __DIR__ . '/models',
                'Nucleo\Forms' => __DIR__ . '/forms',
            )
    );

    $loader->registerDirs(
            array(
                $config->application->controllersDir,
                $config->application->modelsDir,
                $config->application->viewsDir,
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

    $config = $this->_config;
    $configShared = $di->get('config');
    $vDI = $di;

    //Registering a dispatcher
    $di->set('dispatcherNucleo', function() {
      $dispatcher = new Dispatcher();
      $dispatcher->setDefaultNamespace('Nucleo');
      return $dispatcher;
    });

    //Registering the view component

    $di->set(
            'volt', function($view, $vDI) use($config, $configShared) {
      $volt = new Volt($view, $vDI);
      $volt->setOptions(
              array(
                  'compiledPath' => $configShared->volt->path,
                  'compiledExtension' => $configShared->volt->extension,
                  'compiledSeparator' => $configShared->volt->separator,
                  'stat' => (bool) $configShared->volt->stat,
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
      $view->setViewsDir($config->application->viewsDir);
      $view->registerEngines(array('.volt' => 'volt'));
      return $view;
    }
    );

    return $di;
  }

}
