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
use Nucleo\Models\Departments;

class DepartmentsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for departments
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, '\Nucleo\Models\Departments', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $departments = Departments::find($parameters);
        if (count($departments) == 0) {
            $this->flash->notice("The search did not find any departments");

            return $this->dispatcher->forward(array(
                "controller" => "departments",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $departments,
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
     * Edits a department
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $department = Departments::findFirstByid($id);
            if (!$department) {
                $this->flash->error("department was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "departments",
                    "action" => "index"
                ));
            }

            $this->view->id = $department->id;

            $this->tag->setDefault("id", $department->getId());
            $this->tag->setDefault("name", $department->getName());
            $this->tag->setDefault("status", $department->getStatus());
            $this->tag->setDefault("sdel", $department->getSdel());
            $this->tag->setDefault("createBy", $department->getCreateby());
            $this->tag->setDefault("createIn", $department->getCreatein());
            $this->tag->setDefault("updateBy", $department->getUpdateby());
            $this->tag->setDefault("updateIn", $department->getUpdatein());
            
        }
    }

    /**
     * Creates a new department
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "departments",
                "action" => "index"
            ));
        }

        $department = new Departments();

        $department->setId($this->request->getPost("id"));
        $department->setName($this->request->getPost("name"));
        $department->setStatus($this->request->getPost("status"));
        $department->setSdel($this->request->getPost("sdel"));
        $department->setCreateby($this->request->getPost("createBy"));
        $department->setCreatein($this->request->getPost("createIn"));
        $department->setUpdateby($this->request->getPost("updateBy"));
        $department->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$department->save()) {
            foreach ($department->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "departments",
                "action" => "new"
            ));
        }

        $this->flash->success("department was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "departments",
            "action" => "index"
        ));
    }

    /**
     * Saves a department edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "departments",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $department = Departments::findFirstByid($id);
        if (!$department) {
            $this->flash->error("department does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "departments",
                "action" => "index"
            ));
        }

        $department->setId($this->request->getPost("id"));
        $department->setName($this->request->getPost("name"));
        $department->setStatus($this->request->getPost("status"));
        $department->setSdel($this->request->getPost("sdel"));
        $department->setCreateby($this->request->getPost("createBy"));
        $department->setCreatein($this->request->getPost("createIn"));
        $department->setUpdateby($this->request->getPost("updateBy"));
        $department->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$department->save()) {

            foreach ($department->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "departments",
                "action" => "edit",
                "params" => array($department->id)
            ));
        }

        $this->flash->success("department was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "departments",
            "action" => "index"
        ));
    }

    /**
     * Deletes a department
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $department = Departments::findFirstByid($id);
        if (!$department) {
            $this->flash->error("department was not found");

            return $this->dispatcher->forward(array(
                "controller" => "departments",
                "action" => "index"
            ));
        }

        if (!$department->delete()) {

            foreach ($department->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "departments",
                "action" => "search"
            ));
        }

        $this->flash->success("department was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "departments",
            "action" => "index"
        ));
    }

}
