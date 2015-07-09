<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       30/06/2015 04:48:59
 *
 */
        

namespace Nucleo\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Controller;
use Nucleo\Models\Access;

/**
 * Class AccessController
 * @package Nucleo\Controllers
 */
class AccessController extends Controller
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for access
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Access", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $access = Access::find($parameters);
        if (count($access) == 0) {
            $this->flash->notice("The search did not find any access");

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $access,
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
     * Edits a acces
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $acces = Access::findFirstById($id);
            if (!$acces) {
                $this->flash->error("acces was not found");

                return $this->dispatcher->forward(array(
                    "action" => "index"
                ));
            }
            $this->view->id = $acces->id;

            $this->tag->setDefault("id", $acces->getId());
            $this->tag->setDefault("perfil", $acces->getPerfil());
            $this->tag->setDefault("action", $acces->getAction());
            $this->tag->setDefault("permission", $acces->getPermission());
            $this->tag->setDefault("delete", $acces->getDelete());
            $this->tag->setDefault("usercreate", $acces->getUsercreate());
            $this->tag->setDefault("datecreate", $acces->getDatecreate());
            $this->tag->setDefault("userupdate", $acces->getUserupdate());
            $this->tag->setDefault("dateupdate", $acces->getDateupdate());
            
        }
    }

    /**
     * Creates a new acces
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $acces = new Access();

        $acces->setPerfil($this->request->getPost("perfil", "string"));
        $acces->setAction($this->request->getPost("action", "string"));
        $acces->setPermission($this->request->getPost("permission", "string"));
        $acces->setDelete($this->request->getPost("delete", "string"));
        $acces->setUsercreate($this->request->getPost("usercreate", "string"));
        $acces->setDatecreate($this->request->getPost("datecreate", "string"));
        $acces->setUserupdate($this->request->getPost("userupdate", "string"));
        $acces->setDateupdate($this->request->getPost("dateupdate", "string"));
        

        if (!$acces->save()) {
            foreach ($acces->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "new"
            ));
        }

        $this->flash->success("acces was created successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }

    /**
     * Saves a acces edited
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $acces = Access::findFirstById($id);
        if (!$acces) {
            $this->flash->error("acces does not exist " . $id);

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $acces->setPerfil($this->request->getPost("perfil", "string"));
        $acces->setAction($this->request->getPost("action", "string"));
        $acces->setPermission($this->request->getPost("permission", "string"));
        $acces->setDelete($this->request->getPost("delete", "string"));
        $acces->setUsercreate($this->request->getPost("usercreate", "string"));
        $acces->setDatecreate($this->request->getPost("datecreate", "string"));
        $acces->setUserupdate($this->request->getPost("userupdate", "string"));
        $acces->setDateupdate($this->request->getPost("dateupdate", "string"));
        

        if (!$acces->save()) {
            foreach ($acces->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "edit",
                "params" => array($acces->id)
            ));
        }

        $this->flash->success("acces was updated successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }

    /**
     * Deletes a acces
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $acces = Access::findFirstById($id);
        if (!$acces) {
            $this->flash->error("acces was not found");

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        if (!$acces->delete()) {
            foreach ($acces->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "search"
            ));
        }

        $this->flash->success("acces was deleted successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }
}
