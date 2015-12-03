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
use Nucleo\Models\Groups;

/**
 * Class GroupsController
 * @package Nucleo\Controllers
 */
class GroupsController extends ControllerBase {

  public function initialize() {
    $this->tag->setTitle('Groups');
    parent::initialize();
  }

  /**
   * Index action
   */
  public function indexAction() {
    $this->persistent->parameters = null;
  }

  /**
   * Searches for groups
   */
  public function searchAction() {
    $numberPage = 1;
    if ($this->request->isPost()) {
      $query = Criteria::fromInput($this->di, "Groups", $_POST);
      $this->persistent->parameters = $query->getParams();
    } else {
      $numberPage = $this->request->getQuery("page", "int");
    }

    $parameters = $this->persistent->parameters;
    if (!is_array($parameters)) {
      $parameters = array();
    }
    $parameters["order"] = "id";

    $groups = Groups::find($parameters);
    if (count($groups) == 0) {
      $this->flash->notice("The search did not find any groups");

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $paginator = new Paginator(array(
        "data" => $groups,
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
   * Edits a group
   *
   * @param string $id
   */
  public function editAction($id) {
    if (!$this->request->isPost()) {
      $group = Groups::findFirstById($id);
      if (!$group) {
        $this->flash->error("group was not found");

        return $this->dispatcher->forward(array(
                    "action" => "index"
        ));
      }
      $this->view->id = $group->id;

      $this->tag->setDefault("id", $group->getId());
      $this->tag->setDefault("nome", $group->getNome());
      $this->tag->setDefault("status", $group->getStatus());
      $this->tag->setDefault("sdel", $group->getSdel());
      $this->tag->setDefault("usercreate", $group->getUsercreate());
      $this->tag->setDefault("datacreate", $group->getDatacreate());
      $this->tag->setDefault("userupdate", $group->getUserupdate());
      $this->tag->setDefault("dataupdate", $group->getDataupdate());
    }
  }

  /**
   * Creates a new group
   */
  public function createAction() {
    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $group = new Groups();

    $group->setId($this->request->getPost("id", "string"));
    $group->setNome($this->request->getPost("nome", "string"));
    $group->setStatus($this->request->getPost("status", "string"));
    $group->setSdel($this->request->getPost("sdel", "string"));
    $group->setUsercreate($this->request->getPost("usercreate", "string"));
    $group->setDatacreate($this->request->getPost("datacreate", "string"));
    $group->setUserupdate($this->request->getPost("userupdate", "string"));
    $group->setDataupdate($this->request->getPost("dataupdate", "string"));


    if (!$group->save()) {
      foreach ($group->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "new"
      ));
    }

    $this->flash->success("group was created successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

  /**
   * Saves a group edited
   */
  public function saveAction() {
    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $id = $this->request->getPost("id");

    $group = Groups::findFirstById($id);
    if (!$group) {
      $this->flash->error("group does not exist " . $id);

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $group->setId($this->request->getPost("id", "string"));
    $group->setNome($this->request->getPost("nome", "string"));
    $group->setStatus($this->request->getPost("status", "string"));
    $group->setSdel($this->request->getPost("sdel", "string"));
    $group->setUsercreate($this->request->getPost("usercreate", "string"));
    $group->setDatacreate($this->request->getPost("datacreate", "string"));
    $group->setUserupdate($this->request->getPost("userupdate", "string"));
    $group->setDataupdate($this->request->getPost("dataupdate", "string"));


    if (!$group->save()) {
      foreach ($group->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "edit",
                  "params" => array($group->id)
      ));
    }

    $this->flash->success("group was updated successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

  /**
   * Deletes a group
   *
   * @param string $id
   */
  public function deleteAction($id) {
    $group = Groups::findFirstById($id);
    if (!$group) {
      $this->flash->error("group was not found");

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    if (!$group->delete()) {
      foreach ($group->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "search"
      ));
    }

    $this->flash->success("group was deleted successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

}
