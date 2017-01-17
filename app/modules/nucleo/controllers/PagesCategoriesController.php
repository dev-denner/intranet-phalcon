<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Nucleo\Controllers;

use App\Modules\Nucleo\Models\PagesCategories;
use App\Shared\Controllers\ControllerBase;

class PagesCategoriesController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle(' Páginas por Categorias ');
        parent::initialize();

        $this->entity = new PagesCategories();
    }

    /**
     * Index controller
     */
    public function indexAction() {
        try {
            $this->view->pages_categories = PagesCategories::find();
            $this->view->pesquisa = '';
            if ($this->request->isPost()) {
                $pages_categories = $this->request->getPost('pages_categories', 'string');
                $search = "UPPER(description) LIKE UPPER('%" . $pages_categories . "%')";
                $this->view->pages_categories = PagesCategories::find($search);
                $this->view->pesquisa = $this->request->getPost('pages_categories');
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

            $page_category = PagesCategories::findFirstByid($id);
            if (!$page_category) {
                throw new Exception('Páginas por Categorias não encontrado!');
            }

            $this->view->id = $page_category->id;
            $this->view->icon = $page_category->icon;

            $this->tag->setDefault('id', $page_category->getId());
            $this->tag->setDefault('description', $page_category->getDescription());
            $this->tag->setDefault('category', $page_category->getCategory());
            $this->tag->setDefault('department', $page_category->getDepartment());
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/pages_categories');
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

            $page_category = $this->entity;

            $page_category->setId($page_category->autoincrement());
            $page_category->setDescription($this->request->getPost('description'));
            $page_category->setCategory($this->request->getPost('category'));
            $page_category->setDepartment($this->request->getPost('department'));

            if (!$page_category->create()) {
                $msg = '';
                foreach ($page_category->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Páginas por Categorias gravado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/pages_categories');
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

            $page_category = PagesCategories::findFirstByid($id);
            if (!$page_category) {
                throw new Exception('Páginas por Categorias não encontrado!');
            }

            $page_category->setId($this->request->getPost('id'));
            $page_category->setDescription($this->request->getPost('description'));
            $page_category->setCategory($this->request->getPost('category'));
            $page_category->setDepartment($this->request->getPost('department'));

            if (!$page_category->update()) {

                $msg = '';
                foreach ($page_category->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Páginas por Categorias atualizado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/pages_categories');
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

            $page_category = PagesCategories::findFirstByid($id);
            if (!$page_category) {
                throw new Exception('Páginas por Categorias não encontrado!');
            }

            if (!$page_category->delete()) {

                $msg = '';
                foreach ($page_category->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/pages_categories');
        }
    }

}
