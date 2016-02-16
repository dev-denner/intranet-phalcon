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
use Nucleo\Models\Modules;

class ModulesController extends ControllerBase
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
            $query = Criteria::fromInput($this->di, '\Nucleo\Models\Modules', $_POST);
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
                "controller" => "modules",
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

            $module = Modules::findFirstByid($id);
            if (!$module) {
                $this->flash->error("module was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "modules",
                    "action" => "index"
                ));
            }

            $this->view->id = $module->id;

            $this->tag->setDefault("id", $module->getId());
            $this->tag->setDefault("name", $module->getName());
            $this->tag->setDefault("department", $module->getDepartment());
            $this->tag->setDefault("status", $module->getStatus());
            $this->tag->setDefault("isPublic", $module->getIspublic());
            $this->tag->setDefault("sdel", $module->getSdel());
            $this->tag->setDefault("createBy", $module->getCreateby());
            $this->tag->setDefault("createIn", $module->getCreatein());
            $this->tag->setDefault("updateBy", $module->getUpdateby());
            $this->tag->setDefault("updateIn", $module->getUpdatein());
            
        }
    }

    /**
     * Creates a new module
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "modules",
                "action" => "index"
            ));
        }

        $module = new Modules();

        $module->setId($this->request->getPost("id"));
        $module->setName($this->request->getPost("name"));
        $module->setDepartment($this->request->getPost("department"));
        $module->setStatus($this->request->getPost("status"));
        $module->setIspublic($this->request->getPost("isPublic"));
        $module->setSdel($this->request->getPost("sdel"));
        $module->setCreateby($this->request->getPost("createBy"));
        $module->setCreatein($this->request->getPost("createIn"));
        $module->setUpdateby($this->request->getPost("updateBy"));
        $module->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$module->save()) {
            foreach ($module->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "modules",
                "action" => "new"
            ));
        }

        $this->flash->success("module was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "modules",
            "action" => "index"
        ));
    }

    /**
     * Saves a module edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "modules",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $module = Modules::findFirstByid($id);
        if (!$module) {
            $this->flash->error("module does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "modules",
                "action" => "index"
            ));
        }

        $module->setId($this->request->getPost("id"));
        $module->setName($this->request->getPost("name"));
        $module->setDepartment($this->request->getPost("department"));
        $module->setStatus($this->request->getPost("status"));
        $module->setIspublic($this->request->getPost("isPublic"));
        $module->setSdel($this->request->getPost("sdel"));
        $module->setCreateby($this->request->getPost("createBy"));
        $module->setCreatein($this->request->getPost("createIn"));
        $module->setUpdateby($this->request->getPost("updateBy"));
        $module->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$module->save()) {

            foreach ($module->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "modules",
                "action" => "edit",
                "params" => array($module->id)
            ));
        }

        $this->flash->success("module was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "modules",
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
        $module = Modules::findFirstByid($id);
        if (!$module) {
            $this->flash->error("module was not found");

            return $this->dispatcher->forward(array(
                "controller" => "modules",
                "action" => "index"
            ));
        }

        if (!$module->delete()) {

            foreach ($module->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "modules",
                "action" => "search"
            ));
        }

        $this->flash->success("module was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "modules",
            "action" => "index"
        ));
    }

}
