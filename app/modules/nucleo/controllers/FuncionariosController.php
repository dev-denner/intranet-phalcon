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
use Nucleo\Models\Funcionarios;

class FuncionariosController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for funcionarios
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, '\Nucleo\Models\Funcionarios', $_POST);
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
                "controller" => "funcionarios",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $funcionarios,
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
     * Edits a funcionario
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $funcionario = Funcionarios::findFirstByid($id);
            if (!$funcionario) {
                $this->flash->error("funcionario was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "funcionarios",
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
            $this->tag->setDefault("dataAdmissao", $funcionario->getDataadmissao());
            $this->tag->setDefault("cargo", $funcionario->getCargo());
            $this->tag->setDefault("email", $funcionario->getEmail());
            $this->tag->setDefault("centroCusto", $funcionario->getCentrocusto());
            $this->tag->setDefault("sdel", $funcionario->getSdel());
            $this->tag->setDefault("createBy", $funcionario->getCreateby());
            $this->tag->setDefault("createIn", $funcionario->getCreatein());
            $this->tag->setDefault("updateBy", $funcionario->getUpdateby());
            $this->tag->setDefault("updateIn", $funcionario->getUpdatein());
            
        }
    }

    /**
     * Creates a new funcionario
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "funcionarios",
                "action" => "index"
            ));
        }

        $funcionario = new Funcionarios();

        $funcionario->setId($this->request->getPost("id"));
        $funcionario->setChapa($this->request->getPost("chapa"));
        $funcionario->setNome($this->request->getPost("nome"));
        $funcionario->setCpf($this->request->getPost("cpf"));
        $funcionario->setEmpresa($this->request->getPost("empresa"));
        $funcionario->setSituacao($this->request->getPost("situacao"));
        $funcionario->setTipo($this->request->getPost("tipo"));
        $funcionario->setDataadmissao($this->request->getPost("dataAdmissao"));
        $funcionario->setCargo($this->request->getPost("cargo"));
        $funcionario->setEmail($this->request->getPost("email", "email"));
        $funcionario->setCentrocusto($this->request->getPost("centroCusto"));
        $funcionario->setSdel($this->request->getPost("sdel"));
        $funcionario->setCreateby($this->request->getPost("createBy"));
        $funcionario->setCreatein($this->request->getPost("createIn"));
        $funcionario->setUpdateby($this->request->getPost("updateBy"));
        $funcionario->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$funcionario->save()) {
            foreach ($funcionario->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "funcionarios",
                "action" => "new"
            ));
        }

        $this->flash->success("funcionario was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "funcionarios",
            "action" => "index"
        ));
    }

    /**
     * Saves a funcionario edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "funcionarios",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $funcionario = Funcionarios::findFirstByid($id);
        if (!$funcionario) {
            $this->flash->error("funcionario does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "funcionarios",
                "action" => "index"
            ));
        }

        $funcionario->setId($this->request->getPost("id"));
        $funcionario->setChapa($this->request->getPost("chapa"));
        $funcionario->setNome($this->request->getPost("nome"));
        $funcionario->setCpf($this->request->getPost("cpf"));
        $funcionario->setEmpresa($this->request->getPost("empresa"));
        $funcionario->setSituacao($this->request->getPost("situacao"));
        $funcionario->setTipo($this->request->getPost("tipo"));
        $funcionario->setDataadmissao($this->request->getPost("dataAdmissao"));
        $funcionario->setCargo($this->request->getPost("cargo"));
        $funcionario->setEmail($this->request->getPost("email", "email"));
        $funcionario->setCentrocusto($this->request->getPost("centroCusto"));
        $funcionario->setSdel($this->request->getPost("sdel"));
        $funcionario->setCreateby($this->request->getPost("createBy"));
        $funcionario->setCreatein($this->request->getPost("createIn"));
        $funcionario->setUpdateby($this->request->getPost("updateBy"));
        $funcionario->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$funcionario->save()) {

            foreach ($funcionario->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "funcionarios",
                "action" => "edit",
                "params" => array($funcionario->id)
            ));
        }

        $this->flash->success("funcionario was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "funcionarios",
            "action" => "index"
        ));
    }

    /**
     * Deletes a funcionario
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $funcionario = Funcionarios::findFirstByid($id);
        if (!$funcionario) {
            $this->flash->error("funcionario was not found");

            return $this->dispatcher->forward(array(
                "controller" => "funcionarios",
                "action" => "index"
            ));
        }

        if (!$funcionario->delete()) {

            foreach ($funcionario->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "funcionarios",
                "action" => "search"
            ));
        }

        $this->flash->success("funcionario was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "funcionarios",
            "action" => "index"
        ));
    }

}
