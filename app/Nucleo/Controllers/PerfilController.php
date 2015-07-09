<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       30/06/2015 04:48:50
 *
 */
        

namespace Nucleo\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Controller;
use Nucleo\Models\Perfil;

/**
 * Class PerfilController
 * @package Nucleo\Controllers
 */
class PerfilController extends Controller
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for perfil
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Perfil", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $perfil = Perfil::find($parameters);
        if (count($perfil) == 0) {
            $this->flash->notice("The search did not find any perfil");

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $perfil,
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
     * Edits a perfil
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $perfil = Perfil::findFirstById($id);
            if (!$perfil) {
                $this->flash->error("perfil was not found");

                return $this->dispatcher->forward(array(
                    "action" => "index"
                ));
            }
            $this->view->id = $perfil->id;

            $this->tag->setDefault("id", $perfil->getId());
            $this->tag->setDefault("description", $perfil->getDescription());
            $this->tag->setDefault("status", $perfil->getStatus());
            $this->tag->setDefault("delete", $perfil->getDelete());
            $this->tag->setDefault("usercreate", $perfil->getUsercreate());
            $this->tag->setDefault("datecreate", $perfil->getDatecreate());
            $this->tag->setDefault("userupdate", $perfil->getUserupdate());
            $this->tag->setDefault("dateupdate", $perfil->getDateupdate());
            
        }
    }

    /**
     * Creates a new perfil
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $perfil = new Perfil();

        $perfil->setDescription($this->request->getPost("description", "string"));
        $perfil->setStatus($this->request->getPost("status", "string"));
        $perfil->setDelete($this->request->getPost("delete", "string"));
        $perfil->setUsercreate($this->request->getPost("usercreate", "string"));
        $perfil->setDatecreate($this->request->getPost("datecreate", "string"));
        $perfil->setUserupdate($this->request->getPost("userupdate", "string"));
        $perfil->setDateupdate($this->request->getPost("dateupdate", "string"));
        

        if (!$perfil->save()) {
            foreach ($perfil->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "new"
            ));
        }

        $this->flash->success("perfil was created successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }

    /**
     * Saves a perfil edited
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $perfil = Perfil::findFirstById($id);
        if (!$perfil) {
            $this->flash->error("perfil does not exist " . $id);

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $perfil->setDescription($this->request->getPost("description", "string"));
        $perfil->setStatus($this->request->getPost("status", "string"));
        $perfil->setDelete($this->request->getPost("delete", "string"));
        $perfil->setUsercreate($this->request->getPost("usercreate", "string"));
        $perfil->setDatecreate($this->request->getPost("datecreate", "string"));
        $perfil->setUserupdate($this->request->getPost("userupdate", "string"));
        $perfil->setDateupdate($this->request->getPost("dateupdate", "string"));
        

        if (!$perfil->save()) {
            foreach ($perfil->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "edit",
                "params" => array($perfil->id)
            ));
        }

        $this->flash->success("perfil was updated successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }

    /**
     * Deletes a perfil
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $perfil = Perfil::findFirstById($id);
        if (!$perfil) {
            $this->flash->error("perfil was not found");

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        if (!$perfil->delete()) {
            foreach ($perfil->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "search"
            ));
        }

        $this->flash->success("perfil was deleted successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }
}
