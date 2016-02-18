<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\DI\FactoryDefault as Di;

class ControllerBase extends Controller {

    protected $uri;

    public function initialize() {

        //$di = Di::getDefault();
        
        $di = $this->di->get('config');
        $this->uri = $di->application->baseUri;

        $this->tag->prependTitle('API PHALCON | ');
        $this->tag->appendTitle(' | Main');
        $this->view->setTemplateAfter('main');
        $this->view->titleLogo = 'API PHALCON';
    }

}
