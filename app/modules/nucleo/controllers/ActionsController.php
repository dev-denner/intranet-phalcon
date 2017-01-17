<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Nucleo\Controllers;

use App\Modules\Nucleo\Models\Actions;
use App\Shared\Controllers\ControllerBase;

class ActionsController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle(' Ações ');
        parent::initialize();

        $this->entity = new Actions();
    }

    /**
     * Index action
     */
    public function indexAction() {
        try {
            $this->view->actions = Actions::find();
            $this->view->pesquisa = '';
            if ($this->request->isPost()) {
                $post = $this->request->getPost('actions', 'string');
                $search = "(UPPER(title) LIKE UPPER('%" . $post . "%')
                         OR UPPER(slug) LIKE UPPER('%" . $post . "%')
                         OR UPPER(description) LIKE UPPER('%" . $post . "%'))";
                $this->view->actions = Actions::find($search);
                $this->view->pesquisa = $this->request->getPost('actions');
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

    /**
     * Displays the creation form
     */
    public function newAction() {

    }

    /**
     * Edits a action
     *
     * @param string $id
     */
    public function editAction($id) {
        try {

            if ($this->request->isPost()) {
                throw new Exception('Acesso inválido a essa action!!!');
            }

            $action = Actions::findFirstByid($id);
            if (!$action) {
                throw new Exception('Ação não encontrado!');
            }

            $this->view->id = $action->id;

            $this->tag->setDefault('id', $action->getId());
            $this->tag->setDefault('title', $action->getTitle());
            $this->tag->setDefault('slug', $action->getSlug());
            $this->tag->setDefault('description', $action->getDescription());
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/actions');
        }
    }

    /**
     * Creates a new action
     */
    public function createAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $action = new Actions();

            $action->setId($action->autoincrement());
            $action->setTitle($this->request->getPost('title'));
            $action->setSlug($this->request->getPost('slug'));
            $action->setDescription($this->request->getPost('description'));

            if (!$action->create()) {
                $msg = '';
                foreach ($action->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Ação gravada com sucesso!!!');
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/actions');
    }

    /**
     * Saves a action edited
     *
     */
    public function saveAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $id = $this->request->getPost('id');

            $action = Actions::findFirstByid($id);
            if (!$action) {
                throw new \Exception('Ação não encontrado!');
            }

            $action->setId($this->request->getPost('id'));
            $action->setTitle($this->request->getPost('title'));
            $action->setSlug($this->request->getPost('slug'));
            $action->setDescription($this->request->getPost('description'));

            if (!$action->update()) {

                $msg = '';
                foreach ($action->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new \Exception($msg);
            }

            $this->flash->success('Ação atualizada com sucesso!!!');
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/actions');
    }

    /**
     * Deletes a action
     *
     * @param string $id
     */
    public function deleteAction() {

        try {
            if (!$this->request->isPost()) {
                throw new \Exception('Acesso não permitido a essa action.');
            }

            if ($this->request->isAjax()) {
                $this->view->disable();
            }

            $id = $this->request->getPost('id');

            $action = Actions::findFirstByid($id);
            if (!$action) {
                throw new \Exception('Ação não encontrada!');
            }

            if (!$action->delete()) {

                $msg = '';
                foreach ($action->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new \Exception($msg);
            }
            echo 'ok';
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/actions');
        }
    }

}
