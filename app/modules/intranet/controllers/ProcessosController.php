<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Intranet\Controllers;

use App\Modules\Intranet\Models\Processos;
use App\Modules\Nucleo\Models\Departments;
use App\Shared\Controllers\ControllerBase;

class ProcessosController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle(' Processos ');
        parent::initialize();
    }

    /**
     * Index processo
     */
    public function indexAction() {

        try {
            $this->view->processos = Processos::find();
            $this->view->pesquisa = '';
            $this->view->export = true;
            if ($this->request->isPost()) {
                $search = "(UPPER(code) LIKE UPPER('%" . $this->request->getPost('processos', 'string') . "%') OR UPPER(description) LIKE UPPER('%" . $this->request->getPost('processos', 'string') . "%'))";
                $this->view->processos = Processos::find($search);
                $this->view->pesquisa = $this->request->getPost('processos');
            }
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

    /**
     * Displays the creation form
     */
    public function newAction() {

    }

    /**
     * Edits a processo
     *
     * @param string $id
     */
    public function editAction($id) {
        try {

            if ($this->request->isPost()) {
                throw new Exception('Acesso inválido a essa action!!!');
            }

            $processo = Processos::findFirstByid($id);
            if (!$processo) {
                throw new Exception('Processo não encontrado!');
            }

            $this->view->id = $processo->id;

            $this->tag->setDefault('id', $processo->getId());
            $this->tag->setDefault('code', $processo->getCode());
            $this->tag->setDefault('department', $processo->getDepartment());
            $this->tag->setDefault('description', $processo->getDescription());
            $this->tag->setDefault('link', $processo->getLink());
            $this->tag->setDefault('version', $processo->getVersion());
            $this->tag->setDefault('dateUpdated', $processo->getDateUpdated());
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
            return $this->response->redirect('intranet/processos');
        }
    }

    /**
     * Creates a new processo
     */
    public function createAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $processo = new Processos();

            $processo->setId($processo->autoincrement());
            $processo->setCode($this->request->getPost('code'));
            $processo->setDepartment($this->request->getPost('department'));
            $processo->setDescription($this->request->getPost('description'));
            $processo->setLink($this->request->getPost('link'));
            $processo->setVersion($this->request->getPost('version'));
            $processo->setDateUpdated($this->request->getPost('dateUpdated'));

            if (!$processo->create()) {
                $msg = '';
                foreach ($processo->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Processo gravado com sucesso!!!');
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('intranet/processos');
    }

    /**
     * Saves a processo edited
     *
     */
    public function saveAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $id = $this->request->getPost('id');

            $processo = Processos::findFirstByid($id);
            if (!$processo) {
                throw new Exception('Processo não encontrado!');
            }

            $processo->setId($this->request->getPost('id'));
            $processo->setCode($this->request->getPost('code'));
            $processo->setDepartment($this->request->getPost('department'));
            $processo->setDescription($this->request->getPost('description'));
            $processo->setLink($this->request->getPost('link'));
            $processo->setVersion($this->request->getPost('version'));
            $processo->setDateUpdated($this->request->getPost('dateUpdated'));

            if (!$processo->update()) {

                $msg = '';
                foreach ($processo->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Processo atualizado com sucesso!!!');
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('intranet/processos');
    }

    /**
     * Deletes a processo
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

            $processo = Processos::findFirstByid($id);
            if (!$processo) {
                throw new Exception('Processo não encontrado!');
            }

            if (!$processo->delete()) {

                $msg = '';
                foreach ($processo->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
            return $this->response->redirect('intranet/processos');
        }
    }

    public function processDepartmentsAction() {
        try {
            $this->view->departaments = Departments::find(['order' => 'id']);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function comercialProcessAction() {
        try {
            $this->view->departaments = Departments::findById(2);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/processos/processDepartments');
    }

    public function contabilidadeFiscalProcessAction() {
        try {
            $this->view->departaments = Departments::findById(3);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/processos/processDepartments');
    }

    public function gestaoPessoasProcessAction() {
        try {
            $this->view->departaments = Departments::findById(4);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/processos/processDepartments');
    }

    public function financeiroProcessAction() {
        try {
            $this->view->departaments = Departments::findById(5);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/processos/processDepartments');
    }

    public function juridicoProcessAction() {
        try {
            $this->view->departaments = Departments::findById(6);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/processos/processDepartments');
    }

    public function sgiProcessAction() {
        try {
            $this->view->departaments = Departments::findById(7);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/processos/processDepartments');
    }

    public function suprimentosProcessAction() {
        try {
            $this->view->departaments = Departments::findById(8);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/processos/processDepartments');
    }

    public function ticProcessAction() {
        try {
            $this->view->departaments = Departments::findById(9);
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        $this->view->pick('intranet/processos/processDepartments');
    }

}
