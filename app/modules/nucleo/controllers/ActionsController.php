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
use Nucleo\Models\Actions;

class ActionsController extends ControllerBase {

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
      $query = Criteria::fromInput($this->di, '\Nucleo\Models\Actions', $_POST);
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
                  "controller" => "actions",
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

      $action = Actions::find(array(
                  'conditions' => 'id = ?1',
                  'bind' => array(1 => $id)
      ));
      
      if (!$action) {
        $this->flash->error("action was not found");

        return $this->dispatcher->forward(array(
                    "controller" => "actions",
                    "action" => "index"
        ));
      }

      $this->view->id = $action->id;

      $this->tag->setDefault("id", $action->getId());
      $this->tag->setDefault("title", $action->getTitle());
      $this->tag->setDefault("slug", $action->getSlug());
      $this->tag->setDefault("controller", $action->getController());
      $this->tag->setDefault("status", $action->getStatus());
      $this->tag->setDefault("isPublic", $action->getIspublic());
      $this->tag->setDefault("sdel", $action->getSdel());
      $this->tag->setDefault("createBy", $action->getCreateby());
      $this->tag->setDefault("createIn", $action->getCreatein());
      $this->tag->setDefault("updateBy", $action->getUpdateby());
      $this->tag->setDefault("updateIn", $action->getUpdatein());
    }
  }

  /**
   * Creates a new action
   */
  public function createAction() {
    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  "controller" => "actions",
                  "action" => "index"
      ));
    }

    $action = new Actions();

    $action->setId($this->request->getPost("id"));
    $action->setTitle($this->request->getPost("title"));
    $action->setSlug($this->request->getPost("slug"));
    $action->setController($this->request->getPost("controller"));
    $action->setStatus($this->request->getPost("status"));
    $action->setIspublic($this->request->getPost("isPublic"));
    $action->setSdel($this->request->getPost("sdel"));
    $action->setCreateby($this->request->getPost("createBy"));
    $action->setCreatein($this->request->getPost("createIn"));
    $action->setUpdateby($this->request->getPost("updateBy"));
    $action->setUpdatein($this->request->getPost("updateIn"));


    if (!$action->save()) {
      foreach ($action->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "controller" => "actions",
                  "action" => "new"
      ));
    }

    $this->flash->success("action was created successfully");

    return $this->dispatcher->forward(array(
                "controller" => "actions",
                "action" => "index"
    ));
  }

  /**
   * Saves a action edited
   *
   */
  public function saveAction() {

    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  "controller" => "actions",
                  "action" => "index"
      ));
    }

    $id = $this->request->getPost("id");

    $action = Actions::findFirstByid($id);
    if (!$action) {
      $this->flash->error("action does not exist " . $id);

      return $this->dispatcher->forward(array(
                  "controller" => "actions",
                  "action" => "index"
      ));
    }

    $action->setId($this->request->getPost("id"));
    $action->setTitle($this->request->getPost("title"));
    $action->setSlug($this->request->getPost("slug"));
    $action->setController($this->request->getPost("controller"));
    $action->setStatus($this->request->getPost("status"));
    $action->setIspublic($this->request->getPost("isPublic"));
    $action->setSdel($this->request->getPost("sdel"));
    $action->setCreateby($this->request->getPost("createBy"));
    $action->setCreatein($this->request->getPost("createIn"));
    $action->setUpdateby($this->request->getPost("updateBy"));
    $action->setUpdatein($this->request->getPost("updateIn"));


    if (!$action->save()) {

      foreach ($action->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "controller" => "actions",
                  "action" => "edit",
                  "params" => array($action->id)
      ));
    }

    $this->flash->success("action was updated successfully");

    return $this->dispatcher->forward(array(
                "controller" => "actions",
                "action" => "index"
    ));
  }

  /**
   * Deletes a action
   *
   * @param string $id
   */
  public function deleteAction($id) {
    $action = Actions::findFirstByid($id);
    if (!$action) {
      $this->flash->error("action was not found");

      return $this->dispatcher->forward(array(
                  "controller" => "actions",
                  "action" => "index"
      ));
    }

    if (!$action->delete()) {

      foreach ($action->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "controller" => "actions",
                  "action" => "search"
      ));
    }

    $this->flash->success("action was deleted successfully");

    return $this->dispatcher->forward(array(
                "controller" => "actions",
                "action" => "index"
    ));
  }

}
