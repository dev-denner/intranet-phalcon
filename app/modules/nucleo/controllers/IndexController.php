<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Nucleo\Controllers;

use App\Shared\Controllers\ControllerBase;

class IndexController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Home');
        parent::initialize();
    }

    public function indexAction() {

    }

}
