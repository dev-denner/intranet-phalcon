<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Telephony;

/**
 * Class Routes
 * @package Cnab
 */
class Routes {

    /**
     * Add routes
     * @param \Phalcon\Mvc\Router() $router
     */
    public function init($router) {
        $router->add('/:module/:controller/:action/:params', array(
            'module' => 1,
            'controller' => 2,
            'action' => 3,
            'params' => 4
        ));
    }

}
