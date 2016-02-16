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
use Nucleo\Models\Controllers;

class ControllersController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for controllers
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, '\Nucleo\Models\Controllers', $_POST);
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
                "controller" => "controllers",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $controllers,
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
     * Edits a controller
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $controller = Controllers::findFirstByid($id);
            if (!$controller) {
                $this->flash->error("controller was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "controllers",
                    "action" => "index"
                ));
            }

            $this->view->id = $controller->id;

            $this->tag->setDefault("id", $controller->getId());
            $this->tag->setDefault("title", $controller->getTitle());
            $this->tag->setDefault("slug", $controller->getSlug());
            $this->tag->setDefault("module", $controller->getModule());
            $this->tag->setDefault("status", $controller->getStatus());
            $this->tag->setDefault("isPublic", $controller->getIspublic());
            $this->tag->setDefault("sdel", $controller->getSdel());
            $this->tag->setDefault("createBy", $controller->getCreateby());
            $this->tag->setDefault("createIn", $controller->getCreatein());
            $this->tag->setDefault("updateBy", $controller->getUpdateby());
            $this->tag->setDefault("updateIn", $controller->getUpdatein());
            
        }
    }

    /**
     * Creates a new controller
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "controllers",
                "action" => "index"
            ));
        }

        $controller = new Controllers();

        $controller->setId($this->request->getPost("id"));
        $controller->setTitle($this->request->getPost("title"));
        $controller->setSlug($this->request->getPost("slug"));
        $controller->setModule($this->request->getPost("module"));
        $controller->setStatus($this->request->getPost("status"));
        $controller->setIspublic($this->request->getPost("isPublic"));
        $controller->setSdel($this->request->getPost("sdel"));
        $controller->setCreateby($this->request->getPost("createBy"));
        $controller->setCreatein($this->request->getPost("createIn"));
        $controller->setUpdateby($this->request->getPost("updateBy"));
        $controller->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$controller->save()) {
            foreach ($controller->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "controllers",
                "action" => "new"
            ));
        }

        $this->flash->success("controller was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "controllers",
            "action" => "index"
        ));
    }

    /**
     * Saves a controller edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "controllers",
                "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $controller = Controllers::findFirstByid($id);
        if (!$controller) {
            $this->flash->error("controller does not exist " . $id);

            return $this->dispatcher->forward(array(
                "controller" => "controllers",
                "action" => "index"
            ));
        }

        $controller->setId($this->request->getPost("id"));
        $controller->setTitle($this->request->getPost("title"));
        $controller->setSlug($this->request->getPost("slug"));
        $controller->setModule($this->request->getPost("module"));
        $controller->setStatus($this->request->getPost("status"));
        $controller->setIspublic($this->request->getPost("isPublic"));
        $controller->setSdel($this->request->getPost("sdel"));
        $controller->setCreateby($this->request->getPost("createBy"));
        $controller->setCreatein($this->request->getPost("createIn"));
        $controller->setUpdateby($this->request->getPost("updateBy"));
        $controller->setUpdatein($this->request->getPost("updateIn"));
        

        if (!$controller->save()) {

            foreach ($controller->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "controllers",
                "action" => "edit",
                "params" => array($controller->id)
            ));
        }

        $this->flash->success("controller was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "controllers",
            "action" => "index"
        ));
    }

    /**
     * Deletes a controller
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $controller = Controllers::findFirstByid($id);
        if (!$controller) {
            $this->flash->error("controller was not found");

            return $this->dispatcher->forward(array(
                "controller" => "controllers",
                "action" => "index"
            ));
        }

        if (!$controller->delete()) {

            foreach ($controller->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "controllers",
                "action" => "search"
            ));
        }

        $this->flash->success("controller was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "controllers",
            "action" => "index"
        ));
    }

}
