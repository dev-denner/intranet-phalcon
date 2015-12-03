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
use Nucleo\Models\Profiles;

/**
 * Class ProfilesController
 * @package Nucleo\Controllers
 */
class ProfilesController extends ControllerBase {

  public function initialize() {
    $this->tag->setTitle('Profiles');
    parent::initialize();
  }

  /**
   * Index action
   */
  public function indexAction() {
    $this->persistent->parameters = null;
  }

  /**
   * Searches for profiles
   */
  public function searchAction() {
    $numberPage = 1;
    if ($this->request->isPost()) {
      $query = Criteria::fromInput($this->di, "Profiles", $_POST);
      $this->persistent->parameters = $query->getParams();
    } else {
      $numberPage = $this->request->getQuery("page", "int");
    }

    $parameters = $this->persistent->parameters;
    if (!is_array($parameters)) {
      $parameters = array();
    }
    $parameters["order"] = "id";

    $profiles = Profiles::find($parameters);
    if (count($profiles) == 0) {
      $this->flash->notice("The search did not find any profiles");

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $paginator = new Paginator(array(
        "data" => $profiles,
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
   * Edits a profile
   *
   * @param string $id
   */
  public function editAction($id) {
    if (!$this->request->isPost()) {
      $profile = Profiles::findFirstById($id);
      if (!$profile) {
        $this->flash->error("profile was not found");

        return $this->dispatcher->forward(array(
                    "action" => "index"
        ));
      }
      $this->view->id = $profile->id;

      $this->tag->setDefault("id", $profile->getId());
      $this->tag->setDefault("user", $profile->getUser());
      $this->tag->setDefault("group", $profile->getGroup());
      $this->tag->setDefault("module", $profile->getModule());
      $this->tag->setDefault("controller", $profile->getController());
      $this->tag->setDefault("action", $profile->getAction());
      $this->tag->setDefault("status", $profile->getStatus());
      $this->tag->setDefault("sdel", $profile->getSdel());
      $this->tag->setDefault("usercreate", $profile->getUsercreate());
      $this->tag->setDefault("datacreate", $profile->getDatacreate());
      $this->tag->setDefault("userupdate", $profile->getUserupdate());
      $this->tag->setDefault("dataupdate", $profile->getDataupdate());
    }
  }

  /**
   * Creates a new profile
   */
  public function createAction() {
    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $profile = new Profiles();

    $profile->setId($this->request->getPost("id", "string"));
    $profile->setUser($this->request->getPost("user", "string"));
    $profile->setGroup($this->request->getPost("group", "string"));
    $profile->setModule($this->request->getPost("module", "string"));
    $profile->setController($this->request->getPost("controller", "string"));
    $profile->setAction($this->request->getPost("action", "string"));
    $profile->setStatus($this->request->getPost("status", "string"));
    $profile->setSdel($this->request->getPost("sdel", "string"));
    $profile->setUsercreate($this->request->getPost("usercreate", "string"));
    $profile->setDatacreate($this->request->getPost("datacreate", "string"));
    $profile->setUserupdate($this->request->getPost("userupdate", "string"));
    $profile->setDataupdate($this->request->getPost("dataupdate", "string"));


    if (!$profile->save()) {
      foreach ($profile->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "new"
      ));
    }

    $this->flash->success("profile was created successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

  /**
   * Saves a profile edited
   */
  public function saveAction() {
    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $id = $this->request->getPost("id");

    $profile = Profiles::findFirstById($id);
    if (!$profile) {
      $this->flash->error("profile does not exist " . $id);

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $profile->setId($this->request->getPost("id", "string"));
    $profile->setUser($this->request->getPost("user", "string"));
    $profile->setGroup($this->request->getPost("group", "string"));
    $profile->setModule($this->request->getPost("module", "string"));
    $profile->setController($this->request->getPost("controller", "string"));
    $profile->setAction($this->request->getPost("action", "string"));
    $profile->setStatus($this->request->getPost("status", "string"));
    $profile->setSdel($this->request->getPost("sdel", "string"));
    $profile->setUsercreate($this->request->getPost("usercreate", "string"));
    $profile->setDatacreate($this->request->getPost("datacreate", "string"));
    $profile->setUserupdate($this->request->getPost("userupdate", "string"));
    $profile->setDataupdate($this->request->getPost("dataupdate", "string"));


    if (!$profile->save()) {
      foreach ($profile->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "edit",
                  "params" => array($profile->id)
      ));
    }

    $this->flash->success("profile was updated successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

  /**
   * Deletes a profile
   *
   * @param string $id
   */
  public function deleteAction($id) {
    $profile = Profiles::findFirstById($id);
    if (!$profile) {
      $this->flash->error("profile was not found");

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    if (!$profile->delete()) {
      foreach ($profile->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "search"
      ));
    }

    $this->flash->success("profile was deleted successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

}
