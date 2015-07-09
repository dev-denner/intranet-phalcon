<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       30/06/2015 04:48:44
 *
 */
        

namespace Nucleo\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Controller;
use Nucleo\Models\Actions;

/**
 * Class ActionsController
 * @package Nucleo\Controllers
 */
class ActionsController extends Controller
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for actions
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Actions", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $actions = Actions::find($parameters);
        if (count($actions) == 0) {
            $this->flash->notice("The search did not find any actions");

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $actions,
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
     * Edits a action
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $action = Actions::findFirstById($id);
            if (!$action) {
                $this->flash->error("action was not found");

                return $this->dispatcher->forward(array(
                    "action" => "index"
                ));
            }
            $this->view->id = $action->id;

            $this->tag->setDefault("id", $action->getId());
            $this->tag->setDefault("name", $action->getName());
            $this->tag->setDefault("slug", $action->getSlug());
            $this->tag->setDefault("app", $action->getApp());
            $this->tag->setDefault("delete", $action->getDelete());
            $this->tag->setDefault("usercreate", $action->getUsercreate());
            $this->tag->setDefault("datecreate", $action->getDatecreate());
            $this->tag->setDefault("userupdate", $action->getUserupdate());
            $this->tag->setDefault("dateupdate", $action->getDateupdate());
            
        }
    }

    /**
     * Creates a new action
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $action = new Actions();

        $action->setName($this->request->getPost("name", "string"));
        $action->setSlug($this->request->getPost("slug", "string"));
        $action->setApp($this->request->getPost("app", "string"));
        $action->setDelete($this->request->getPost("delete", "string"));
        $action->setUsercreate($this->request->getPost("usercreate", "string"));
        $action->setDatecreate($this->request->getPost("datecreate", "string"));
        $action->setUserupdate($this->request->getPost("userupdate", "string"));
        $action->setDateupdate($this->request->getPost("dateupdate", "string"));
        

        if (!$action->save()) {
            foreach ($action->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "new"
            ));
        }

        $this->flash->success("action was created successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }

    /**
     * Saves a action edited
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $action = Actions::findFirstById($id);
        if (!$action) {
            $this->flash->error("action does not exist " . $id);

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $action->setName($this->request->getPost("name", "string"));
        $action->setSlug($this->request->getPost("slug", "string"));
        $action->setApp($this->request->getPost("app", "string"));
        $action->setDelete($this->request->getPost("delete", "string"));
        $action->setUsercreate($this->request->getPost("usercreate", "string"));
        $action->setDatecreate($this->request->getPost("datecreate", "string"));
        $action->setUserupdate($this->request->getPost("userupdate", "string"));
        $action->setDateupdate($this->request->getPost("dateupdate", "string"));
        

        if (!$action->save()) {
            foreach ($action->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "edit",
                "params" => array($action->id)
            ));
        }

        $this->flash->success("action was updated successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }

    /**
     * Deletes a action
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $action = Actions::findFirstById($id);
        if (!$action) {
            $this->flash->error("action was not found");

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        if (!$action->delete()) {
            foreach ($action->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "search"
            ));
        }

        $this->flash->success("action was deleted successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }
}
