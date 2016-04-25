<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

use Nucleo\Models\Funcionarios;
use DevDenners\Controllers\ControllerBase;

class FuncionariosController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle(' Funcionarios ');
        parent::initialize();

        $this->entity = new Funcionarios();
    }

    /**
     * Index funcionario
     */
    public function indexAction() {
        try {
            $this->view->funcionarios = Funcionarios::find();
            $this->view->pesquisa = '';
            if ($this->request->isPost()) {
                $funcionarios = $this->request->getPost('funcionarios', 'string');
                $search = "(UPPER(chapa) LIKE UPPER('%" . $funcionarios . "%')
                         OR UPPER(nome) LIKE UPPER('%" . $funcionarios . "%')
                         OR UPPER(cpf) LIKE UPPER('%" . $funcionarios . "%')
                         OR UPPER(situacao) LIKE UPPER('%" . $funcionarios . "%')
                         OR UPPER(tipo) LIKE UPPER('%" . $funcionarios . "%')
                         OR UPPER(cargo) LIKE UPPER('%" . $funcionarios . "%')
                         OR UPPER(email) LIKE UPPER('%" . $funcionarios . "%')
                         OR UPPER(cc) LIKE UPPER('%" . $funcionarios . "%')
                        )";
                $this->view->funcionarios = Funcionarios::find($search);
                $this->view->pesquisa = $this->request->getPost('funcionarios');
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
     * Edits a funcionario
     *
     * @param string $id
     */
    public function editAction($id) {
        try {

            if ($this->request->isPost()) {
                throw new Exception('Acesso inválido a essa action!!!');
            }

            $funcionario = Funcionarios::findFirstByid($id);
            if (!$funcionario) {
                throw new Exception('Funcionario não encontrado!');
            }

            $this->view->id = $funcionario->id;

            $this->tag->setDefault('id', $funcionario->getId());
            $this->tag->setDefault('chapa', $funcionario->getChapa());
            $this->tag->setDefault('nome', $funcionario->getNome());
            $this->tag->setDefault('cpf', $funcionario->getCpf());
            $this->tag->setDefault('empresa', $funcionario->getEmpresa());
            $this->tag->setDefault('situacao', $funcionario->getSituacao());
            $this->tag->setDefault('tipo', $funcionario->getTipo());
            $this->tag->setDefault('dataAdmissao', $funcionario->getDataAdmissao());
            $this->tag->setDefault('cargo', $funcionario->getCargo());
            $this->tag->setDefault('email', $funcionario->getEmail());
            $this->tag->setDefault('cc', $funcionario->getCc());
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/funcionarios');
        }
    }

    /**
     * Creates a new funcionario
     */
    public function createAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $funcionario = $this->entity;

            $funcionario->setId($funcionario->autoincrement());
            $funcionario->setChapa($this->request->getPost('chapa'));
            $funcionario->setNome($this->request->getPost('nome'));
            $funcionario->setCpf($this->request->getPost('cpf'));
            $funcionario->setEmpresa($this->request->getPost('empresa'));
            $funcionario->setSituacao($this->request->getPost('situacao'));
            $funcionario->setTipo($this->request->getPost('tipo'));
            $funcionario->setDataAdmissao($this->request->getPost('dataAdmissao'));
            $funcionario->setCargo($this->request->getPost('cargo'));
            $funcionario->setEmail($this->request->getPost('email'));
            $funcionario->setCc($this->request->getPost('cc'));

            if (!$funcionario->create()) {
                $msg = '';
                foreach ($funcionario->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Funcionario gravado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/funcionarios');
    }

    /**
     * Saves a funcionario edited
     *
     */
    public function saveAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $id = $this->request->getPost('id');

            $funcionario = Funcionarios::findFirstByid($id);
            if (!$funcionario) {
                throw new Exception('Funcionario não encontrado!');
            }

            $funcionario->setId($this->request->getPost('id'));
            $funcionario->setChapa($this->request->getPost('chapa'));
            $funcionario->setNome($this->request->getPost('nome'));
            $funcionario->setCpf($this->request->getPost('cpf'));
            $funcionario->setEmpresa($this->request->getPost('empresa'));
            $funcionario->setSituacao($this->request->getPost('situacao'));
            $funcionario->setTipo($this->request->getPost('tipo'));
            $funcionario->setDataAdmissao($this->request->getPost('dataAdmissao'));
            $funcionario->setCargo($this->request->getPost('cargo'));
            $funcionario->setEmail($this->request->getPost('email'));
            $funcionario->setCc($this->request->getPost('cc'));

            if (!$funcionario->update()) {

                $msg = '';
                foreach ($funcionario->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Funcionario atualizado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/funcionarios');
    }

    /**
     * Deletes a funcionario
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

            $funcionario = Funcionarios::findFirstByid($id);
            if (!$funcionario) {
                throw new Exception('Funcionario não encontrado!');
            }

            if (!$funcionario->delete()) {

                $msg = '';
                foreach ($funcionario->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/funcionarios');
        }
    }

}
