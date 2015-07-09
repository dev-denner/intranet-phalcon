<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       30/06/2015 04:48:01
 *
 */
        

namespace Nucleo\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Controller;
use Nucleo\Models\Modules;

/**
 * Class ModulesController
 * @package Nucleo\Controllers
 */
class ModulesController extends Controller
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for modules
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Modules", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $modules = Modules::find($parameters);
        if (count($modules) == 0) {
            $this->flash->notice("The search did not find any modules");

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $modules,
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
     * Edits a module
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $module = Modules::findFirstById($id);
            if (!$module) {
                $this->flash->error("module was not found");

                return $this->dispatcher->forward(array(
                    "action" => "index"
                ));
            }
            $this->view->id = $module->id;

            $this->tag->setDefault("id", $module->getId());
            $this->tag->setDefault("name", $module->getName());
            $this->tag->setDefault("delete", $module->getDelete());
            $this->tag->setDefault("usercreate", $module->getUsercreate());
            $this->tag->setDefault("datecreate", $module->getDatecreate());
            $this->tag->setDefault("userupdate", $module->getUserupdate());
            $this->tag->setDefault("dateupdate", $module->getDateupdate());
            
        }
    }

    /**
     * Creates a new module
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $module = new Modules();

        $module->setName($this->request->getPost("name", "string"));
        $module->setDelete($this->request->getPost("delete", "string"));
        $module->setUsercreate($this->request->getPost("usercreate", "string"));
        $module->setDatecreate($this->request->getPost("datecreate", "string"));
        $module->setUserupdate($this->request->getPost("userupdate", "string"));
        $module->setDateupdate($this->request->getPost("dateupdate", "string"));
        

        if (!$module->save()) {
            foreach ($module->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "new"
            ));
        }

        $this->flash->success("module was created successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }

    /**
     * Saves a module edited
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $module = Modules::findFirstById($id);
        if (!$module) {
            $this->flash->error("module does not exist " . $id);

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $module->setName($this->request->getPost("name", "string"));
        $module->setDelete($this->request->getPost("delete", "string"));
        $module->setUsercreate($this->request->getPost("usercreate", "string"));
        $module->setDatecreate($this->request->getPost("datecreate", "string"));
        $module->setUserupdate($this->request->getPost("userupdate", "string"));
        $module->setDateupdate($this->request->getPost("dateupdate", "string"));
        

        if (!$module->save()) {
            foreach ($module->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "edit",
                "params" => array($module->id)
            ));
        }

        $this->flash->success("module was updated successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }

    /**
     * Deletes a module
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $module = Modules::findFirstById($id);
        if (!$module) {
            $this->flash->error("module was not found");

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        if (!$module->delete()) {
            foreach ($module->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "search"
            ));
        }

        $this->flash->success("module was deleted successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }
}
