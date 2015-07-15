<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class ModulesController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for modules
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Modules", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "ID";

        $modules = Modules::find($parameters);
        if (count($modules) == 0) {
            $this->flash->notice("The search did not find any modules");

            return $this->dispatcher->forward(array(
                "controller" => "modules",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $modules,
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
     * Edits a module
     *
     * @param string $ID
     */
    public function editAction($ID)
    {

        if (!$this->request->isPost()) {

            $module = Modules::findFirstByID($ID);
            if (!$module) {
                $this->flash->error("module was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "modules",
                    "action" => "index"
                ));
            }

            $this->view->ID = $module->ID;

            $this->tag->setDefault("ID", $module->getID());
            $this->tag->setDefault("NAME", $module->getNamE());
            $this->tag->setDefault("SOFTDEL", $module->getSoftdeL());
            $this->tag->setDefault("USERCREATE", $module->getUsercreatE());
            $this->tag->setDefault("DATECREATE", $module->getDatecreatE());
            $this->tag->setDefault("USERUPDATE", $module->getUserupdatE());
            $this->tag->setDefault("DATEUPDATE", $module->getDateupdatE());
            
        }
    }

    /**
     * Creates a new module
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "modules",
                "action" => "index"
            ));
        }

        $module = new Modules();

        $module->setNamE($this->request->getPost("NAME"));
        $module->setSoftdeL($this->request->getPost("SOFTDEL"));
        $module->setUsercreatE($this->request->getPost("USERCREATE"));
        $module->setDatecreatE($this->request->getPost("DATECREATE"));
        $module->setUserupdatE($this->request->getPost("USERUPDATE"));
        $module->setDateupdatE($this->request->getPost("DATEUPDATE"));
        

        if (!$module->save()) {
            foreach ($module->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "modules",
                "action" => "new"
            ));
        }

        $this->flash->success("module was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "modules",
            "action" => "index"
        ));

    }

    /**
     * Saves a module edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "modules",
                "action" => "index"
            ));
        }

        $ID = $this->request->getPost("ID");

        $module = Modules::findFirstByID($ID);
        if (!$module) {
            $this->flash->error("module does not exist " . $ID);

            return $this->dispatcher->forward(array(
                "controller" => "modules",
                "action" => "index"
            ));
        }

        $module->setNamE($this->request->getPost("NAME"));
        $module->setSoftdeL($this->request->getPost("SOFTDEL"));
        $module->setUsercreatE($this->request->getPost("USERCREATE"));
        $module->setDatecreatE($this->request->getPost("DATECREATE"));
        $module->setUserupdatE($this->request->getPost("USERUPDATE"));
        $module->setDateupdatE($this->request->getPost("DATEUPDATE"));
        

        if (!$module->save()) {

            foreach ($module->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "modules",
                "action" => "edit",
                "params" => array($module->ID)
            ));
        }

        $this->flash->success("module was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "modules",
            "action" => "index"
        ));

    }

    /**
     * Deletes a module
     *
     * @param string $ID
     */
    public function deleteAction($ID)
    {

        $module = Modules::findFirstByID($ID);
        if (!$module) {
            $this->flash->error("module was not found");

            return $this->dispatcher->forward(array(
                "controller" => "modules",
                "action" => "index"
            ));
        }

        if (!$module->delete()) {

            foreach ($module->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "modules",
                "action" => "search"
            ));
        }

        $this->flash->success("module was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "modules",
            "action" => "index"
        ));
    }

}
