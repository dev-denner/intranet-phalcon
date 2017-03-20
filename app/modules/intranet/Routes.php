<?php

namespace App\Modules\Intranet;

class Routes
{

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
