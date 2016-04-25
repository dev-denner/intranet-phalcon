<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Intranet\Controllers;

use DevDenners\Controllers\ControllerBase;

class IndexController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Home');
        parent::initialize();
    }

    public function indexAction() {

    }

    public function categoriesAction($idDepartment) {

        try {

            if (is_numeric($idDepartment)) {
                $id = $this->filter->sanitize($idDepartment, 'int');
            } else {
                $id = $this->filter->sanitize($idDepartment, 'alphanum');
            }
            $this->view->idDepartment = $id;
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

}
