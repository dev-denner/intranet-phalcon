<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

use Nucleo\Models\UsersGroups;
use SysPhalcon\Controllers\ControllerBase;

class UsersGroupsController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle(' Grupos x Usuários ');
        parent::initialize();

        $this->entity = new UsersGroups();
    }

    /**
     * Index action
     */
    public function indexAction() {
        try {
            $this->view->users_groups = UsersGroups::find();
            $this->view->pesquisa = '';

            if ($this->request->isPost()) {

                $users = $this->request->getPost('userId', 'int');
                $groups = $this->request->getPost('groupId', 'int');

                $search = '1 = 1 ';
                if (!empty($this->request->getPost('userId'))) {
                    $search .= " AND UPPER(userId) LIKE UPPER('%{$users}%') ";
                }
                if (!empty($this->request->getPost('groupId'))) {
                    $search .= " AND UPPER(groupId) LIKE UPPER('%{$groups}%') ";
                }

                $this->view->users_groups = UsersGroups::find($search);
                $this->view->pesquisa = 'Usuários: ' . $users . ' | Grupos: ' . $groups;
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
     * Edits a users_group
     *
     * @param string $id
     */
    public function editAction($id) {
        try {

            if ($this->request->isPost()) {
                throw new Exception('Acesso inválido a essa action!!!');
            }

            $users_group = UsersGroups::findFirstByid($id);
            if (!$users_group) {
                throw new Exception('Grupo x Usuário não encontrado!');
            }

            $this->view->id = $users_group->id;

            $this->tag->setDefault('id', $users_group->getId());
            $this->tag->setDefault('userId', $users_group->getUserId());
            $this->tag->setDefault('groupId', $users_group->getGroupId());
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/users_groups');
        }
    }

    /**
     * Creates a new users_group
     */
    public function createAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $users_group = new UsersGroups();

            $users_group->setId($users_group->autoincrement());
            $users_group->setUserId($this->request->getPost('userId'));
            $users_group->setGroupId($this->request->getPost('groupId'));

            if (!$users_group->create()) {
                $msg = '';
                foreach ($users_group->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Grupo x Usuário gravado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/users_groups');
    }

    /**
     * Saves a users_group edited
     *
     */
    public function saveAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $id = $this->request->getPost('id');

            $users_group = UsersGroups::findFirstByid($id);
            if (!$users_group) {
                throw new Exception('Grupo x Usuário não encontrado!');
            }

            $users_group->setId($this->request->getPost('id'));
            $users_group->setUserId($this->request->getPost('userId'));
            $users_group->setGroupId($this->request->getPost('groupId'));

            if (!$users_group->update()) {

                $msg = '';
                foreach ($users_group->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Grupo x Usuário atualizado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/users_groups');
    }

    /**
     * Deletes a users_group
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

            $users_group = UsersGroups::findFirstByid($id);
            if (!$users_group) {
                throw new Exception('Grupo x Usuário não encontrado!');
            }

            if (!$users_group->delete()) {

                $msg = '';
                foreach ($users_group->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/users_groups');
        }
    }

}
