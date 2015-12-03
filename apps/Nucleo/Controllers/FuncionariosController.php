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
use Nucleo\Models\Funcionarios;

/**
 * Class FuncionariosController
 * @package Nucleo\Controllers
 */
class FuncionariosController extends ControllerBase {

  public function initialize() {
    $this->tag->setTitle('Funcionários');
    parent::initialize();
  }

  /**
   * Index action
   */
  public function indexAction() {
    $this->persistent->parameters = null;
  }

  /**
   * Searches for funcionarios
   */
  public function searchAction() {
    $numberPage = 1;
    if ($this->request->isPost()) {
      $query = Criteria::fromInput($this->di, "Funcionarios", $_POST);
      $this->persistent->parameters = $query->getParams();
    } else {
      $numberPage = $this->request->getQuery("page", "int");
    }

    $parameters = $this->persistent->parameters;
    if (!is_array($parameters)) {
      $parameters = array();
    }
    $parameters["order"] = "id";

    $funcionarios = Funcionarios::find($parameters);
    if (count($funcionarios) == 0) {
      $this->flash->notice("The search did not find any funcionarios");

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $paginator = new Paginator(array(
        "data" => $funcionarios,
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
   * Edits a funcionario
   *
   * @param string $id
   */
  public function editAction($id) {
    if (!$this->request->isPost()) {
      $funcionario = Funcionarios::findFirstById($id);
      if (!$funcionario) {
        $this->flash->error("funcionario was not found");

        return $this->dispatcher->forward(array(
                    "action" => "index"
        ));
      }
      $this->view->id = $funcionario->id;

      $this->tag->setDefault("id", $funcionario->getId());
      $this->tag->setDefault("chapa", $funcionario->getChapa());
      $this->tag->setDefault("nome", $funcionario->getNome());
      $this->tag->setDefault("cpf", $funcionario->getCpf());
      $this->tag->setDefault("empresa", $funcionario->getEmpresa());
      $this->tag->setDefault("situacao", $funcionario->getSituacao());
      $this->tag->setDefault("tipo", $funcionario->getTipo());
      $this->tag->setDefault("dataadmissao", $funcionario->getDataadmissao());
      $this->tag->setDefault("cargo", $funcionario->getCargo());
      $this->tag->setDefault("email", $funcionario->getEmail());
      $this->tag->setDefault("centrocusto", $funcionario->getCentrocusto());
      $this->tag->setDefault("banco", $funcionario->getBanco());
      $this->tag->setDefault("numagencia", $funcionario->getNumagencia());
      $this->tag->setDefault("digagencia", $funcionario->getDigagencia());
      $this->tag->setDefault("numconta", $funcionario->getNumconta());
      $this->tag->setDefault("digconta", $funcionario->getDigconta());
      $this->tag->setDefault("periodopagto", $funcionario->getPeriodopagto());
      $this->tag->setDefault("sdel", $funcionario->getSdel());
      $this->tag->setDefault("usercreate", $funcionario->getUsercreate());
      $this->tag->setDefault("datacreate", $funcionario->getDatacreate());
      $this->tag->setDefault("userupdate", $funcionario->getUserupdate());
      $this->tag->setDefault("dataupdate", $funcionario->getDataupdate());
    }
  }

  /**
   * Creates a new funcionario
   */
  public function createAction() {
    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $funcionario = new Funcionarios();

    $funcionario->setId($this->request->getPost("id", "string"));
    $funcionario->setChapa($this->request->getPost("chapa", "string"));
    $funcionario->setNome($this->request->getPost("nome", "string"));
    $funcionario->setCpf($this->request->getPost("cpf", "string"));
    $funcionario->setEmpresa($this->request->getPost("empresa", "string"));
    $funcionario->setSituacao($this->request->getPost("situacao", "string"));
    $funcionario->setTipo($this->request->getPost("tipo", "string"));
    $funcionario->setDataadmissao($this->request->getPost("dataadmissao", "string"));
    $funcionario->setCargo($this->request->getPost("cargo", "string"));
    $funcionario->setEmail($this->request->getPost("email", "email"));
    $funcionario->setCentrocusto($this->request->getPost("centrocusto", "string"));
    $funcionario->setBanco($this->request->getPost("banco", "string"));
    $funcionario->setNumagencia($this->request->getPost("numagencia", "string"));
    $funcionario->setDigagencia($this->request->getPost("digagencia", "string"));
    $funcionario->setNumconta($this->request->getPost("numconta", "string"));
    $funcionario->setDigconta($this->request->getPost("digconta", "string"));
    $funcionario->setPeriodopagto($this->request->getPost("periodopagto", "string"));
    $funcionario->setSdel($this->request->getPost("sdel", "string"));
    $funcionario->setUsercreate($this->request->getPost("usercreate", "string"));
    $funcionario->setDatacreate($this->request->getPost("datacreate", "string"));
    $funcionario->setUserupdate($this->request->getPost("userupdate", "string"));
    $funcionario->setDataupdate($this->request->getPost("dataupdate", "string"));


    if (!$funcionario->save()) {
      foreach ($funcionario->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "new"
      ));
    }

    $this->flash->success("funcionario was created successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

  /**
   * Saves a funcionario edited
   */
  public function saveAction() {
    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $id = $this->request->getPost("id");

    $funcionario = Funcionarios::findFirstById($id);
    if (!$funcionario) {
      $this->flash->error("funcionario does not exist " . $id);

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    $funcionario->setId($this->request->getPost("id", "string"));
    $funcionario->setChapa($this->request->getPost("chapa", "string"));
    $funcionario->setNome($this->request->getPost("nome", "string"));
    $funcionario->setCpf($this->request->getPost("cpf", "string"));
    $funcionario->setEmpresa($this->request->getPost("empresa", "string"));
    $funcionario->setSituacao($this->request->getPost("situacao", "string"));
    $funcionario->setTipo($this->request->getPost("tipo", "string"));
    $funcionario->setDataadmissao($this->request->getPost("dataadmissao", "string"));
    $funcionario->setCargo($this->request->getPost("cargo", "string"));
    $funcionario->setEmail($this->request->getPost("email", "email"));
    $funcionario->setCentrocusto($this->request->getPost("centrocusto", "string"));
    $funcionario->setBanco($this->request->getPost("banco", "string"));
    $funcionario->setNumagencia($this->request->getPost("numagencia", "string"));
    $funcionario->setDigagencia($this->request->getPost("digagencia", "string"));
    $funcionario->setNumconta($this->request->getPost("numconta", "string"));
    $funcionario->setDigconta($this->request->getPost("digconta", "string"));
    $funcionario->setPeriodopagto($this->request->getPost("periodopagto", "string"));
    $funcionario->setSdel($this->request->getPost("sdel", "string"));
    $funcionario->setUsercreate($this->request->getPost("usercreate", "string"));
    $funcionario->setDatacreate($this->request->getPost("datacreate", "string"));
    $funcionario->setUserupdate($this->request->getPost("userupdate", "string"));
    $funcionario->setDataupdate($this->request->getPost("dataupdate", "string"));


    if (!$funcionario->save()) {
      foreach ($funcionario->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "edit",
                  "params" => array($funcionario->id)
      ));
    }

    $this->flash->success("funcionario was updated successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

  /**
   * Deletes a funcionario
   *
   * @param string $id
   */
  public function deleteAction($id) {
    $funcionario = Funcionarios::findFirstById($id);
    if (!$funcionario) {
      $this->flash->error("funcionario was not found");

      return $this->dispatcher->forward(array(
                  "action" => "index"
      ));
    }

    if (!$funcionario->delete()) {
      foreach ($funcionario->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  "action" => "search"
      ));
    }

    $this->flash->success("funcionario was deleted successfully");

    return $this->dispatcher->forward(array(
                "action" => "index"
    ));
  }

}
