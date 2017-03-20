<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Nucleo\Controllers;

use App\Modules\Nucleo\Models\Groups;
use App\Modules\Nucleo\Models\Modules;
use App\Modules\Nucleo\Models\Controllers;
use App\Modules\Nucleo\Models\BasePerfils;
use App\Modules\Nucleo\Models\Actions;
use App\Shared\Controllers\ControllerBase;

class GroupsController extends ControllerBase
{

    /**
     * initialize
     */
    public function initialize()
    {
        $this->tag->setTitle(' Grupos ');
        parent::initialize();

        $this->entity = new Groups();
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        try {
            $this->view->groups = Groups::find();
            $this->view->pesquisa = '';
            if ($this->request->isPost()) {
                $this->view->groups = Groups::find("UPPER(title) LIKE UPPER('%" . $this->request->getPost('groups', 'string') . "%')");
                $this->view->pesquisa = $this->request->getPost('groups');
            }
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

        $this->assets->collection('footerJs')->addJs('app/nucleo/group/new.js');
        $this->view->modules = Modules::find(['order' => 'title']);
    }

    /**
     * Edits a group
     *
     * @param string $id
     */
    public function editAction($id)
    {
        try {

            if ($this->request->isPost()) {
                throw new Exception('Acesso inválido a essa action!!!');
            }

            $group = Groups::findFirstByid($id);
            if (!$group) {
                throw new Exception('Grupo não encontrado!');
            }

            $this->view->id = $group->id;
            $this->view->type = $group->type;

            $this->tag->setDefault('id', $group->getId());
            $this->tag->setDefault('title', $group->getTitle());
            $this->tag->setDefault('status', $group->getStatus());
            $this->tag->setDefault('type', $group->getType());
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
            return $this->response->redirect('nucleo/groups');
        }
    }

    /**
     * Creates a new group
     */
    public function createAction()
    {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $group = new Groups();

            $group->setId($group->autoincrement());
            $group->setTitle($this->request->getPost('title'));
            $group->setStatus($this->request->getPost('status'));
            $group->setType($this->request->getPost('type'));

            if (!$group->create()) {
                $msg = '';
                foreach ($group->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Grupo gravado com sucesso!!!');
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('nucleo/groups');
    }

    /**
     * Saves a group edited
     *
     */
    public function saveAction()
    {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $id = $this->request->getPost('id');

            $group = Groups::findFirstByid($id);
            if (!$group) {
                throw new Exception('Grupo não encontrado!');
            }

            $group->setId($this->request->getPost('id'));
            $group->setTitle($this->request->getPost('title'));
            $group->setStatus($this->request->getPost('status'));
            $group->setType($this->request->getPost('type'));


            if (!$group->update()) {

                $msg = '';
                foreach ($group->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Grupo atualizado com sucesso!!!');
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('nucleo/groups');
    }

    /**
     * Deletes a group
     *
     * @param string $id
     */
    public function deleteAction()
    {

        try {
            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            if ($this->request->isAjax()) {
                $this->view->disable();
            }

            $id = $this->request->getPost('id');

            $group = Groups::findFirstByid($id);
            if (!$group) {
                throw new Exception('Grupo não encontrado!');
            }

            if (!$group->delete()) {

                $msg = '';
                foreach ($group->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
            return $this->response->redirect('nucleo/groups');
        }
    }

    public function ajaxAction()
    {
        $this->view->disable();
        $type = $this->request->getPost('type');
        $module = $this->request->getPost('module');
        $controller = $this->request->getPost('controller');

        $return = [];

        switch ($type) {
            case 'module':
                $dados = BasePerfils::find("module = {$module}");
                foreach ($dados as $dado) {
                    $return[$dado->Controllers->id] = [$dado->Controllers->id, $dado->Controllers->title];
                }
                break;
            case 'controller':
                $dados = BasePerfils::find("module = {$module} AND controller = {$controller}");

                foreach ($dados as $dado) {
                    $return[$dado->Actions->id] = [$dado->Actions->id, $dado->Actions->title];
                }
                break;
        }
//dump($dados);
        sort($return);
        echo json_encode($return);
    }

}
