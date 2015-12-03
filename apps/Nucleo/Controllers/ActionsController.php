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
use Nucleo\Models\Actions;

/**
 * Class ActionsController
 * @package Nucleo\Controllers
 */
class ActionsController extends ControllerBase {

  public function initialize() {
    $this->tag->setTitle('Actions');
    parent::initialize();
  }

  /**
   * Index action
   */
  public function indexAction() {
    $this->persistent->parameters = null;
  }

  /**
   * Searches for actions
   */
  public function searchAction() {
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
   * Edits a action
   *
   * @param string $id
   */
  public function editAction($id) {
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
      $this->tag->setDefault("title", $action->getTitle());
      $this->tag->setDefault("slug", $action->getSlug());
      $this->tag->setDefault("controller", $action->getController());
      $this->tag->setDefault("status", $action->getStatus());
      $this->tag->setDefault("sdel", $action->getSdel());
      $this->tag->setDefault("usercreate", $action->getUsercreate());
      $this->tag->setDefault("datacreate", $action->getDatacreate());
      $this->tag->setDefault("userupdate", $action->getUserupdate());
      $this->tag->setDefault("dataupdate", $action->getDataupdate());
    }
  }

  /**
   * Creates a new action
   */
  public function createAction() {
    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $action = new Actions();

    $action->setId($this->request->getPost("id", "string"));
    $action->setTitle($this->request->getPost("title", "string"));
    $action->setSlug($this->request->getPost("slug", "string"));
    $action->setController($this->request->getPost("controller", "string"));
    $action->setStatus($this->request->getPost("status", "string"));
    $action->setSdel($this->request->getPost("sdel", "string"));
    $action->setUsercreate($this->request->getPost("usercreate", "string"));
    $action->setDatacreate($this->request->getPost("datacreate", "string"));
    $action->setUserupdate($this->request->getPost("userupdate", "string"));
    $action->setDataupdate($this->request->getPost("dataupdate", "string"));


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
  public function saveAction() {
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

    $action->setId($this->request->getPost("id", "string"));
    $action->setTitle($this->request->getPost("title", "string"));
    $action->setSlug($this->request->getPost("slug", "string"));
    $action->setController($this->request->getPost("controller", "string"));
    $action->setStatus($this->request->getPost("status", "string"));
    $action->setSdel($this->request->getPost("sdel", "string"));
    $action->setUsercreate($this->request->getPost("usercreate", "string"));
    $action->setDatacreate($this->request->getPost("datacreate", "string"));
    $action->setUserupdate($this->request->getPost("userupdate", "string"));
    $action->setDataupdate($this->request->getPost("dataupdate", "string"));


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
  public function deleteAction($id) {
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
