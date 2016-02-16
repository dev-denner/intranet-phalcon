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
use Nucleo\Models\UsersGroups;

class UsersGroupsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for users_groups
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, '\Nucleo\Models\UsersGroups', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $users_groups = UsersGroups::find($parameters);
        if (count($users_groups) == 0) {
            $this->flash->notice("The search did not find any users_groups");

            return $this->dispatcher->forward(array(
                "controller" => "users_groups",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $users_groups,
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
     * Edits a users_group
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $users_group = UsersGroups::findFirstByid($id);
            if (!$users_group) {
                $this->flash->error("users_group was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "users_groups",
                    "action" => "index"
                ));
            }

            $this->view->id = $users_group->id;

            $this->tag->setDefault("id", $users_group->getId());
            $this->tag->setDefault("userId", $users_group->getUserid());
            $this->tag->setDefault("groupId", $users_group->getGroupid());
            $this->tag->setDefault("sdel", $users_group->getSdel());
            $this->tag->setDefault("createBy", $users_group->getCreateby());
            $this->tag->setDefault("createIn", $users_group->getCreatein());
            $this->tag->setDefault("updateBy", $users_group->getUpdateby());
            $this->tag->setDefault("updateIn", $users_group->getUpdatein());
            
        }
    }

    /**
     * Creates a new users_group
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "users_groups",
                "action" => "index"
            ));
        }

        $users_group = new UsersGroups();

        $users_group->setUserid($this->request->getPost("userId"));
        $users_group->setGroupid($this->request->getPost("groupId"));
        $users_group->setSdel($this->request->getPost("sdel"));
        $users_group->setCreateby($this->request->getPost("createBy"));
        $users_group->setCreatein($this->request->getPost("createIn"));
        $users_group->setUpdateby($this->request->getPost("updateBy"));
        $users_group->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$users_group->save()) {
            foreach ($users_group->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "users_groups",
                "action" => "new"
            ));
        }

        $this->flash->success("users_group was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "users_groups",
            "action" => "index"
        ));
    }

    /**
     * Saves a users_group edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "users_groups",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $users_group = UsersGroups::findFirstByid($id);
        if (!$users_group) {
            $this->flash->error("users_group does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "users_groups",
                "action" => "index"
            ));
        }

        $users_group->setUserid($this->request->getPost("userId"));
        $users_group->setGroupid($this->request->getPost("groupId"));
        $users_group->setSdel($this->request->getPost("sdel"));
        $users_group->setCreateby($this->request->getPost("createBy"));
        $users_group->setCreatein($this->request->getPost("createIn"));
        $users_group->setUpdateby($this->request->getPost("updateBy"));
        $users_group->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$users_group->save()) {

            foreach ($users_group->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "users_groups",
                "action" => "edit",
                "params" => array($users_group->id)
            ));
        }

        $this->flash->success("users_group was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "users_groups",
            "action" => "index"
        ));
    }

    /**
     * Deletes a users_group
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $users_group = UsersGroups::findFirstByid($id);
        if (!$users_group) {
            $this->flash->error("users_group was not found");

            return $this->dispatcher->forward(array(
                "controller" => "users_groups",
                "action" => "index"
            ));
        }

        if (!$users_group->delete()) {

            foreach ($users_group->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "users_groups",
                "action" => "search"
            ));
        }

        $this->flash->success("users_group was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "users_groups",
            "action" => "index"
        ));
    }

}
