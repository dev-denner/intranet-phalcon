<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Intranet\Controllers;

use SysPhalcon\Controllers\ControllerBase;
use Nucleo\Models\Departments;

class CategoriesController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Documentos');
        parent::initialize();
    }

    public function indexAction($idDepartment) {
        try {

            if (is_numeric($idDepartment)) {
                $id = $this->filter->sanitize($idDepartment, 'int');

                switch ($id) {
                    case 2:
                        return $this->response->redirect('categories/comercialCats');
                        break;
                    case 3:
                        return $this->response->redirect('categories/contabilidadeFiscalCats');
                        break;
                    case 4:
                        return $this->response->redirect('categories/gestaoPessoasCats');
                        break;
                    case 5:
                        return $this->response->redirect('categories/financeiroCats');
                        break;
                    case 6:
                        return $this->response->redirect('categories/juridicoCats');
                        break;
                    case 7:
                        return $this->response->redirect('categories/sgiCats');
                        break;
                    case 8:
                        return $this->response->redirect('categories/suprimentosCats');
                        break;
                    case 9:
                        return $this->response->redirect('categories/ticCats');
                        break;
                    default:
                        $this->view->idDepartment = $id;
                        break;
                }
            } else {
                $id = $this->filter->sanitize($idDepartment, 'alphanum');
            }
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

    public function comercialCatsAction() {
        try {
            $this->view->idDepartment = 2;
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/categories/index');
    }

    public function contabilidadeFiscalCatsAction() {
        try {
            $this->view->idDepartment = 3;
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/categories/index');
    }

    public function gestaoPessoasCatsAction() {
        try {
            $this->view->idDepartment = 4;
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/categories/index');
    }

    public function financeiroCatsAction() {
        try {
            $this->view->idDepartment = 5;
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/categories/index');
    }

    public function juridicoCatsAction() {
        try {
            $this->view->idDepartment = 6;
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/categories/index');
    }

    public function sgiCatsAction() {
        try {
            $this->view->idDepartment = 7;
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/categories/index');
    }

    public function suprimentosCatsAction() {
        try {
            $this->view->idDepartment = 8;
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/categories/index');
    }

    public function ticCatsAction() {
        try {
            $this->view->idDepartment = 9;
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/categories/index');
    }

}
