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
use Nucleo\Models\Empresas;

/**
 * Class EmpresasController
 * @package Nucleo\Controllers
 */
class EmpresasController extends ControllerBase {

  public function initialize() {
    $this->tag->setTitle('Empresas');
    parent::initialize();
  }

  /**
   * Index action
   */
  public function indexAction() {
    $this->persistent->parameters = null;
  }

  /**
   * Searches for empresas
   */
  public function searchAction() {
    $numberPage = 1;
    if ($this->request->isPost()) {
      $query = Criteria::fromInput($this->di, "Empresas", $_POST);
      $this->persistent->parameters = $query->getParams();
    } else {
      $numberPage = $this->request->getQuery("page", "int");
    }

    $parameters = $this->persistent->parameters;
    if (!is_array($parameters)) {
      $parameters = array();
    }
    $parameters["order"] = "id";

    $empresas = Empresas::find($parameters);
    if (count($empresas) == 0) {
      $this->flash->notice("The search did not find any empresas");

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $paginator = new Paginator(array(
        "data" => $empresas,
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
   * Edits a empresa
   *
   * @param string $id
   */
  public function editAction($id) {
    if (!$this->request->isPost()) {
      $empresa = Empresas::findFirstById($id);
      if (!$empresa) {
        $this->flash->error("empresa was not found");

        return $this->dispatcher->forward(array(
                    "action" => "index"
        ));
      }
      $this->view->id = $empresa->id;

      $this->tag->setDefault("id", $empresa->getId());
      $this->tag->setDefault("codigo", $empresa->getCodigo());
      $this->tag->setDefault("razaosocial", $empresa->getRazaosocial());
      $this->tag->setDefault("nomefantasia", $empresa->getNomefantasia());
      $this->tag->setDefault("codprotheus", $empresa->getCodprotheus());
      $this->tag->setDefault("lojaprotheus", $empresa->getLojaprotheus());
      $this->tag->setDefault("sdel", $empresa->getSdel());
      $this->tag->setDefault("usercreate", $empresa->getUsercreate());
      $this->tag->setDefault("datacreate", $empresa->getDatacreate());
      $this->tag->setDefault("userupdate", $empresa->getUserupdate());
      $this->tag->setDefault("dataupdate", $empresa->getDataupdate());
    }
  }

  /**
   * Creates a new empresa
   */
  public function createAction() {
    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $empresa = new Empresas();

    $empresa->setId($this->request->getPost("id", "string"));
    $empresa->setCodigo($this->request->getPost("codigo", "string"));
    $empresa->setRazaosocial($this->request->getPost("razaosocial", "string"));
    $empresa->setNomefantasia($this->request->getPost("nomefantasia", "string"));
    $empresa->setCodprotheus($this->request->getPost("codprotheus", "string"));
    $empresa->setLojaprotheus($this->request->getPost("lojaprotheus", "string"));
    $empresa->setSdel($this->request->getPost("sdel", "string"));
    $empresa->setUsercreate($this->request->getPost("usercreate", "string"));
    $empresa->setDatacreate($this->request->getPost("datacreate", "string"));
    $empresa->setUserupdate($this->request->getPost("userupdate", "string"));
    $empresa->setDataupdate($this->request->getPost("dataupdate", "string"));


    if (!$empresa->save()) {
      foreach ($empresa->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "new"
      ));
    }

    $this->flash->success("empresa was created successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

  /**
   * Saves a empresa edited
   */
  public function saveAction() {
    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $id = $this->request->getPost("id");

    $empresa = Empresas::findFirstById($id);
    if (!$empresa) {
      $this->flash->error("empresa does not exist " . $id);

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $empresa->setId($this->request->getPost("id", "string"));
    $empresa->setCodigo($this->request->getPost("codigo", "string"));
    $empresa->setRazaosocial($this->request->getPost("razaosocial", "string"));
    $empresa->setNomefantasia($this->request->getPost("nomefantasia", "string"));
    $empresa->setCodprotheus($this->request->getPost("codprotheus", "string"));
    $empresa->setLojaprotheus($this->request->getPost("lojaprotheus", "string"));
    $empresa->setSdel($this->request->getPost("sdel", "string"));
    $empresa->setUsercreate($this->request->getPost("usercreate", "string"));
    $empresa->setDatacreate($this->request->getPost("datacreate", "string"));
    $empresa->setUserupdate($this->request->getPost("userupdate", "string"));
    $empresa->setDataupdate($this->request->getPost("dataupdate", "string"));


    if (!$empresa->save()) {
      foreach ($empresa->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "edit",
                  "params" => array($empresa->id)
      ));
    }

    $this->flash->success("empresa was updated successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

  /**
   * Deletes a empresa
   *
   * @param string $id
   */
  public function deleteAction($id) {
    $empresa = Empresas::findFirstById($id);
    if (!$empresa) {
      $this->flash->error("empresa was not found");

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    if (!$empresa->delete()) {
      foreach ($empresa->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "search"
      ));
    }

    $this->flash->success("empresa was deleted successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

}
