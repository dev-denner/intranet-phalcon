<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

use Nucleo\Models\Users;
use Nucleo\Models\Protheus\Colaboradores;
use Nucleo\Models\RM\Pfunc;
use DevDenners\Controllers\ControllerBase;

class UsersController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle(' Usuários ');
        parent::initialize();

        $this->entity = new Users();
    }

    /**
     * Index user
     */
    public function indexAction() {
        try {
            $this->view->users = Users::find();
            $this->view->pesquisa = '';
            if ($this->request->isPost()) {
                $users = $this->request->getPost('users', 'string');
                $search = "(UPPER(cpf) LIKE UPPER('%" . $users . "%') OR UPPER(email) LIKE UPPER('%" . $users . "%'))";
                $this->view->users = Users::find($search);
                $this->view->pesquisa = $users;
            }
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

    /**
     * Displays the creation form
     */
    public function newAction() {
        $this->assets->collection('footerJs')->addJs('app/nucleo/users/info-user.js');
    }

    /**
     * Edits a user
     *
     * @param string $id
     */
    public function editAction($id) {
        try {

            if ($this->request->isPost()) {
                throw new Exception('Acesso inválido a essa action!!!');
            }

            $user = Users::findFirstByid($id);
            if (!$user) {
                throw new Exception('Usuário não encontrado!');
            }

            $this->assets->collection('footerJs')->addJs('app/nucleo/users/info-user.js');

            $this->view->id = $user->id;
            $this->view->info_user = $this->infoUserAction($user->cpf);

            $this->tag->setDefault('id', $user->getId());
            $this->tag->setDefault('cpf', $user->getCpf());
            $this->tag->setDefault('password', $user->getPassword());
            $this->tag->setDefault('mustChangePassword', $user->getMustChangePassword());
            $this->tag->setDefault('email', $user->getEmail());
            $this->tag->setDefault('status', $user->getStatus());
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/users');
        }
    }

    /**
     * Creates a new user
     */
    public function createAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $user = $this->entity;

            $user->setId($user->autoincrement());
            $user->setCpf($this->request->getPost('cpf', 'int'));
            $user->setPassword($this->security->hash($this->request->getPost('password')));
            $user->setMustChangePassword($_POST['mustChangePassword']);
            $user->setEmail($this->request->getPost('email', 'email'));
            $user->setStatus('A');

            if (!$user->create()) {
                $msg = '';
                foreach ($user->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Usuário gravado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/users');
    }

    /**
     * Saves a user edited
     *
     */
    public function saveAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $id = $this->request->getPost('id');

            $user = Users::findFirstByid($id);
            if (!$user) {
                throw new Exception('Usuário não encontrado!');
            }

            $user->setId($this->request->getPost('id'));
            $user->setCpf($this->request->getPost('cpf'));
            $user->setMustChangePassword($this->request->getPost('mustChangePassword'));
            $user->setEmail($this->request->getPost('email'));
            $user->setStatus($this->request->getPost('status'));

            if (!$user->update()) {

                $msg = '';
                foreach ($user->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Usuário atualizado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/users');
    }

    /**
     * Deletes a user
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

            $user = Users::findFirstByid($id);
            if (!$user) {
                throw new Exception('Usuário não encontrado!');
            }

            if (!$user->delete()) {

                $msg = '';
                foreach ($user->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/users');
        }
    }

    public function profileAction() {

    }

    public function infoUserAction($cpf = null) {
        try {

            if (is_null($cpf)) {
                $cpf = $this->request->getPost('cpf', 'alphanum');
            }
            $colaborador = new Colaboradores();
            $return = $colaborador->getDadosFuncionario($cpf);

            if ($this->request->isAjax()) {
                $this->view->disable();
                if (is_null($return)) {
                    echo 'Não encontrado';
                } else {
                    echo json_encode($return);
                }
            } else {
                return $return;
            }
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
    }

}
