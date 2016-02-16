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
use Nucleo\Models\Groups;

class GroupsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for groups
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, '\Nucleo\Models\Groups', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $groups = Groups::find($parameters);
        if (count($groups) == 0) {
            $this->flash->notice("The search did not find any groups");

            return $this->dispatcher->forward(array(
                "controller" => "groups",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $groups,
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
     * Edits a group
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $group = Groups::findFirstByid($id);
            if (!$group) {
                $this->flash->error("group was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "groups",
                    "action" => "index"
                ));
            }

            $this->view->id = $group->id;

            $this->tag->setDefault("id", $group->getId());
            $this->tag->setDefault("name", $group->getName());
            $this->tag->setDefault("status", $group->getStatus());
            $this->tag->setDefault("sdel", $group->getSdel());
            $this->tag->setDefault("createBy", $group->getCreateby());
            $this->tag->setDefault("createIn", $group->getCreatein());
            $this->tag->setDefault("updateBy", $group->getUpdateby());
            $this->tag->setDefault("updateIn", $group->getUpdatein());
            
        }
    }

    /**
     * Creates a new group
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "groups",
                "action" => "index"
            ));
        }

        $group = new Groups();

        $group->setId($this->request->getPost("id"));
        $group->setName($this->request->getPost("name"));
        $group->setStatus($this->request->getPost("status"));
        $group->setSdel($this->request->getPost("sdel"));
        $group->setCreateby($this->request->getPost("createBy"));
        $group->setCreatein($this->request->getPost("createIn"));
        $group->setUpdateby($this->request->getPost("updateBy"));
        $group->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$group->save()) {
            foreach ($group->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "groups",
                "action" => "new"
            ));
        }

        $this->flash->success("group was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "groups",
            "action" => "index"
        ));
    }

    /**
     * Saves a group edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "groups",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $group = Groups::findFirstByid($id);
        if (!$group) {
            $this->flash->error("group does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "groups",
                "action" => "index"
            ));
        }

        $group->setId($this->request->getPost("id"));
        $group->setName($this->request->getPost("name"));
        $group->setStatus($this->request->getPost("status"));
        $group->setSdel($this->request->getPost("sdel"));
        $group->setCreateby($this->request->getPost("createBy"));
        $group->setCreatein($this->request->getPost("createIn"));
        $group->setUpdateby($this->request->getPost("updateBy"));
        $group->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$group->save()) {

            foreach ($group->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "groups",
                "action" => "edit",
                "params" => array($group->id)
            ));
        }

        $this->flash->success("group was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "groups",
            "action" => "index"
        ));
    }

    /**
     * Deletes a group
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $group = Groups::findFirstByid($id);
        if (!$group) {
            $this->flash->error("group was not found");

            return $this->dispatcher->forward(array(
                "controller" => "groups",
                "action" => "index"
            ));
        }

        if (!$group->delete()) {

            foreach ($group->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "groups",
                "action" => "search"
            ));
        }

        $this->flash->success("group was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "groups",
            "action" => "index"
        ));
    }

}
