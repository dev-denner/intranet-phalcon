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
use Nucleo\Models\Perfils;

class PerfilsController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for perfils
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, '\Nucleo\Models\Perfils', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $perfils = Perfils::find($parameters);
        if (count($perfils) == 0) {
            $this->flash->notice("The search did not find any perfils");

            return $this->dispatcher->forward(array(
                "controller" => "perfils",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $perfils,
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

            $perfil = Perfils::findFirstByid($id);
            if (!$perfil) {
                $this->flash->error("perfil was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "perfils",
                    "action" => "index"
                ));
            }

            $this->view->id = $perfil->id;

            $this->tag->setDefault("id", $perfil->getId());
            $this->tag->setDefault("user", $perfil->getUser());
            $this->tag->setDefault("group", $perfil->getGroup());
            $this->tag->setDefault("module", $perfil->getModule());
            $this->tag->setDefault("controller", $perfil->getController());
            $this->tag->setDefault("action", $perfil->getAction());
            $this->tag->setDefault("status", $perfil->getStatus());
            $this->tag->setDefault("sdel", $perfil->getSdel());
            $this->tag->setDefault("createBy", $perfil->getCreateby());
            $this->tag->setDefault("createIn", $perfil->getCreatein());
            $this->tag->setDefault("updateBy", $perfil->getUpdateby());
            $this->tag->setDefault("updateIn", $perfil->getUpdatein());
            
        }
    }

    /**
     * Creates a new perfil
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "perfils",
                "action" => "index"
            ));
        }

        $perfil = new Perfils();

        $perfil->setId($this->request->getPost("id"));
        $perfil->setUser($this->request->getPost("user"));
        $perfil->setGroup($this->request->getPost("group"));
        $perfil->setModule($this->request->getPost("module"));
        $perfil->setController($this->request->getPost("controller"));
        $perfil->setAction($this->request->getPost("action"));
        $perfil->setStatus($this->request->getPost("status"));
        $perfil->setSdel($this->request->getPost("sdel"));
        $perfil->setCreateby($this->request->getPost("createBy"));
        $perfil->setCreatein($this->request->getPost("createIn"));
        $perfil->setUpdateby($this->request->getPost("updateBy"));
        $perfil->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$perfil->save()) {
            foreach ($perfil->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "perfils",
                "action" => "new"
            ));
        }

        $this->flash->success("perfil was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "perfils",
            "action" => "index"
        ));
    }

    /**
     * Saves a perfil edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "perfils",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $perfil = Perfils::findFirstByid($id);
        if (!$perfil) {
            $this->flash->error("perfil does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "perfils",
                "action" => "index"
            ));
        }

        $perfil->setId($this->request->getPost("id"));
        $perfil->setUser($this->request->getPost("user"));
        $perfil->setGroup($this->request->getPost("group"));
        $perfil->setModule($this->request->getPost("module"));
        $perfil->setController($this->request->getPost("controller"));
        $perfil->setAction($this->request->getPost("action"));
        $perfil->setStatus($this->request->getPost("status"));
        $perfil->setSdel($this->request->getPost("sdel"));
        $perfil->setCreateby($this->request->getPost("createBy"));
        $perfil->setCreatein($this->request->getPost("createIn"));
        $perfil->setUpdateby($this->request->getPost("updateBy"));
        $perfil->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$perfil->save()) {

            foreach ($perfil->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "perfils",
                "action" => "edit",
                "params" => array($perfil->id)
            ));
        }

        $this->flash->success("perfil was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "perfils",
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
        $perfil = Perfils::findFirstByid($id);
        if (!$perfil) {
            $this->flash->error("perfil was not found");

            return $this->dispatcher->forward(array(
                "controller" => "perfils",
                "action" => "index"
            ));
        }

        if (!$perfil->delete()) {

            foreach ($perfil->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "perfils",
                "action" => "search"
            ));
        }

        $this->flash->success("perfil was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "perfils",
            "action" => "index"
        ));
    }

}
