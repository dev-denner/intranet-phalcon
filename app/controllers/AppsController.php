<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class AppsController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for apps
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Apps", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "ID";

        $apps = Apps::find($parameters);
        if (count($apps) == 0) {
            $this->flash->notice("The search did not find any apps");

            return $this->dispatcher->forward(array(
                "controller" => "apps",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $apps,
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
     * Edits a app
     *
     * @param string $ID
     */
    public function editAction($ID)
    {

        if (!$this->request->isPost()) {

            $app = Apps::findFirstByID($ID);
            if (!$app) {
                $this->flash->error("app was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "apps",
                    "action" => "index"
                ));
            }

            $this->view->ID = $app->ID;

            $this->tag->setDefault("ID", $app->getID());
            $this->tag->setDefault("CONTROLLER", $app->getControlleR());
            $this->tag->setDefault("NAME", $app->getNamE());
            $this->tag->setDefault("MODULE", $app->getModulE());
            $this->tag->setDefault("SOFTDEL", $app->getSoftdeL());
            $this->tag->setDefault("USERCREATE", $app->getUsercreatE());
            $this->tag->setDefault("DATECREATE", $app->getDatecreatE());
            $this->tag->setDefault("USERUPDATE", $app->getUserupdatE());
            $this->tag->setDefault("DATEUPDATE", $app->getDateupdatE());
            
        }
    }

    /**
     * Creates a new app
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "apps",
                "action" => "index"
            ));
        }

        $app = new Apps();

        $app->setControlleR($this->request->getPost("CONTROLLER"));
        $app->setNamE($this->request->getPost("NAME"));
        $app->setModulE($this->request->getPost("MODULE"));
        $app->setSoftdeL($this->request->getPost("SOFTDEL"));
        $app->setUsercreatE($this->request->getPost("USERCREATE"));
        $app->setDatecreatE($this->request->getPost("DATECREATE"));
        $app->setUserupdatE($this->request->getPost("USERUPDATE"));
        $app->setDateupdatE($this->request->getPost("DATEUPDATE"));
        

        if (!$app->save()) {
            foreach ($app->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "apps",
                "action" => "new"
            ));
        }

        $this->flash->success("app was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "apps",
            "action" => "index"
        ));

    }

    /**
     * Saves a app edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "apps",
                "action" => "index"
            ));
        }

        $ID = $this->request->getPost("ID");

        $app = Apps::findFirstByID($ID);
        if (!$app) {
            $this->flash->error("app does not exist " . $ID);

            return $this->dispatcher->forward(array(
                "controller" => "apps",
                "action" => "index"
            ));
        }

        $app->setControlleR($this->request->getPost("CONTROLLER"));
        $app->setNamE($this->request->getPost("NAME"));
        $app->setModulE($this->request->getPost("MODULE"));
        $app->setSoftdeL($this->request->getPost("SOFTDEL"));
        $app->setUsercreatE($this->request->getPost("USERCREATE"));
        $app->setDatecreatE($this->request->getPost("DATECREATE"));
        $app->setUserupdatE($this->request->getPost("USERUPDATE"));
        $app->setDateupdatE($this->request->getPost("DATEUPDATE"));
        

        if (!$app->save()) {

            foreach ($app->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "apps",
                "action" => "edit",
                "params" => array($app->ID)
            ));
        }

        $this->flash->success("app was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "apps",
            "action" => "index"
        ));

    }

    /**
     * Deletes a app
     *
     * @param string $ID
     */
    public function deleteAction($ID)
    {

        $app = Apps::findFirstByID($ID);
        if (!$app) {
            $this->flash->error("app was not found");

            return $this->dispatcher->forward(array(
                "controller" => "apps",
                "action" => "index"
            ));
        }

        if (!$app->delete()) {

            foreach ($app->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "apps",
                "action" => "search"
            ));
        }

        $this->flash->success("app was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "apps",
            "action" => "index"
        ));
    }

}
