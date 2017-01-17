<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Nucleo\Controllers;

use App\Modules\Nucleo\Models\Departments;
use App\Shared\Controllers\ControllerBase;

class DepartmentsController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle(' Departamentos ');
        parent::initialize();

        $this->entity = new Departments();
    }

    /**
     * Index department
     */
    public function indexAction() {
        try {
            $this->view->departments = Departments::find();
            $this->view->pesquisa = '';
            if ($this->request->isPost()) {
                $departments = $this->request->getPost('departments', 'string');
                $search = "(UPPER(title) LIKE UPPER('%" . $departments . "%') OR UPPER(cc) LIKE UPPER('%" . $departments . "%'))";
                $this->view->departments = Departments::find($search);
                $this->view->pesquisa = $this->request->getPost('departments');
            }
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

    /**
     * Displays the creation form
     */
    public function newAction() {
        $this->assets->collection('footerJs')->addJs('app/commons/icon.js');
    }

    /**
     * Edits a department
     *
     * @param string $id
     */
    public function editAction($id) {
        try {

            if ($this->request->isPost()) {
                throw new Exception('Acesso inválido a essa action!!!');
            }
            $this->assets->collection('footerJs')->addJs('app/commons/icon.js');
            $department = Departments::findFirstByid($id);
            if (!$department) {
                throw new Exception('Departamento não encontrado!');
            }

            $this->view->id = $department->id;
            $this->view->icon = $department->icon;

            $this->tag->setDefault('id', $department->getId());
            $this->tag->setDefault('title', $department->getTitle());
            $this->tag->setDefault('cc', $department->getCc());
            $this->tag->setDefault('icon', $department->getIcon());
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/departments');
        }
    }

    /**
     * Creates a new department
     */
    public function createAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $department = $this->entity;

            $department->setId($department->autoincrement());
            $department->setTitle($this->request->getPost('title'));
            $department->setCc($this->request->getPost('cc'));
            $department->setIcon($this->request->getPost('icon'));

            if (!$department->create()) {
                $msg = '';
                foreach ($department->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Departamento gravado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/departments');
    }

    /**
     * Saves a department edited
     *
     */
    public function saveAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $id = $this->request->getPost('id');

            $department = Departments::findFirstByid($id);
            if (!$department) {
                throw new Exception('Departamento não encontrado!');
            }

            $department->setId($this->request->getPost('id'));
            $department->setTitle($this->request->getPost('title'));
            $department->setCc($this->request->getPost('cc'));
            $department->setIcon($this->request->getPost('icon'));

            if (!$department->update()) {

                $msg = '';
                foreach ($department->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Departamento atualizado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/departments');
    }

    /**
     * Deletes a department
     *
     * @param string $id
     */
    public function deleteAction() {

        try {
            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            if ($this->request->isAjax()) {
                $this->view->disable();
            }

            $id = $this->request->getPost('id');

            $department = Departments::findFirstByid($id);
            if (!$department) {
                throw new Exception('Departamento não encontrado!');
            }

            if (!$department->delete()) {

                $msg = '';
                foreach ($department->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/departments');
        }
    }

}
