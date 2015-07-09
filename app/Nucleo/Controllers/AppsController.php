<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       30/06/2015 04:48:38
 *
 */
        

namespace Nucleo\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Controller;
use Nucleo\Models\Apps;

/**
 * Class AppsController
 * @package Nucleo\Controllers
 */
class AppsController extends Controller
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for apps
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Apps", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $apps = Apps::find($parameters);
        if (count($apps) == 0) {
            $this->flash->notice("The search did not find any apps");

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $apps,
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
     * Edits a app
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $app = Apps::findFirstById($id);
            if (!$app) {
                $this->flash->error("app was not found");

                return $this->dispatcher->forward(array(
                    "action" => "index"
                ));
            }
            $this->view->id = $app->id;

            $this->tag->setDefault("id", $app->getId());
            $this->tag->setDefault("controller", $app->getController());
            $this->tag->setDefault("name", $app->getName());
            $this->tag->setDefault("module", $app->getModule());
            $this->tag->setDefault("delete", $app->getDelete());
            $this->tag->setDefault("usercreate", $app->getUsercreate());
            $this->tag->setDefault("datecreate", $app->getDatecreate());
            $this->tag->setDefault("userupdate", $app->getUserupdate());
            $this->tag->setDefault("dateupdate", $app->getDateupdate());
            
        }
    }

    /**
     * Creates a new app
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $app = new Apps();

        $app->setController($this->request->getPost("controller", "string"));
        $app->setName($this->request->getPost("name", "string"));
        $app->setModule($this->request->getPost("module", "string"));
        $app->setDelete($this->request->getPost("delete", "string"));
        $app->setUsercreate($this->request->getPost("usercreate", "string"));
        $app->setDatecreate($this->request->getPost("datecreate", "string"));
        $app->setUserupdate($this->request->getPost("userupdate", "string"));
        $app->setDateupdate($this->request->getPost("dateupdate", "string"));
        

        if (!$app->save()) {
            foreach ($app->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "new"
            ));
        }

        $this->flash->success("app was created successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }

    /**
     * Saves a app edited
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $app = Apps::findFirstById($id);
        if (!$app) {
            $this->flash->error("app does not exist " . $id);

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $app->setController($this->request->getPost("controller", "string"));
        $app->setName($this->request->getPost("name", "string"));
        $app->setModule($this->request->getPost("module", "string"));
        $app->setDelete($this->request->getPost("delete", "string"));
        $app->setUsercreate($this->request->getPost("usercreate", "string"));
        $app->setDatecreate($this->request->getPost("datecreate", "string"));
        $app->setUserupdate($this->request->getPost("userupdate", "string"));
        $app->setDateupdate($this->request->getPost("dateupdate", "string"));
        

        if (!$app->save()) {
            foreach ($app->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "edit",
                "params" => array($app->id)
            ));
        }

        $this->flash->success("app was updated successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }

    /**
     * Deletes a app
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $app = Apps::findFirstById($id);
        if (!$app) {
            $this->flash->error("app was not found");

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        if (!$app->delete()) {
            foreach ($app->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "search"
            ));
        }

        $this->flash->success("app was deleted successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }
}
