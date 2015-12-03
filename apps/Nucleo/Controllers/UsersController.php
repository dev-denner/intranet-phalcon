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
use Nucleo\Models\Users;
use Nucleo\Forms\UsersForm;

/**
 * Class UsersController
 * @package Nucleo\Controllers
 */
class UsersController extends ControllerBase {

  public function initialize() {
    $this->tag->setTitle('Users');
    parent::initialize();
  }

  /**
   * Index action
   */
  public function indexAction() {
    $this->persistent->parameters = null;
    $this->view->form = new UsersForm(NULL, array('search' => TRUE));
  }

  /**
   * Searches for users
   */
  public function searchAction() {
    $numberPage = 1;
    if ($this->request->isPost()) {
      $query = Criteria::fromInput($this->di, "Nucleo\Models\Users", $_POST);
      $this->persistent->parameters = $query->getParams();
    } else {
      $numberPage = $this->request->getQuery("page", "int");
    }

    $parameters = $this->persistent->parameters;
    if (!is_array($parameters)) {
      $parameters = array();
    }
    $parameters["order"] = "id";

    $users = Users::find($parameters);
    if (count($users) == 0) {
      $this->flash->notice("The search did not find any users");

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $paginator = new Paginator(array(
        "data" => $users,
        "limit" => 10,
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
     * Edits a user
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {
            $user = Users::findFirstById($id);
            if (!$user) {
                $this->flash->error("user was not found");

                return $this->dispatcher->forward(array(
                    "action" => "index"
                ));
            }
            $this->view->id = $user->id;

            $this->tag->setDefault("id", $user->getId());
            $this->tag->setDefault("cpf", $user->getCpf());
            $this->tag->setDefault("password", $user->getPassword());
            $this->tag->setDefault("mustchangepassword", $user->getMustchangepassword());
            $this->tag->setDefault("email", $user->getEmail());
            $this->tag->setDefault("name", $user->getName());
            $this->tag->setDefault("status", $user->getStatus());
            $this->tag->setDefault("token", $user->getToken());
            $this->tag->setDefault("sdel", $user->getSdel());
            $this->tag->setDefault("usercreate", $user->getUsercreate());
            $this->tag->setDefault("datacreate", $user->getDatacreate());
            $this->tag->setDefault("userupdate", $user->getUserupdate());
            $this->tag->setDefault("dataupdate", $user->getDataupdate());
            
        }
    }

    /**
     * Creates a new user
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $user = new Users();

        $user->setId($this->request->getPost("id", "string"));
        $user->setCpf($this->request->getPost("cpf", "string"));
        $user->setPassword($this->request->getPost("password", "string"));
        $user->setMustchangepassword($this->request->getPost("mustchangepassword", "string"));
        $user->setEmail($this->request->getPost("email", "email"));
        $user->setName($this->request->getPost("name", "string"));
        $user->setStatus($this->request->getPost("status", "string"));
        $user->setToken($this->request->getPost("token", "string"));
        $user->setSdel($this->request->getPost("sdel", "string"));
        $user->setUsercreate($this->request->getPost("usercreate", "string"));
        $user->setDatacreate($this->request->getPost("datacreate", "string"));
        $user->setUserupdate($this->request->getPost("userupdate", "string"));
        $user->setDataupdate($this->request->getPost("dataupdate", "string"));
        

        if (!$user->save()) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "new"
            ));
        }

        $this->flash->success("user was created successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }

    /**
     * Saves a user edited
     */
    public function saveAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $user = Users::findFirstById($id);
        if (!$user) {
            $this->flash->error("user does not exist " . $id);

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        $user->setId($this->request->getPost("id", "string"));
        $user->setCpf($this->request->getPost("cpf", "string"));
        $user->setPassword($this->request->getPost("password", "string"));
        $user->setMustchangepassword($this->request->getPost("mustchangepassword", "string"));
        $user->setEmail($this->request->getPost("email", "email"));
        $user->setName($this->request->getPost("name", "string"));
        $user->setStatus($this->request->getPost("status", "string"));
        $user->setToken($this->request->getPost("token", "string"));
        $user->setSdel($this->request->getPost("sdel", "string"));
        $user->setUsercreate($this->request->getPost("usercreate", "string"));
        $user->setDatacreate($this->request->getPost("datacreate", "string"));
        $user->setUserupdate($this->request->getPost("userupdate", "string"));
        $user->setDataupdate($this->request->getPost("dataupdate", "string"));
        

        if (!$user->save()) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "edit",
                "params" => array($user->id)
            ));
        }

        $this->flash->success("user was updated successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }

    /**
     * Deletes a user
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $user = Users::findFirstById($id);
        if (!$user) {
            $this->flash->error("user was not found");

            return $this->dispatcher->forward(array(
                "action" => "index"
            ));
        }

        if (!$user->delete()) {
            foreach ($user->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "action" => "search"
            ));
        }

        $this->flash->success("user was deleted successfully");

        return $this->dispatcher->forward(array(
            "action" => "index"
        ));
    }
}
