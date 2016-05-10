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
use Nucleo\Models\Tokens;
use SysPhalcon\Controllers\ControllerBase;

class TokensController extends ControllerBase {

    /**
     * Index action
     */
    public function indexAction() {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for tokens
     */
    public function searchAction() {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, '\Nucleo\Models\Tokens', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $tokens = Tokens::find($parameters);
        if (count($tokens) == 0) {
            $this->flash->notice("The search did not find any tokens");

            return $this->dispatcher->forward(array(
                        "controller" => "tokens",
                        "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $tokens,
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
     * Edits a token
     *
     * @param string $id
     */
    public function editAction($id) {
        if (!$this->request->isPost()) {

            $token = Tokens::findFirstByid($id);
            if (!$token) {
                $this->flash->error("token was not found");

                return $this->dispatcher->forward(array(
                            "controller" => "tokens",
                            "action" => "index"
                ));
            }

            $this->view->id = $token->id;

            $this->tag->setDefault("id", $token->getId());
            $this->tag->setDefault("usersId", $token->getUsersid());
            $this->tag->setDefault("token", $token->getToken());
            $this->tag->setDefault("userAgent", $token->getUseragent());
            $this->tag->setDefault("createIn", $token->getCreatein());
        }
    }

    /**
     * Creates a new token
     */
    public function createAction() {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "tokens",
                        "action" => "index"
            ));
        }

        $token = new Tokens();

        $token->setUsersid($this->request->getPost("usersId"));
        $token->setToken($this->request->getPost("token"));
        $token->setUseragent($this->request->getPost("userAgent"));
        $token->setCreatein($this->request->getPost("createIn"));


        if (!$token->save()) {
            foreach ($token->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "tokens",
                        "action" => "new"
            ));
        }

        $this->flash->success("token was created successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "tokens",
                    "action" => "index"
        ));
    }

    /**
     * Saves a token edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "tokens",
                        "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $token = Tokens::findFirstByid($id);
        if (!$token) {
            $this->flash->error("token does not exist " . $id);

            return $this->dispatcher->forward(array(
                        "controller" => "tokens",
                        "action" => "index"
            ));
        }

        $token->setUsersid($this->request->getPost("usersId"));
        $token->setToken($this->request->getPost("token"));
        $token->setUseragent($this->request->getPost("userAgent"));
        $token->setCreatein($this->request->getPost("createIn"));


        if (!$token->save()) {

            foreach ($token->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "tokens",
                        "action" => "edit",
                        "params" => array($token->id)
            ));
        }

        $this->flash->success("token was updated successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "tokens",
                    "action" => "index"
        ));
    }

    /**
     * Deletes a token
     *
     * @param string $id
     */
    public function deleteAction($id) {
        $token = Tokens::findFirstByid($id);
        if (!$token) {
            $this->flash->error("token was not found");

            return $this->dispatcher->forward(array(
                        "controller" => "tokens",
                        "action" => "index"
            ));
        }

        if (!$token->delete()) {

            foreach ($token->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "tokens",
                        "action" => "search"
            ));
        }

        $this->flash->success("token was deleted successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "tokens",
                    "action" => "index"
        ));
    }

}
