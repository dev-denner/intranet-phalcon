<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Nucleo\Controllers;

use App\Shared\Controllers\ControllerBase;

class ErrorsController extends ControllerBase {

    public function initialize() {
        parent::initialize();
        $this->view->setTemplateBefore('public');
    }

    public function show404Action() {
        $this->tag->setTitle('Oops! Não Encontrado');
        $this->response->setStatusCode(404, "Não Encontrado");
    }

    public function show401Action() {
        $this->tag->setTitle('Oops! Não Autorizado');
        $this->response->setStatusCode(401, "Não Autorizado");
    }

    public function show500Action() {
        $this->tag->setTitle('Oops! Erro Interno');
        $this->response->setStatusCode(500, "Erro Interno");
    }

}
