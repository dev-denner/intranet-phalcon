<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Intranet\Controllers;

use App\Shared\Controllers\ControllerBase;
use App\Modules\Nucleo\Models\Departments;

class DocumentsController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Documentos');
        parent::initialize();
    }

    public function indexAction() {
        try {
            $this->view->departaments = Departments::find(['order' => 'id']);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function comercialDocsAction() {
        try {
            $this->view->departaments = Departments::findById(2);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/documents/index');
    }

    public function contabilidadeFiscalDocsAction() {
        try {
            $this->view->departaments = Departments::findById(3);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/documents/index');
    }

    public function gestaoPessoasDocsAction() {
        try {
            $this->view->departaments = Departments::findById(4);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/documents/index');
    }

    public function financeiroDocsAction() {
        try {
            $this->view->departaments = Departments::findById(5);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/documents/index');
    }

    public function juridicoDocsAction() {
        try {
            $this->view->departaments = Departments::findById(6);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/documents/index');
    }

    public function sgiDocsAction() {
        try {
            $this->view->departaments = Departments::findById(7);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/documents/index');
    }

    public function suprimentosDocsAction() {
        try {
            $this->view->departaments = Departments::findById(8);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/documents/index');
    }

    public function ticDocsAction() {
        try {
            $this->view->departaments = Departments::findById(9);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/documents/index');
    }

    public function gestaoPessoasPortalRhAction() {
        try {
            $this->view->departaments = Departments::findById(4);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

}
