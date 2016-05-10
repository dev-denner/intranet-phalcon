<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

use Nucleo\Models\Menus;
use SysPhalcon\Controllers\ControllerBase;

class MenusController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle(' Menus ');
        parent::initialize();

        $this->entity = new Menus();
    }

    /**
     * Index action
     */
    public function indexAction() {
        try {
            $this->view->menus = Menus::find();
            $this->view->pesquisa = '';
            if ($this->request->isPost()) {
                $search = "(UPPER(title) LIKE UPPER('%" . $this->request->getPost('menus', 'string') . "%') OR UPPER(slug) LIKE UPPER('%" . $this->request->getPost('menus', 'string') . "%'))";
                $this->view->menus = Menus::find($search);
                $this->view->pesquisa = $this->request->getPost('menus');
            }
        } catch (Exception $exc) {
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
     * Edits a menu
     *
     * @param string $id
     */
    public function editAction($id) {
        try {

            if ($this->request->isPost()) {
                throw new Exception('Acesso inválido a essa action!!!');
            }

            $this->assets->collection('footerJs')->addJs('app/commons/icon.js');

            $menu = Menus::findFirstByid($id);
            if (!$menu) {
                throw new Exception('Menu não encontrado!');
            }

            $this->view->id = $menu->id;
            $this->view->icon = $menu->icon;

            $this->tag->setDefault('id', $menu->getId());
            $this->tag->setDefault('title', $menu->getTitle());
            $this->tag->setDefault('slug', $menu->getSlug());
            $this->tag->setDefault('module', $menu->getModule());
            $this->tag->setDefault('controller', $menu->getController());
            $this->tag->setDefault('action', $menu->getAction());
            $this->tag->setDefault('department', $menu->getDepartment());
            $this->tag->setDefault('category', $menu->getCategory());
            $this->tag->setDefault('icon', $menu->getIcon());
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/menus');
        }
    }

    /**
     * Creates a new menu
     */
    public function createAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $menu = new Menus();

            $menu->setId($menu->autoincrement());
            $menu->setTitle($this->request->getPost('title'));
            $menu->setSlug($this->request->getPost('slug'));
            $menu->setModule($this->request->getPost('module'));
            $menu->setController($this->request->getPost('controller'));
            $menu->setAction($this->request->getPost('action'));
            $menu->setDepartment($this->request->getPost('department'));
            $menu->setCategory($this->request->getPost('category'));

            $menu->setIcon($this->request->getPost('icon'));

            if (!$menu->create()) {
                $msg = '';
                foreach ($menu->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Menu gravado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/menus');
    }

    /**
     * Saves a menu edited
     *
     */
    public function saveAction() {

        try {

            if (!$this->request->isPost()) {
                throw new Exception('Acesso não permitido a essa action.');
            }

            $id = $this->request->getPost('id');

            $menu = Menus::findFirstByid($id);
            if (!$menu) {
                throw new Exception('Menu não encontrado!');
            }

            $menu->setId($this->request->getPost('id'));
            $menu->setTitle($this->request->getPost('title'));
            $menu->setSlug($this->request->getPost('slug'));
            $menu->setModule($this->request->getPost('module'));
            $menu->setController($this->request->getPost('controller'));
            $menu->setAction($this->request->getPost('action'));
            $menu->setDepartment($this->request->getPost('department'));
            $menu->setCategory($this->request->getPost('category'));
            $menu->setIcon($this->request->getPost('icon'));

            if (!$menu->update()) {

                $msg = '';
                foreach ($menu->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }

            $this->flash->success('Menu atualizado com sucesso!!!');
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('nucleo/menus');
    }

    /**
     * Deletes a menu
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

            $menu = Menus::findFirstByid($id);
            if (!$menu) {
                throw new Exception('Menu não encontrado!');
            }

            if (!$menu->delete()) {

                $msg = '';
                foreach ($menu->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new Exception($msg);
            }
            echo 'ok';
        } catch (Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('nucleo/menus');
        }
    }

}
