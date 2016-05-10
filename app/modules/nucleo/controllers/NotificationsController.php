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
use Nucleo\Models\Notifications;
use SysPhalcon\Controllers\ControllerBase;

class NotificationsController extends ControllerBase {

    /**
     * Index action
     */
    public function indexAction() {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for notifications
     */
    public function searchAction() {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, '\Nucleo\Models\Notifications', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "id";

        $notifications = Notifications::find($parameters);
        if (count($notifications) == 0) {
            $this->flash->notice("The search did not find any notifications");

            return $this->dispatcher->forward(array(
                        "controller" => "notifications",
                        "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $notifications,
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
     * Edits a notification
     *
     * @param string $id
     */
    public function editAction($id) {
        if (!$this->request->isPost()) {

            $notification = Notifications::findFirstByid($id);
            if (!$notification) {
                $this->flash->error("notification was not found");

                return $this->dispatcher->forward(array(
                            "controller" => "notifications",
                            "action" => "index"
                ));
            }

            $this->view->id = $notification->id;

            $this->tag->setDefault("id", $notification->getId());
            $this->tag->setDefault("userId", $notification->getUserid());
            $this->tag->setDefault("section", $notification->getSection());
            $this->tag->setDefault("subsection", $notification->getSubsection());
            $this->tag->setDefault("recipient", $notification->getRecipient());
            $this->tag->setDefault("message", $notification->getMessage());
            $this->tag->setDefault("redirect", $notification->getRedirect());
            $this->tag->setDefault("seen", $notification->getSeen());
            $this->tag->setDefault("createIn", $notification->getCreatein());
            $this->tag->setDefault("updateIn", $notification->getUpdatein());
        }
    }

    /**
     * Creates a new notification
     */
    public function createAction() {
        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "notifications",
                        "action" => "index"
            ));
        }

        $notification = new Notifications();

        $notification->setUserid($this->request->getPost("userId"));
        $notification->setSection($this->request->getPost("section"));
        $notification->setSubsection($this->request->getPost("subsection"));
        $notification->setRecipient($this->request->getPost("recipient"));
        $notification->setMessage($this->request->getPost("message"));
        $notification->setRedirect($this->request->getPost("redirect"));
        $notification->setSeen($this->request->getPost("seen"));
        $notification->setCreatein($this->request->getPost("createIn"));
        $notification->setUpdatein($this->request->getPost("updateIn"));


        if (!$notification->save()) {
            foreach ($notification->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "notifications",
                        "action" => "new"
            ));
        }

        $this->flash->success("notification was created successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "notifications",
                    "action" => "index"
        ));
    }

    /**
     * Saves a notification edited
     *
     */
    public function saveAction() {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                        "controller" => "notifications",
                        "action" => "index"
            ));
        }

        $id = $this->request->getPost("id");

        $notification = Notifications::findFirstByid($id);
        if (!$notification) {
            $this->flash->error("notification does not exist " . $id);

            return $this->dispatcher->forward(array(
                        "controller" => "notifications",
                        "action" => "index"
            ));
        }

        $notification->setUserid($this->request->getPost("userId"));
        $notification->setSection($this->request->getPost("section"));
        $notification->setSubsection($this->request->getPost("subsection"));
        $notification->setRecipient($this->request->getPost("recipient"));
        $notification->setMessage($this->request->getPost("message"));
        $notification->setRedirect($this->request->getPost("redirect"));
        $notification->setSeen($this->request->getPost("seen"));
        $notification->setCreatein($this->request->getPost("createIn"));
        $notification->setUpdatein($this->request->getPost("updateIn"));


        if (!$notification->save()) {

            foreach ($notification->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "notifications",
                        "action" => "edit",
                        "params" => array($notification->id)
            ));
        }

        $this->flash->success("notification was updated successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "notifications",
                    "action" => "index"
        ));
    }

    /**
     * Deletes a notification
     *
     * @param string $id
     */
    public function deleteAction($id) {
        $notification = Notifications::findFirstByid($id);
        if (!$notification) {
            $this->flash->error("notification was not found");

            return $this->dispatcher->forward(array(
                        "controller" => "notifications",
                        "action" => "index"
            ));
        }

        if (!$notification->delete()) {

            foreach ($notification->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                        "controller" => "notifications",
                        "action" => "search"
            ));
        }

        $this->flash->success("notification was deleted successfully");

        return $this->dispatcher->forward(array(
                    "controller" => "notifications",
                    "action" => "index"
        ));
    }

}
