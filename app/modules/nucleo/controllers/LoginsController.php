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
use Nucleo\Models\Logins;
use DevDenners\Controllers\ControllerBase;

class LoginsController extends ControllerBase {

    /**
     * Index action
     */
    public function indexAction() {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for logins
     */
    public function searchAction() {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, '\Nucleo\Models\Logins', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $logins = Logins::find($parameters);
        if (count($logins) == 0) {
            $this->flash->notice("The search did not find any logins");

            return $this->dispatcher->forward(array(
                        "controller" => "logins",
                        "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $logins,
            "limit" => 10,
            "page" => $numberPage
        ));

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction() {

    }

    /**
     * Edits a login
     *
     * @param string $id
     */
    public function editAction($id) {
        if (!$this->request->isPost()) {

            $login = Logins::findFirstByid($id);
            if (!$login) {
                $this->flash->error("login was not found");

                return $this->dispatcher->forward(array(
                            "controller" => "logins",
                            "action" => "index"
                ));
            }

            $this->view->id = $login->id;

            $this->tag->setDefault("id", $login->getId());
            $this->tag->setDefault("userId", $login->getUserid());
            $this->tag->setDefault("type", $login->getType());
            $this->tag->setDefault("ipAddress", $login->getIpaddress());
            $this->tag->setDefault("attempted", $login->getAttempted());
            $this->tag->setDefault("userAgent", $login->getUseragent());
            $this->tag->setDefault("createIn", $login->getCreatein());
        }
    }

    /**
     * Creates a new login
     */
    public function createAction() {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "logins",
                        "action" => "index"
            ));
        }

        $login = new Logins();

        $login->setUserid($this->request->getPost("userId"));
        $login->setType($this->request->getPost("type"));
        $login->setIpaddress($this->request->getPost("ipAddress"));
        $login->setAttempted($this->request->getPost("attempted"));
        $login->setUseragent($this->request->getPost("userAgent"));
        $login->setCreatein($this->request->getPost("createIn"));


        if (!$login->save()) {
            foreach ($login->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "logins",
                        "action" => "new"
            ));
        }

        $this->flash->success("login was created successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "logins",
                    "action" => "index"
        ));
    }

    /**
     * Saves a login edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "logins",
                        "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $login = Logins::findFirstByid($id);
        if (!$login) {
            $this->flash->error("login does not exist " . $id);

            return $this->dispatcher->forward(array(
                        "controller" => "logins",
                        "action" => "index"
            ));
        }

        $login->setUserid($this->request->getPost("userId"));
        $login->setType($this->request->getPost("type"));
        $login->setIpaddress($this->request->getPost("ipAddress"));
        $login->setAttempted($this->request->getPost("attempted"));
        $login->setUseragent($this->request->getPost("userAgent"));
        $login->setCreatein($this->request->getPost("createIn"));


        if (!$login->save()) {

            foreach ($login->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "logins",
                        "action" => "edit",
                        "params" => array($login->id)
            ));
        }

        $this->flash->success("login was updated successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "logins",
                    "action" => "index"
        ));
    }

    /**
     * Deletes a login
     *
     * @param string $id
     */
    public function deleteAction($id) {
        $login = Logins::findFirstByid($id);
        if (!$login) {
            $this->flash->error("login was not found");

            return $this->dispatcher->forward(array(
                        "controller" => "logins",
                        "action" => "index"
            ));
        }

        if (!$login->delete()) {

            foreach ($login->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "logins",
                        "action" => "search"
            ));
        }

        $this->flash->success("login was deleted successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "logins",
                    "action" => "index"
        ));
    }

}
