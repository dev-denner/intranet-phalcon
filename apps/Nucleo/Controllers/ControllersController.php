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
use Nucleo\Models\Controllers;

/**
 * Class ControllersController
 * @package Nucleo\Controllers
 */
class ControllersController extends ControllerBase {

  public function initialize() {
    $this->tag->setTitle('Controllers');
    parent::initialize();
  }

  /**
   * Index action
   */
  public function indexAction() {
    $this->persistent->parameters = null;
  }

  /**
   * Searches for controllers
   */
  public function searchAction() {
    $numberPage = 1;
    if ($this->request->isPost()) {
      $query = Criteria::fromInput($this->di, "Controllers", $_POST);
      $this->persistent->parameters = $query->getParams();
    } else {
      $numberPage = $this->request->getQuery("page", "int");
    }

    $parameters = $this->persistent->parameters;
    if (!is_array($parameters)) {
      $parameters = array();
    }
    $parameters["order"] = "id";

    $controllers = Controllers::find($parameters);
    if (count($controllers) == 0) {
      $this->flash->notice("The search did not find any controllers");

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $paginator = new Paginator(array(
        "data" => $controllers,
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
   * Edits a controller
   *
   * @param string $id
   */
  public function editAction($id) {
    if (!$this->request->isPost()) {
      $controller = Controllers::findFirstById($id);
      if (!$controller) {
        $this->flash->error("controller was not found");

        return $this->dispatcher->forward(array(
                    "action" => "index"
        ));
      }
      $this->view->id = $controller->id;

      $this->tag->setDefault("id", $controller->getId());
      $this->tag->setDefault("title", $controller->getTitle());
      $this->tag->setDefault("slug", $controller->getSlug());
      $this->tag->setDefault("module", $controller->getModule());
      $this->tag->setDefault("status", $controller->getStatus());
      $this->tag->setDefault("sdel", $controller->getSdel());
      $this->tag->setDefault("usercreate", $controller->getUsercreate());
      $this->tag->setDefault("datacreate", $controller->getDatacreate());
      $this->tag->setDefault("userupdate", $controller->getUserupdate());
      $this->tag->setDefault("dataupdate", $controller->getDataupdate());
    }
  }

  /**
   * Creates a new controller
   */
  public function createAction() {
    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $controller = new Controllers();

    $controller->setId($this->request->getPost("id", "string"));
    $controller->setTitle($this->request->getPost("title", "string"));
    $controller->setSlug($this->request->getPost("slug", "string"));
    $controller->setModule($this->request->getPost("module", "string"));
    $controller->setStatus($this->request->getPost("status", "string"));
    $controller->setSdel($this->request->getPost("sdel", "string"));
    $controller->setUsercreate($this->request->getPost("usercreate", "string"));
    $controller->setDatacreate($this->request->getPost("datacreate", "string"));
    $controller->setUserupdate($this->request->getPost("userupdate", "string"));
    $controller->setDataupdate($this->request->getPost("dataupdate", "string"));


    if (!$controller->save()) {
      foreach ($controller->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "new"
      ));
    }

    $this->flash->success("controller was created successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

  /**
   * Saves a controller edited
   */
  public function saveAction() {
    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $id = $this->request->getPost("id");

    $controller = Controllers::findFirstById($id);
    if (!$controller) {
      $this->flash->error("controller does not exist " . $id);

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $controller->setId($this->request->getPost("id", "string"));
    $controller->setTitle($this->request->getPost("title", "string"));
    $controller->setSlug($this->request->getPost("slug", "string"));
    $controller->setModule($this->request->getPost("module", "string"));
    $controller->setStatus($this->request->getPost("status", "string"));
    $controller->setSdel($this->request->getPost("sdel", "string"));
    $controller->setUsercreate($this->request->getPost("usercreate", "string"));
    $controller->setDatacreate($this->request->getPost("datacreate", "string"));
    $controller->setUserupdate($this->request->getPost("userupdate", "string"));
    $controller->setDataupdate($this->request->getPost("dataupdate", "string"));


    if (!$controller->save()) {
      foreach ($controller->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "edit",
                  "params" => array($controller->id)
      ));
    }

    $this->flash->success("controller was updated successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

  /**
   * Deletes a controller
   *
   * @param string $id
   */
  public function deleteAction($id) {
    $controller = Controllers::findFirstById($id);
    if (!$controller) {
      $this->flash->error("controller was not found");

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    if (!$controller->delete()) {
      foreach ($controller->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "search"
      ));
    }

    $this->flash->success("controller was deleted successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

}
