<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
**/
        

namespace Nucleo\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Controller;
use Nucleo\Models\Logins;

/**
 * Class LoginsController
 * @package Nucleo\Controllers
 */
class LoginsController extends Controller
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for logins
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Logins", $_POST);
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
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $logins,
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
     * Edits a login
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $login = Logins::findFirstById($id);
            if (!$login) {
                $this->flash->error("login was not found");

                return $this->dispatcher->forward(array(
                    "action" => "index"
                ));
            }
            $this->view->id = $login->id;

            $this->tag->setDefault("id", $login->getId());
            $this->tag->setDefault("user", $login->getUser());
            $this->tag->setDefault("type", $login->getType());
            $this->tag->setDefault("ipaddress", $login->getIpaddress());
            $this->tag->setDefault("attempted", $login->getAttempted());
            $this->tag->setDefault("userAgent", $login->getUseragent());
            $this->tag->setDefault("datacreate", $login->getDatacreate());
            $this->tag->setDefault("dataupdate", $login->getDataupdate());
            
        }
    }

    /**
     * Creates a new login
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $login = new Logins();

        $login->setId($this->request->getPost("id", "string"));
        $login->setUser($this->request->getPost("user", "string"));
        $login->setType($this->request->getPost("type", "string"));
        $login->setIpaddress($this->request->getPost("ipaddress", "string"));
        $login->setAttempted($this->request->getPost("attempted", "string"));
        $login->setUseragent($this->request->getPost("userAgent", "string"));
        $login->setDatacreate($this->request->getPost("datacreate", "string"));
        $login->setDataupdate($this->request->getPost("dataupdate", "string"));
        

        if (!$login->save()) {
            foreach ($login->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "new"
            ));
        }

        $this->flash->success("login was created successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }

    /**
     * Saves a login edited
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $login = Logins::findFirstById($id);
        if (!$login) {
            $this->flash->error("login does not exist " . $id);

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $login->setId($this->request->getPost("id", "string"));
        $login->setUser($this->request->getPost("user", "string"));
        $login->setType($this->request->getPost("type", "string"));
        $login->setIpaddress($this->request->getPost("ipaddress", "string"));
        $login->setAttempted($this->request->getPost("attempted", "string"));
        $login->setUseragent($this->request->getPost("userAgent", "string"));
        $login->setDatacreate($this->request->getPost("datacreate", "string"));
        $login->setDataupdate($this->request->getPost("dataupdate", "string"));
        

        if (!$login->save()) {
            foreach ($login->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "edit",
                "params" => array($login->id)
            ));
        }

        $this->flash->success("login was updated successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }

    /**
     * Deletes a login
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $login = Logins::findFirstById($id);
        if (!$login) {
            $this->flash->error("login was not found");

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        if (!$login->delete()) {
            foreach ($login->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "search"
            ));
        }

        $this->flash->success("login was deleted successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }
}
