<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ActionsController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for actions
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Actions", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "ID";

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
     * Edits a action
     *
     * @param string $ID
     */
    public function editAction($ID)
    {

        if (!$this->request->isPost()) {

            $action = Actions::findFirstByID($ID);
            if (!$action) {
                $this->flash->error("action was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "actions",
                    "action" => "index"
                ));
            }

            $this->view->ID = $action->ID;

            $this->tag->setDefault("ID", $action->getID());
            $this->tag->setDefault("NAME", $action->getNamE());
            $this->tag->setDefault("SLUG", $action->getSluG());
            $this->tag->setDefault("APP", $action->getApP());
            $this->tag->setDefault("SOFTDEL", $action->getSoftdeL());
            $this->tag->setDefault("USERCREATE", $action->getUsercreatE());
            $this->tag->setDefault("DATECREATE", $action->getDatecreatE());
            $this->tag->setDefault("USERUPDATE", $action->getUserupdatE());
            $this->tag->setDefault("DATEUPDATE", $action->getDateupdatE());
            
        }
    }

    /**
     * Creates a new action
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "actions",
                "action" => "index"
            ));
        }

        $action = new Actions();

        $action->setNamE($this->request->getPost("NAME"));
        $action->setSluG($this->request->getPost("SLUG"));
        $action->setApP($this->request->getPost("APP"));
        $action->setSoftdeL($this->request->getPost("SOFTDEL"));
        $action->setUsercreatE($this->request->getPost("USERCREATE"));
        $action->setDatecreatE($this->request->getPost("DATECREATE"));
        $action->setUserupdatE($this->request->getPost("USERUPDATE"));
        $action->setDateupdatE($this->request->getPost("DATEUPDATE"));
        

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
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "actions",
                "action" => "index"
            ));
        }

        $ID = $this->request->getPost("ID");

        $action = Actions::findFirstByID($ID);
        if (!$action) {
            $this->flash->error("action does not exist " . $ID);

            return $this->dispatcher->forward(array(
                "controller" => "actions",
                "action" => "index"
            ));
        }

        $action->setNamE($this->request->getPost("NAME"));
        $action->setSluG($this->request->getPost("SLUG"));
        $action->setApP($this->request->getPost("APP"));
        $action->setSoftdeL($this->request->getPost("SOFTDEL"));
        $action->setUsercreatE($this->request->getPost("USERCREATE"));
        $action->setDatecreatE($this->request->getPost("DATECREATE"));
        $action->setUserupdatE($this->request->getPost("USERUPDATE"));
        $action->setDateupdatE($this->request->getPost("DATEUPDATE"));
        

        if (!$action->save()) {

            foreach ($action->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "actions",
                "action" => "edit",
                "params" => array($action->ID)
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
     * @param string $ID
     */
    public function deleteAction($ID)
    {

        $action = Actions::findFirstByID($ID);
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
