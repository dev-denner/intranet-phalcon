<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       30/06/2015 02:59:13
 *
 */
        

namespace Nucleo;

use Phalcon\DiInterface;
use Phalcon\Loader;
use Phalcon\Mvc\View;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Mvc\ModuleDefinitionInterface;

/**
 * Class Module
 * @package Nucleo
 */
class Module implements ModuleDefinitionInterface
{
    /**
     * Register a specific autoloader for the module
     * @param \Phalcon\DiInterface $di
     */
    public function registerAutoloaders(DiInterface $di = null)
    {
        $loader = new Loader();
        $loader->registerNamespaces(
            array(
                'Nucleo\Controllers' => __DIR__ . '/Controllers',
                'Nucleo\Models' => __DIR__ . '/Models'
            )
        );
        $loader->register();
    }

    /**
     * Register specific services for the module
     * @param \Phalcon\DiInterface $di
     */
    public function registerServices(DiInterface $di)
    {
        //Registering a dispatcher
        $di->set('dispatcher', function() {
            $dispatcher = new Dispatcher();
            $dispatcher->setDefaultNamespace('Nucleo');
            return $dispatcher;
        });

        //Registering the view component
        $di->set('view', function() {
            $view = new View();
            $view->setViewsDir(__DIR__ . '/Views');
            return $view;
        });
    }
}