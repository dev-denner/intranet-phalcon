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
use Nucleo\Models\Empresas;

class EmpresasController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for empresas
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, '\Nucleo\Models\Empresas', $_POST);
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
                "controller" => "empresas",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $empresas,
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
     * Edits a empresa
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $empresa = Empresas::findFirstByid($id);
            if (!$empresa) {
                $this->flash->error("empresa was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "empresas",
                    "action" => "index"
                ));
            }

            $this->view->id = $empresa->id;

            $this->tag->setDefault("id", $empresa->getId());
            $this->tag->setDefault("codigo", $empresa->getCodigo());
            $this->tag->setDefault("cnpj", $empresa->getCnpj());
            $this->tag->setDefault("razaoSocial", $empresa->getRazaosocial());
            $this->tag->setDefault("nomeFantasia", $empresa->getNomefantasia());
            $this->tag->setDefault("codProtheus", $empresa->getCodprotheus());
            $this->tag->setDefault("lojaProtheus", $empresa->getLojaprotheus());
            $this->tag->setDefault("sdel", $empresa->getSdel());
            $this->tag->setDefault("createBy", $empresa->getCreateby());
            $this->tag->setDefault("createIn", $empresa->getCreatein());
            $this->tag->setDefault("updateBy", $empresa->getUpdateby());
            $this->tag->setDefault("updateIn", $empresa->getUpdatein());
            
        }
    }

    /**
     * Creates a new empresa
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "empresas",
                "action" => "index"
            ));
        }

        $empresa = new Empresas();

        $empresa->setId($this->request->getPost("id"));
        $empresa->setCodigo($this->request->getPost("codigo"));
        $empresa->setCnpj($this->request->getPost("cnpj"));
        $empresa->setRazaosocial($this->request->getPost("razaoSocial"));
        $empresa->setNomefantasia($this->request->getPost("nomeFantasia"));
        $empresa->setCodprotheus($this->request->getPost("codProtheus"));
        $empresa->setLojaprotheus($this->request->getPost("lojaProtheus"));
        $empresa->setSdel($this->request->getPost("sdel"));
        $empresa->setCreateby($this->request->getPost("createBy"));
        $empresa->setCreatein($this->request->getPost("createIn"));
        $empresa->setUpdateby($this->request->getPost("updateBy"));
        $empresa->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$empresa->save()) {
            foreach ($empresa->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "empresas",
                "action" => "new"
            ));
        }

        $this->flash->success("empresa was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "empresas",
            "action" => "index"
        ));
    }

    /**
     * Saves a empresa edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "empresas",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $empresa = Empresas::findFirstByid($id);
        if (!$empresa) {
            $this->flash->error("empresa does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "empresas",
                "action" => "index"
            ));
        }

        $empresa->setId($this->request->getPost("id"));
        $empresa->setCodigo($this->request->getPost("codigo"));
        $empresa->setCnpj($this->request->getPost("cnpj"));
        $empresa->setRazaosocial($this->request->getPost("razaoSocial"));
        $empresa->setNomefantasia($this->request->getPost("nomeFantasia"));
        $empresa->setCodprotheus($this->request->getPost("codProtheus"));
        $empresa->setLojaprotheus($this->request->getPost("lojaProtheus"));
        $empresa->setSdel($this->request->getPost("sdel"));
        $empresa->setCreateby($this->request->getPost("createBy"));
        $empresa->setCreatein($this->request->getPost("createIn"));
        $empresa->setUpdateby($this->request->getPost("updateBy"));
        $empresa->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$empresa->save()) {

            foreach ($empresa->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "empresas",
                "action" => "edit",
                "params" => array($empresa->id)
            ));
        }

        $this->flash->success("empresa was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "empresas",
            "action" => "index"
        ));
    }

    /**
     * Deletes a empresa
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $empresa = Empresas::findFirstByid($id);
        if (!$empresa) {
            $this->flash->error("empresa was not found");

            return $this->dispatcher->forward(array(
                "controller" => "empresas",
                "action" => "index"
            ));
        }

        if (!$empresa->delete()) {

            foreach ($empresa->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "empresas",
                "action" => "search"
            ));
        }

        $this->flash->success("empresa was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "empresas",
            "action" => "index"
        ));
    }

}
