<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

use Nucleo\Models\Groups;
use Nucleo\Models\TablesSystem;
use SysPhalcon\Controllers\ControllerBase;

class GroupsController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle(' Grupos ');
        parent::initialize();

        $this->entity = new Groups();
    }

    /**
     * Index action
     */
    public function indexAction() {
        try {
            $this->view->groups = Groups::find();
            if ($this->request->isPost()) {
                $this->view->groups = Groups::find("UPPER(name) LIKE UPPER('%" . $this->request->getPost('groups', 'string') . "%')");
                $this->view->pesquisa = $this->request->getPost('groups');
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
     * Edits a group
     *
     * @param string $id
     */
    public function editAction($id) {
        try {

            if ($this->request->isPost()) {
                throw new Exception('Acesso inválido a essa action!!!');
            }

            $group = Groups::findFirstByid($id);
            if (!$group) {
                throw new Exception('Grupo não encontrado!');
            }

            $this->view->id = $group->id;
            $this->view->isPublic = $group->isPublic;

            $this->tag->setDefault('id', $group->getId());
            $this->tag->setDefault('name', $group->getName());
            $this->tag->setDefault('status', $group->getStatus());
            $this->tag->setDefault('isPublic', $group->getIsPublic());
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/groups');
        }
    }

    /**
     * Creates a new group
     */
    public function createAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $group = new Groups();

            $group->setId($group->autoincrement());
            $group->setName($this->request->getPost('name'));
            $group->setStatus($this->request->getPost('status'));
            $group->setIsPublic($this->request->getPost('isPublic'));

            if (!$group->create()) {
                $msg = '';
                foreach ($group->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Grupo gravado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/groups');
    }

    /**
     * Saves a group edited
     *
     */
    public function saveAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $id = $this->request->getPost('id');

            $group = Groups::findFirstByid($id);
            if (!$group) {
                throw new Exception('Grupo não encontrado!');
            }

            $group->setId($this->request->getPost('id'));
            $group->setName($this->request->getPost('name'));
            $group->setStatus($this->request->getPost('status'));
            $group->setIsPublic($this->request->getPost('isPublic'));


            if (!$group->update()) {

                $msg = '';
                foreach ($group->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Grupo atualizado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/groups');
    }

    /**
     * Deletes a group
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

            $group = Groups::findFirstByid($id);
            if (!$group) {
                throw new Exception('Grupo não encontrado!');
            }

            if (!$group->delete()) {

                $msg = '';
                foreach ($group->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/groups');
        }
    }

}
