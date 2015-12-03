<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Mvc\Controller;
use Nucleo\Models\UsersGroups;

/**
 * Class UsersGroupsController
 * @package Nucleo\Controllers
 */
class UsersGroupsController extends ControllerBase {

  public function initialize() {
    $this->tag->setTitle('Users Groups');
    parent::initialize();
  }

  /**
   * Index action
   */
  public function indexAction() {
    $this->persistent->parameters = null;
  }

  /**
   * Searches for users_groups
   */
  public function searchAction() {
    $numberPage = 1;
    if ($this->request->isPost()) {
      $query = Criteria::fromInput($this->di, "UsersGroups", $_POST);
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
                  "action" => "index"
      ));
    }

    $paginator = new Paginator(array(
        "data" => $users_groups,
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
   * Edits a users_group
   *
   * @param string $id
   */
  public function editAction($id) {
    if (!$this->request->isPost()) {
      $users_group = UsersGroups::findFirstById($id);
      if (!$users_group) {
        $this->flash->error("users_group was not found");

        return $this->dispatcher->forward(array(
                    "action" => "index"
        ));
      }
      $this->view->id = $users_group->id;

      $this->tag->setDefault("id", $users_group->getId());
      $this->tag->setDefault("user", $users_group->getUser());
      $this->tag->setDefault("group", $users_group->getGroup());
      $this->tag->setDefault("sdel", $users_group->getSdel());
      $this->tag->setDefault("usercreate", $users_group->getUsercreate());
      $this->tag->setDefault("datacreate", $users_group->getDatacreate());
      $this->tag->setDefault("userupdate", $users_group->getUserupdate());
      $this->tag->setDefault("dataupdate", $users_group->getDataupdate());
    }
  }

  /**
   * Creates a new users_group
   */
  public function createAction() {
    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $users_group = new UsersGroups();

    $users_group->setUser($this->request->getPost("user", "string"));
    $users_group->setGroup($this->request->getPost("group", "string"));
    $users_group->setSdel($this->request->getPost("sdel", "string"));
    $users_group->setUsercreate($this->request->getPost("usercreate", "string"));
    $users_group->setDatacreate($this->request->getPost("datacreate", "string"));
    $users_group->setUserupdate($this->request->getPost("userupdate", "string"));
    $users_group->setDataupdate($this->request->getPost("dataupdate", "string"));


    if (!$users_group->save()) {
      foreach ($users_group->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "new"
      ));
    }

    $this->flash->success("users_group was created successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

  /**
   * Saves a users_group edited
   */
  public function saveAction() {
    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $id = $this->request->getPost("id");

    $users_group = UsersGroups::findFirstById($id);
    if (!$users_group) {
      $this->flash->error("users_group does not exist " . $id);

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $users_group->setUser($this->request->getPost("user", "string"));
    $users_group->setGroup($this->request->getPost("group", "string"));
    $users_group->setSdel($this->request->getPost("sdel", "string"));
    $users_group->setUsercreate($this->request->getPost("usercreate", "string"));
    $users_group->setDatacreate($this->request->getPost("datacreate", "string"));
    $users_group->setUserupdate($this->request->getPost("userupdate", "string"));
    $users_group->setDataupdate($this->request->getPost("dataupdate", "string"));


    if (!$users_group->save()) {
      foreach ($users_group->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "edit",
                  "params" => array($users_group->id)
      ));
    }

    $this->flash->success("users_group was updated successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

  /**
   * Deletes a users_group
   *
   * @param string $id
   */
  public function deleteAction($id) {
    $users_group = UsersGroups::findFirstById($id);
    if (!$users_group) {
      $this->flash->error("users_group was not found");

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    if (!$users_group->delete()) {
      foreach ($users_group->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "search"
      ));
    }

    $this->flash->success("users_group was deleted successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

}
