<?php
 
/**
 * @copyright   2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

use Phalcon\Mvc\Model\Criteria as Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Nucleo\Models\Menus;

class MenusController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for menus
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, '\Nucleo\Models\Menus', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $menus = Menus::find($parameters);
        if (count($menus) == 0) {
            $this->flash->notice("The search did not find any menus");

            return $this->dispatcher->forward(array(
                "controller" => "menus",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $menus,
            "limit"=> 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a menu
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $menu = Menus::findFirstByid($id);
            if (!$menu) {
                $this->flash->error("menu was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "menus",
                    "action" => "index"
                ));
            }

            $this->view->id = $menu->id;

            $this->tag->setDefault("id", $menu->getId());
            $this->tag->setDefault("title", $menu->getTitle());
            $this->tag->setDefault("slug", $menu->getSlug());
            $this->tag->setDefault("parents", $menu->getParents());
            $this->tag->setDefault("action", $menu->getAction());
            $this->tag->setDefault("sdel", $menu->getSdel());
            $this->tag->setDefault("createBy", $menu->getCreateby());
            $this->tag->setDefault("createIn", $menu->getCreatein());
            $this->tag->setDefault("updateBy", $menu->getUpdateby());
            $this->tag->setDefault("updateIn", $menu->getUpdatein());
            
        }
    }

    /**
     * Creates a new menu
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "menus",
                "action" => "index"
            ));
        }

        $menu = new Menus();

        $menu->setTitle($this->request->getPost("title"));
        $menu->setSlug($this->request->getPost("slug"));
        $menu->setParents($this->request->getPost("parents"));
        $menu->setAction($this->request->getPost("action"));
        $menu->setSdel($this->request->getPost("sdel"));
        $menu->setCreateby($this->request->getPost("createBy"));
        $menu->setCreatein($this->request->getPost("createIn"));
        $menu->setUpdateby($this->request->getPost("updateBy"));
        $menu->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$menu->save()) {
            foreach ($menu->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "menus",
                "action" => "new"
            ));
        }

        $this->flash->success("menu was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "menus",
            "action" => "index"
        ));
    }

    /**
     * Saves a menu edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "menus",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $menu = Menus::findFirstByid($id);
        if (!$menu) {
            $this->flash->error("menu does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "menus",
                "action" => "index"
            ));
        }

        $menu->setTitle($this->request->getPost("title"));
        $menu->setSlug($this->request->getPost("slug"));
        $menu->setParents($this->request->getPost("parents"));
        $menu->setAction($this->request->getPost("action"));
        $menu->setSdel($this->request->getPost("sdel"));
        $menu->setCreateby($this->request->getPost("createBy"));
        $menu->setCreatein($this->request->getPost("createIn"));
        $menu->setUpdateby($this->request->getPost("updateBy"));
        $menu->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$menu->save()) {

            foreach ($menu->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "menus",
                "action" => "edit",
                "params" => array($menu->id)
            ));
        }

        $this->flash->success("menu was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "menus",
            "action" => "index"
        ));
    }

    /**
     * Deletes a menu
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $menu = Menus::findFirstByid($id);
        if (!$menu) {
            $this->flash->error("menu was not found");

            return $this->dispatcher->forward(array(
                "controller" => "menus",
                "action" => "index"
            ));
        }

        if (!$menu->delete()) {

            foreach ($menu->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "menus",
                "action" => "search"
            ));
        }

        $this->flash->success("menu was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "menus",
            "action" => "index"
        ));
    }

}
