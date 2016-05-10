<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

use Nucleo\Models\Categories;
use SysPhalcon\Controllers\ControllerBase;

class CategoriesController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle(' Categorias ');
        parent::initialize();

        $this->entity = new Categories();
    }

    /**
     * Index controller
     */
    public function indexAction() {
        try {
            $this->view->categories = Categories::find();
            $this->view->pesquisa = '';
            if ($this->request->isPost()) {
                $search = "(UPPER(title) LIKE UPPER('%" . $this->request->getPost('categories', 'string') . "%') OR UPPER(description) LIKE UPPER('%" . $this->request->getPost('categories', 'string') . "%'))";
                $this->view->categories = Categories::find($search);
                $this->view->pesquisa = $this->request->getPost('categories');
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
     * Edits a controller
     *
     * @param string $id
     */
    public function editAction($id) {
        try {

            if ($this->request->isPost()) {
                throw new Exception('Acesso inválido a essa action!!!');
            }

            $this->assets->collection('footerJs')->addJs('app/commons/icon.js');

            $category = Categories::findFirstByid($id);
            if (!$category) {
                throw new Exception('Categoria não encontrada!');
            }

            $this->view->id = $category->id;
            $this->view->icon = $category->icon;

            $this->tag->setDefault('id', $category->getId());
            $this->tag->setDefault('title', $category->getTitle());
            $this->tag->setDefault('description', $category->getDescription());
            $this->tag->setDefault('icon', $category->getIcon());
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/categories');
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

            $category = $this->entity;

            $category->setId($category->autoincrement());
            $category->setTitle($this->request->getPost('title'));
            $category->setDescription($this->request->getPost('description'));
            $category->setIcon($this->request->getPost('icon'));

            if (!$category->create()) {
                $msg = '';
                foreach ($category->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Categoria gravada com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/categories');
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

            $category = Categories::findFirstByid($id);
            if (!$category) {
                throw new Exception('Categoria não encontrada!');
            }

            $category->setId($this->request->getPost('id'));
            $category->setTitle($this->request->getPost('title'));
            $category->setDescription($this->request->getPost('description'));
            $category->setIcon($this->request->getPost('icon'));

            if (!$category->update()) {

                $msg = '';
                foreach ($category->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Categoria atualizada com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/categories');
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

            $category = Categories::findFirstByid($id);
            if (!$category) {
                throw new Exception('Categoria não encontrada!');
            }

            if (!$category->delete()) {

                $msg = '';
                foreach ($category->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/categories');
        }
    }

}
