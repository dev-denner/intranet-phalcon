<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

use Nucleo\Models\CategoriesDocuments;
use SysPhalcon\Controllers\ControllerBase;

class CategoriesDocumentsController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle(' Documentos de Categorias ');
        parent::initialize();

        $this->entity = new CategoriesDocuments();
    }

    /**
     * Index controller
     */
    public function indexAction() {
        try {
            $this->view->categories_documents = CategoriesDocuments::find();
            $this->view->pesquisa = '';
            if ($this->request->isPost()) {
                $categories_documents = $this->request->getPost('categories_documents', 'string');
                $search = "UPPER(description) LIKE UPPER('%" . $categories_documents . "%')";
                $this->view->categories_documents = CategoriesDocuments::find($search);
                $this->view->pesquisa = $this->request->getPost('categories_documents');
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

            $categoryDocument = CategoriesDocuments::findFirstByid($id);
            if (!$categoryDocument) {
                throw new Exception('Documentos de Categorias não encontrado!');
            }

            $this->view->id = $categoryDocument->id;
            $this->view->icon = $categoryDocument->icon;

            $this->tag->setDefault('id', $categoryDocument->getId());
            $this->tag->setDefault('description', $categoryDocument->getDescription());
            $this->tag->setDefault('category', $categoryDocument->getCategory());
            $this->tag->setDefault('department', $categoryDocument->getDepartment());
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/categories_documents');
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

            $categoryDocument = $this->entity;

            $categoryDocument->setId($categoryDocument->autoincrement());
            $categoryDocument->setDescription($this->request->getPost('description'));
            $categoryDocument->setCategory($this->request->getPost('category'));
            $categoryDocument->setDepartment($this->request->getPost('department'));

            if (!$categoryDocument->create()) {
                $msg = '';
                foreach ($categoryDocument->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Documentos de Categorias gravado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/categories_documents');
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

            $categoryDocument = CategoriesDocuments::findFirstByid($id);
            if (!$categoryDocument) {
                throw new Exception('Documentos de Categorias não encontrado!');
            }

            $categoryDocument->setId($this->request->getPost('id'));
            $categoryDocument->setDescription($this->request->getPost('description'));
            $categoryDocument->setCategory($this->request->getPost('category'));
            $categoryDocument->setDepartment($this->request->getPost('department'));

            if (!$categoryDocument->update()) {

                $msg = '';
                foreach ($categoryDocument->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Documentos de Categorias atualizado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/categories_documents');
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

            $categoryDocument = CategoriesDocuments::findFirstByid($id);
            if (!$categoryDocument) {
                throw new Exception('Documentos de Categorias não encontrado!');
            }

            if (!$categoryDocument->delete()) {

                $msg = '';
                foreach ($categoryDocument->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/categories_documents');
        }
    }

}
