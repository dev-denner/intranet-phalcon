<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       30/06/2015 02:59:13
 *
 */
        

namespace Nucleo;

/**
 * Class Routes
 * @package Nucleo
 */
class Routes
{
    /**
     * Add routes
     * @param \Phalcon\Mvc\Router() $router
     */
    public function init($router)
    {
        $router->add('/:module/:controller/:action/:params', array(
            'module' => 1,
            'controller' => 2,
            'action' => 3,
            'params' => 4
        ));
    }
}