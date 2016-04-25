<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

use Nucleo\Models\Perfils;
use DevDenners\Controllers\ControllerBase;

class PerfilsController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle(' Perfis ');
        parent::initialize();

        $this->entity = new Perfils();
    }

    /**
     * Index action
     */
    public function indexAction() {
        try {
            $this->view->perfils = Perfils::find();
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

                $this->view->perfils = Perfils::find($search);
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
     * Edits a perfil
     *
     * @param string $id
     */
    public function editAction($id) {
        try {

            if ($this->request->isPost()) {
                throw new Exception('Acesso inválido a essa action!!!');
            }

            $perfil = Perfils::findFirstByid($id);
            if (!$perfil) {
                throw new Exception('Perfil não encontrado!');
            }

            $this->view->id = $perfil->id;

            $this->tag->setDefault('id', $perfil->getId());
            $this->tag->setDefault('userId', $perfil->getUserId());
            $this->tag->setDefault('groupId', $perfil->getGroupId());
            $this->tag->setDefault('module', $perfil->getModule());
            $this->tag->setDefault('controller', $perfil->getController());
            $this->tag->setDefault('action', $perfil->getAction());
            $this->tag->setDefault('permission', $perfil->getPermission());
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/perfils');
        }
    }

    /**
     * Creates a new perfil
     */
    public function createAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $perfil = new Perfils();

            $perfil->setId($perfil->autoincrement());
            if (!empty($this->request->getPost('userId'))) {
                $perfil->setUserId($this->request->getPost('userId'));
            } else {
                $perfil->setGroupId($this->request->getPost('groupId'));
            }

            $perfil->setModule($this->request->getPost('module'));
            $perfil->setController($this->request->getPost('controller'));
            $perfil->setAction($this->request->getPost('action'));
            $perfil->setPermission($this->request->getPost('permission'));

            if (!$perfil->create()) {
                $msg = '';
                foreach ($perfil->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Perfil gravado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/perfils');
    }

    /**
     * Saves a perfil edited
     *
     */
    public function saveAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $id = $this->request->getPost('id');

            $perfil = Perfils::findFirstByid($id);
            if (!$perfil) {
                throw new Exception('Perfil não encontrado!');
            }

            $perfil->setId($this->request->getPost('id'));
            if (!empty($this->request->getPost('userId'))) {
                $perfil->setUserId($this->request->getPost('userId'));
            } else {
                $perfil->setGroupId($this->request->getPost('groupId'));
            }
            $perfil->setModule($this->request->getPost('module'));
            $perfil->setController($this->request->getPost('controller'));
            $perfil->setAction($this->request->getPost('action'));
            $perfil->setPermission($this->request->getPost('permission'));

            if (!$perfil->update()) {

                $msg = '';
                foreach ($perfil->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Perfil atualizado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/perfils');
    }

    /**
     * Deletes a perfil
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

            $perfil = Perfils::findFirstByid($id);
            if (!$perfil) {
                throw new Exception('Perfil não encontrado!');
            }

            if (!$perfil->delete()) {

                $msg = '';
                foreach ($perfil->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/perfils');
        }
    }

}
