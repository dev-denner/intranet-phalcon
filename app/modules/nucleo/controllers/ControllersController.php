<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

use Nucleo\Models\Controllers;
use SysPhalcon\Controllers\ControllerBase;

class ControllersController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle(' Controladores ');
        parent::initialize();

        $this->entity = new Controllers();
    }

    /**
     * Index controller
     */
    public function indexAction() {
        try {
            $this->view->controllers = Controllers::find();
            $this->view->pesquisa = '';
            if ($this->request->isPost()) {
                $search = "(UPPER(title) LIKE UPPER('%" . $this->request->getPost('controllers', 'string') . "%') OR UPPER(slug) LIKE UPPER('%" . $this->request->getPost('controllers', 'string') . "%'))";
                $this->view->controllers = Controllers::find($search);
                $this->view->pesquisa = $this->request->getPost('controllers');
            }
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

    /**
     * Displays the creation form
     */
    public function newAction() {

    }

    /**
     * Edits a controller
     *
     * @param string $id
     */
    public function editAction($id) {
        try {

            if ($this->request->isPost()) {
                throw new Exception('Acesso inválido a essa action!!!');
            }

            $controller = Controllers::findFirstByid($id);
            if (!$controller) {
                throw new Exception('Controlador não encontrado!');
            }

            $this->view->id = $controller->id;

            $this->tag->setDefault('id', $controller->getId());
            $this->tag->setDefault('title', $controller->getTitle());
            $this->tag->setDefault('slug', $controller->getSlug());
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/controllers');
        }
    }

    /**
     * Creates a new controller
     */
    public function createAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $controller = $this->entity;

            $controller->setId($controller->autoincrement());
            $controller->setTitle($this->request->getPost('title'));
            $controller->setSlug($this->request->getPost('slug'));

            if (!$controller->create()) {
                $msg = '';
                foreach ($controller->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Controlador gravado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/controllers');
    }

    /**
     * Saves a controller edited
     *
     */
    public function saveAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $id = $this->request->getPost('id');

            $controller = Controllers::findFirstByid($id);
            if (!$controller) {
                throw new Exception('Controlador não encontrado!');
            }

            $controller->setId($this->request->getPost('id'));
            $controller->setTitle($this->request->getPost('title'));
            $controller->setSlug($this->request->getPost('slug'));

            if (!$controller->update()) {

                $msg = '';
                foreach ($controller->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Controlador atualizado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/controllers');
    }

    /**
     * Deletes a controller
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

            $controller = Controllers::findFirstByid($id);
            if (!$controller) {
                throw new Exception('Controlador não encontrado!');
            }

            if (!$controller->delete()) {

                $msg = '';
                foreach ($controller->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/controllers');
        }
    }

}
