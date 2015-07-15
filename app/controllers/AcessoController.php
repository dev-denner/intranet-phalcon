<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class AcessoController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for acesso
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Acesso", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "ID";

        $acesso = Acesso::find($parameters);
        if (count($acesso) == 0) {
            $this->flash->notice("The search did not find any acesso");

            return $this->dispatcher->forward(array(
                "controller" => "acesso",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $acesso,
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
     * Edits a acesso
     *
     * @param string $ID
     */
    public function editAction($ID)
    {

        if (!$this->request->isPost()) {

            $acesso = Acesso::findFirstByID($ID);
            if (!$acesso) {
                $this->flash->error("acesso was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "acesso",
                    "action" => "index"
                ));
            }

            $this->view->ID = $acesso->ID;

            $this->tag->setDefault("ID", $acesso->getID());
            $this->tag->setDefault("PERFIL", $acesso->getPerfiL());
            $this->tag->setDefault("ACTION", $acesso->getActioN());
            $this->tag->setDefault("PERMISSION", $acesso->getPermissioN());
            $this->tag->setDefault("SOFTDEL", $acesso->getSoftdeL());
            $this->tag->setDefault("USERCREATE", $acesso->getUsercreatE());
            $this->tag->setDefault("DATECREATE", $acesso->getDatecreatE());
            $this->tag->setDefault("USERUPDATE", $acesso->getUserupdatE());
            $this->tag->setDefault("DATEUPDATE", $acesso->getDateupdatE());
            
        }
    }

    /**
     * Creates a new acesso
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "acesso",
                "action" => "index"
            ));
        }

        $acesso = new Acesso();

        $acesso->setPerfiL($this->request->getPost("PERFIL"));
        $acesso->setActioN($this->request->getPost("ACTION"));
        $acesso->setPermissioN($this->request->getPost("PERMISSION"));
        $acesso->setSoftdeL($this->request->getPost("SOFTDEL"));
        $acesso->setUsercreatE($this->request->getPost("USERCREATE"));
        $acesso->setDatecreatE($this->request->getPost("DATECREATE"));
        $acesso->setUserupdatE($this->request->getPost("USERUPDATE"));
        $acesso->setDateupdatE($this->request->getPost("DATEUPDATE"));
        

        if (!$acesso->save()) {
            foreach ($acesso->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "acesso",
                "action" => "new"
            ));
        }

        $this->flash->success("acesso was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "acesso",
            "action" => "index"
        ));

    }

    /**
     * Saves a acesso edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "acesso",
                "action" => "index"
            ));
        }

        $ID = $this->request->getPost("ID");

        $acesso = Acesso::findFirstByID($ID);
        if (!$acesso) {
            $this->flash->error("acesso does not exist " . $ID);

            return $this->dispatcher->forward(array(
                "controller" => "acesso",
                "action" => "index"
            ));
        }

        $acesso->setPerfiL($this->request->getPost("PERFIL"));
        $acesso->setActioN($this->request->getPost("ACTION"));
        $acesso->setPermissioN($this->request->getPost("PERMISSION"));
        $acesso->setSoftdeL($this->request->getPost("SOFTDEL"));
        $acesso->setUsercreatE($this->request->getPost("USERCREATE"));
        $acesso->setDatecreatE($this->request->getPost("DATECREATE"));
        $acesso->setUserupdatE($this->request->getPost("USERUPDATE"));
        $acesso->setDateupdatE($this->request->getPost("DATEUPDATE"));
        

        if (!$acesso->save()) {

            foreach ($acesso->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "acesso",
                "action" => "edit",
                "params" => array($acesso->ID)
            ));
        }

        $this->flash->success("acesso was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "acesso",
            "action" => "index"
        ));

    }

    /**
     * Deletes a acesso
     *
     * @param string $ID
     */
    public function deleteAction($ID)
    {

        $acesso = Acesso::findFirstByID($ID);
        if (!$acesso) {
            $this->flash->error("acesso was not found");

            return $this->dispatcher->forward(array(
                "controller" => "acesso",
                "action" => "index"
            ));
        }

        if (!$acesso->delete()) {

            foreach ($acesso->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "acesso",
                "action" => "search"
            ));
        }

        $this->flash->success("acesso was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "acesso",
            "action" => "index"
        ));
    }

}
