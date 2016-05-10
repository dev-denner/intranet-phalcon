<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

use Nucleo\Models\Empresas;
use SysPhalcon\Controllers\ControllerBase;

class EmpresasController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle(' Empresas ');
        parent::initialize();

        $this->entity = new Empresas();
    }

    /**
     * Index empresa
     */
    public function indexAction() {
        try {
            $this->view->empresas = Empresas::find();
            $this->view->pesquisa = '';
            if ($this->request->isPost()) {
                $empresas = $this->request->getPost('empresas', 'string');
                $search = "(UPPER(codigo) LIKE UPPER('%" . $empresas . "%')
                         OR UPPER(cnpj) LIKE UPPER('%" . $empresas . "%')
                         OR UPPER(razaoSocial) LIKE UPPER('%" . $empresas . "%')
                         OR UPPER(nomeFantasia) LIKE UPPER('%" . $empresas . "%')
                         OR UPPER(codProtheus) LIKE UPPER('%" . $empresas . "%')
                         OR UPPER(lojaProtheus) LIKE UPPER('%" . $empresas . "%')
                        )";
                $this->view->empresas = Empresas::find($search);
                $this->view->pesquisa = $this->request->getPost('empresas');
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
     * Edits a empresa
     *
     * @param string $id
     */
    public function editAction($id) {
        try {

            if ($this->request->isPost()) {
                throw new Exception('Acesso inválido a essa action!!!');
            }

            $empresa = Empresas::findFirstByid($id);
            if (!$empresa) {
                throw new Exception('Empresa não encontrada!');
            }

            $this->view->id = $empresa->id;

            $this->tag->setDefault('id', $empresa->getId());
            $this->tag->setDefault('codigo', $empresa->getCodigo());
            $this->tag->setDefault('cnpj', $empresa->getCnpj());
            $this->tag->setDefault('razaoSocial', $empresa->getRazaoSocial());
            $this->tag->setDefault('nomeFantasia', $empresa->getNomeFantasia());
            $this->tag->setDefault('codProtheus', $empresa->getCodProtheus());
            $this->tag->setDefault('lojaProtheus', $empresa->getLojaProtheus());
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/empresas');
        }
    }

    /**
     * Creates a new empresa
     */
    public function createAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $empresa = $this->entity;

            $empresa->setId($empresa->autoincrement());
            $empresa->setCodigo($this->request->getPost('codigo'));
            $empresa->setCnpj($this->request->getPost('cnpj'));
            $empresa->setRazaoSocial($this->request->getPost('razaoSocial'));
            $empresa->setNomeFantasia($this->request->getPost('nomeFantasia'));
            $empresa->setCodProtheus($this->request->getPost('codProtheus'));
            $empresa->setLojaProtheus($this->request->getPost('lojaProtheus'));

            if (!$empresa->create()) {
                $msg = '';
                foreach ($empresa->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Empresa gravada com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/empresas');
    }

    /**
     * Saves a empresa edited
     *
     */
    public function saveAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $id = $this->request->getPost('id');

            $empresa = Empresas::findFirstByid($id);
            if (!$empresa) {
                throw new Exception('Empresa não encontrada!');
            }

            $empresa->setId($this->request->getPost('id'));
            $empresa->setCodigo($this->request->getPost('codigo'));
            $empresa->setCnpj($this->request->getPost('cnpj'));
            $empresa->setRazaoSocial($this->request->getPost('razaoSocial'));
            $empresa->setNomeFantasia($this->request->getPost('nomeFantasia'));
            $empresa->setCodProtheus($this->request->getPost('codProtheus'));
            $empresa->setLojaProtheus($this->request->getPost('lojaProtheus'));

            if (!$empresa->update()) {

                $msg = '';
                foreach ($empresa->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Empresa atualizada com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/empresas');
    }

    /**
     * Deletes a empresa
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

            $empresa = Empresas::findFirstByid($id);
            if (!$empresa) {
                throw new Exception('Empresa não encontrada!');
            }

            if (!$empresa->delete()) {

                $msg = '';
                foreach ($empresa->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/empresas');
        }
    }

}
