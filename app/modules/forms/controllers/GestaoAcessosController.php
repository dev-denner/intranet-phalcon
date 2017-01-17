<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Forms\Controllers;

use App\Modules\Forms\Models\GestaoAcesso;
use App\Shared\Controllers\ControllerBase;

class GestaoAcessosController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle('Gestão de Acessos - Formulários');
        parent::initialize();
    }

    /**
     * Index action
     */
    public function indexAction() {
        try {

            if ($this->request->isPost()) {
                $post = $this->request->getPost('gestao_acesso', 'string');
                $search = "UPPER(nomeFormulario) LIKE UPPER('%" . $post . "%')";
                $this->view->gestao_acessos = GestaoAcesso::find($search);
                $this->view->pesquisa = $post;
            } else {
                $this->view->gestao_acessos = GestaoAcesso::find();
                $this->view->pesquisa = '';
            }
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
    }

    /**
     * Displays the creation form
     */
    public function newAction() {

    }

    /**
     * Edits a gestao_acesso
     *
     * @param string $id
     */
    public function editAction($id) {
        try {

            if ($this->request->isPost()) {
                throw new \Exception('Acesso inválido a essa action!!!');
            }

            $gestao_acesso = GestaoAcesso::findFirstByid($id);
            if (!$gestao_acesso) {
                throw new \Exception('Gestão de Acesso não encontrado!');
            }

            $this->view->id = $gestao_acesso->id;

            $this->tag->setDefault('id', $gestao_acesso->getId());
            $this->tag->setDefault('nomeFormulario', $gestao_acesso->getNomeFormulario());
            $this->tag->setDefault('userId', $gestao_acesso->getUserId());
            $this->tag->setDefault('amarracao', $gestao_acesso->getAmarracao());
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('forms/gestao_acessos');
        }
    }

    /**
     * Creates a new gestao_acesso
     */
    public function createAction() {

        try {

            if (!$this->request->isPost()) {
                throw new \Exception('Acesso não permitido a essa action.');
            }

            $gestao_acesso = new GestaoAcesso();

            $gestao_acesso->setId($gestao_acesso->autoincrement());
            $gestao_acesso->setNomeFormulario($this->request->getPost('nomeFormulario'));
            $gestao_acesso->setUserId($this->request->getPost('userId'));
            $gestao_acesso->setAmarracao($this->request->getPost('amarracao'));

            if (!$gestao_acesso->create()) {
                $msg = '';
                foreach ($gestao_acesso->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new \Exception($msg);
            }

            $this->flash->success('Gestão de Acesso gravado com sucesso!!!');
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('forms/gestao_acessos');
    }

    /**
     * Saves a gestao_acesso edited
     *
     */
    public function saveAction() {

        try {

            if (!$this->request->isPost()) {
                throw new \Exception('Acesso não permitido a essa action.');
            }

            $id = $this->request->getPost('id');

            $gestao_acesso = GestaoAcesso::findFirstByid($id);
            if (!$gestao_acesso) {
                throw new \Exception('Gestão de Acesso não encontrado!');
            }

            $gestao_acesso->setId($this->request->getPost('id'));
            $gestao_acesso->setNomeFormulario($this->request->getPost('nomeFormulario'));
            $gestao_acesso->setUserId($this->request->getPost('userId'));
            $gestao_acesso->setAmarracao($this->request->getPost('amarracao'));

            if (!$gestao_acesso->update()) {

                $msg = '';
                foreach ($gestao_acesso->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new \Exception($msg);
            }

            $this->flash->success('Gestão de Acesso atualizado com sucesso!!!');
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('forms/gestao_acessos');
    }

    /**
     * Deletes a gestao_acesso
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

            $gestao_acesso = GestaoAcesso::findFirstByid($id);
            if (!$gestao_acesso) {
                throw new \Exception('Gestão de Acesso não encontrado!');
            }

            if (!$gestao_acesso->delete()) {

                $msg = '';
                foreach ($gestao_acesso->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new \Exception($msg);
            }
            echo 'ok';
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('forms/gestao_acessos');
        }
    }

}
