<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Nucleo\Controllers;

use App\Modules\Nucleo\Models\Modules;
use App\Shared\Controllers\ControllerBase;

class ModulesController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle(' Módulos ');
        parent::initialize();

        $this->entity = new Modules();
    }

    /**
     * Index action
     */
    public function indexAction() {
        try {
            $this->view->modules = Modules::find();
            $this->view->pesquisa = '';
            if ($this->request->isPost()) {
                $modules = $this->request->getPost('modules', 'alphanum');
                $search = "(UPPER(title) LIKE UPPER('%" . $modules . "%')
                         (UPPER(slug) LIKE UPPER('%" . $modules . "%')
                         (UPPER(description) LIKE UPPER('%" . $modules . "%'))";
                $this->view->modules = Modules::find($search);
                $this->view->pesquisa = $this->request->getPost('modules');
            }
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

    /**
     * Displays the creation form
     */
    public function newAction() {
        $this->assets->collection('footerJs')->addJs('app/commons/icon.js');
    }

    /**
     * Edits a module
     *
     * @param string $id
     */
    public function editAction($id) {
        try {

            if ($this->request->isPost()) {
                throw new Exception('Acesso inválido a essa action!!!');
            }
            $this->assets->collection('footerJs')->addJs('app/commons/icon.js');
            $module = Modules::findFirstByid($id);
            if (!$module) {
                throw new Exception('Módulo não encontrado!');
            }

            $this->view->id = $module->id;

            $this->tag->setDefault('id', $module->getId());
            $this->tag->setDefault('title', $module->getTitle());
            $this->tag->setDefault('slug', $module->getSlug());
            $this->tag->setDefault('icon', $module->getIcon());
            $this->tag->setDefault('description', $module->getDescription());
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
            return $this->response->redirect('nucleo/modules');
        }
    }

    /**
     * Creates a new module
     */
    public function createAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $module = new Modules();

            $module->setId($module->autoincrement());
            $module->setTitle($this->request->getPost('title'));
            $module->setSlug($this->request->getPost('slug'));
            $module->setIcon($this->request->getPost('icon'));
            $module->setDescription($this->request->getPost('description'));

            if (!$module->create()) {
                $msg = '';
                foreach ($module->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Módulo gravado com sucesso!!!');
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('nucleo/modules');
    }

    /**
     * Saves a module edited
     *
     */
    public function saveAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $id = $this->request->getPost('id');

            $module = Modules::findFirstByid($id);
            if (!$module) {
                throw new Exception('Módulo não encontrado!');
            }

            $module->setId($this->request->getPost('id'));
            $module->setTitle($this->request->getPost('title'));
            $module->setSlug($this->request->getPost('slug'));
            $module->setIcon($this->request->getPost('icon'));
            $module->setDescription($this->request->getPost('description'));

            if (!$module->update()) {

                $msg = '';
                foreach ($module->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Módulo atualizado com sucesso!!!');
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('nucleo/modules');
    }

    /**
     * Deletes a module
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

            $module = Modules::findFirstByid($id);
            if (!$module) {
                throw new Exception('Módulo não encontrado!');
            }

            if (!$module->delete()) {

                $msg = '';
                foreach ($module->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
            return $this->response->redirect('nucleo/modules');
        }
    }

}
