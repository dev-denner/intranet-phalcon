<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Telephony\Controllers;

use DevDenners\Controllers\ControllerBase;
use Telephony\Models\AccessLine;
use Telephony\Models\CellPhoneLine;

class AccessLineController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle('Linhas Telefonia Celular');
        parent::initialize();

        $this->entity = new AccessLine();
    }

    /**
     * Index accessLine
     */
    public function indexAction() {
        try {
            $this->view->access_lines = AccessLine::find();
            $this->view->pesquisa = '';
            if ($this->request->isPost()) {
                $pesquisa = $this->request->getPost('access_lines', 'string');
                $search = "(cpf LIKE '%{$pesquisa}%' OR linha LIKE '%{$pesquisa}%')";
                $this->view->access_lines = AccessLine::find($search);
                $this->view->pesquisa = $this->request->getPost('access_lines');
            }
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

    /**
     * Displays the creation form
     */
    public function newAction() {
        $cpf = CellPhoneLine::find(['columns' => 'distinct cpf, name', 'order' => '2']);
        $linha = CellPhoneLine::find(['columns' => 'distinct linha']);

        $cpfs = $linhas = [];

        foreach ($cpf->toArray(0) as $value) {
            $cpfs[$value['CPF']] = $value['NAME'];
        }

        foreach ($linha->toArray(0) as $value) {
            $linhas[$value['LINHA']] = $value['LINHA'];
        }

        $this->view->cpfs = $cpfs;
        $this->view->linhas = $linhas;
    }

    /**
     * Edits a accessLine
     *
     * @param string $id
     */
    public function editAction($id) {
        try {

            if ($this->request->isPost()) {
                throw new Exception('Acesso inválido a essa action!!!');
            }
            $cpf = CellPhoneLine::find(['columns' => 'distinct cpf, name', 'order' => '2']);
            $linha = CellPhoneLine::find(['columns' => 'distinct linha']);

            $cpfs = $linhas = [];

            foreach ($cpf->toArray(0) as $value) {
                $cpfs[$value['CPF']] = $value['NAME'];
            }

            foreach ($linha->toArray(0) as $value) {
                $linhas[$value['LINHA']] = $value['LINHA'];
            }

            $this->view->cpfs = $cpfs;
            $this->view->linhas = $linhas;

            $accessLine = AccessLine::findFirstByid($id);
            if (!$accessLine) {
                throw new Exception('Acesso a Linha não encontrado!');
            }

            $this->view->id = $accessLine->id;

            $this->tag->setDefault('id', $accessLine->getId());
            $this->tag->setDefault('cpf', $accessLine->getCpf());
            $this->tag->setDefault('linha', $accessLine->getLinha());
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('telephony/access_line');
        }
    }

    /**
     * Creates a new accessLine
     */
    public function createAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $accessLine = new AccessLine();

            $accessLine->setId($accessLine->autoincrement());
            $accessLine->setCpf($this->request->getPost('cpf', 'alphanum'));
            $accessLine->setLinha($this->request->getPost('linha'));

            if (!$accessLine->create()) {
                $msg = '';
                foreach ($accessLine->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Acesso a Linha gravada com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('telephony/access_line');
    }

    /**
     * Saves a accessLine edited
     *
     */
    public function saveAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $id = $this->request->getPost('id');

            $accessLine = AccessLine::findFirstByid($id);
            if (!$accessLine) {
                throw new Exception('Acesso a Linha não encontrada!');
            }

            $accessLine->setId($this->request->getPost('id'), 'int');
            $accessLine->setCpf($this->request->getPost('cpf', 'alphanum'));
            $accessLine->setLinha($this->request->getPost('linha'));

            if (!$accessLine->update()) {

                $msg = '';
                foreach ($accessLine->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Acesso a Linha atualizada com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('telephony/access_line');
    }

    /**
     * Deletes a accessLine
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

            $accessLine = AccessLine::findFirstByid($id);
            if (!$accessLine) {
                throw new Exception('Acesso a Linha não encontrada!');
            }

            if (!$accessLine->delete()) {

                $msg = '';
                foreach ($accessLine->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('telephony/access_line');
        }
    }

}
