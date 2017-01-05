<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Telephony\Controllers;

use SysPhalcon\Controllers\ControllerBase;
use Telephony\Models\CellPhoneLine;

class CellPhoneLineController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle('Linhas Telefonia Celular');
        parent::initialize();

        $this->entity = new CellPhoneLine();
    }

    /**
     * Index cellPhoneLine
     */
    public function indexAction() {

        try {
            $this->view->cellPhoneLines = CellPhoneLine::find();
            $this->view->pesquisa = '';
            if ($this->request->isPost()) {
                $pesquisa = $this->request->getPost('cellPhoneLines', 'string');
                $search = "(cpf LIKE '%{$pesquisa}%'
                         OR linha LIKE '%{$pesquisa}%'
                         OR UPPER(name) LIKE UPPER('%{$pesquisa}%')
                         OR UPPER(tipo) LIKE UPPER('%{$pesquisa}%')
                         OR cceo LIKE '%{$pesquisa}%')";
                $this->view->cellPhoneLines = CellPhoneLine::find($search);
                $this->view->pesquisa = $this->request->getPost('cellPhoneLines');
            }
        } catch (\Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

    /**
     * Displays the creation form
     */
    public function newAction() {
        $this->assets->collection('footerJs')->addJs('app/telephony/cell_phone_line/new.js');
    }

    /**
     * Edits a cellPhoneLine
     *
     * @param string $id
     */
    public function editAction($id) {
        try {

            if ($this->request->isPost()) {
                throw new Exception('Acesso inválido a essa action!!!');
            }

            $cellPhoneLine = CellPhoneLine::findFirstByid($id);
            if (!$cellPhoneLine) {
                throw new Exception('Linha Celular não encontrado!');
            }
            $this->assets->collection('footerJs')->addJs('app/telephony/cell_phone_line/new.js');

            $this->view->id = $cellPhoneLine->id;

            $this->tag->setDefault('id', $cellPhoneLine->getId());
            $this->tag->setDefault('cpf', $cellPhoneLine->getCpf());
            $this->tag->setDefault('linha', $cellPhoneLine->getLinha());
            $this->tag->setDefault('name', $cellPhoneLine->getName());
            $this->tag->setDefault('tipo', $cellPhoneLine->getTipo());
            $this->tag->setDefault('descontaFolha', $cellPhoneLine->getDescontaFolha());
            $this->tag->setDefault('cceo', $cellPhoneLine->getCceo());
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('telephony/cell_phone_line');
        }
    }

    /**
     * Creates a new cellPhoneLine
     */
    public function createAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $cellPhoneLine = new CellPhoneLine();

            $cellPhoneLine->setId($cellPhoneLine->autoincrement());
            $cellPhoneLine->setCpf($this->request->getPost('cpf', 'alphanum'));
            $cellPhoneLine->setLinha($this->request->getPost('linha'));
            $cellPhoneLine->setName($this->request->getPost('name'));
            $cellPhoneLine->setTipo($this->request->getPost('tipo'));
            $cellPhoneLine->setDescontaFolha($this->request->getPost('descontaFolha'));
            $cellPhoneLine->setCceo($this->request->getPost('cceo'));

            if (!$cellPhoneLine->create()) {
                $msg = '';
                foreach ($cellPhoneLine->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Linha Celular gravada com sucesso!!!');
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('telephony/cell_phone_line');
    }

    /**
     * Saves a cellPhoneLine edited
     *
     */
    public function saveAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $id = $this->request->getPost('id');

            $cellPhoneLine = CellPhoneLine::findFirstByid($id);
            if (!$cellPhoneLine) {
                throw new Exception('Linha Celular não encontrado!');
            }

            $cellPhoneLine->setId($this->request->getPost('id', 'int'));
            $cellPhoneLine->setCpf($this->request->getPost('cpf', 'alphanum'));
            $cellPhoneLine->setLinha($this->request->getPost('linha'));
            $cellPhoneLine->setName($this->request->getPost('name'));
            $cellPhoneLine->setTipo($this->request->getPost('tipo'));
            $cellPhoneLine->setDescontaFolha($this->request->getPost('descontaFolha'));
            $cellPhoneLine->setCceo($this->request->getPost('cceo'));

            if (!$cellPhoneLine->save()) {
                $msg = '';
                foreach ($cellPhoneLine->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Linha Celular atualizada com sucesso!!!');
        } catch (\PDOException $exc) {
            dump($exc);
            exit;
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('telephony/cell_phone_line');
    }

    /**
     * Deletes a cellPhoneLine
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

            $cellPhoneLine = CellPhoneLine::findFirstByid($id);
            if (!$cellPhoneLine) {
                throw new Exception('Linha Celular não encontrada!');
            }

            if (!$cellPhoneLine->delete()) {

                $msg = '';
                foreach ($cellPhoneLine->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('telephony/cell_phone_line');
        }
    }

}
