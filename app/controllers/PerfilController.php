<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class PerfilController extends ControllerBase
{

    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for perfil
     */
    public function searchAction()
    {

        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, "Perfil", $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = array();
        }
        $parameters["order"] = "ID";

        $perfil = Perfil::find($parameters);
        if (count($perfil) == 0) {
            $this->flash->notice("The search did not find any perfil");

            return $this->dispatcher->forward(array(
                "controller" => "perfil",
                "action" => "index"
            ));
        }

        $paginator = new Paginator(array(
            "data" => $perfil,
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
     * Edits a perfil
     *
     * @param string $ID
     */
    public function editAction($ID)
    {

        if (!$this->request->isPost()) {

            $perfil = Perfil::findFirstByID($ID);
            if (!$perfil) {
                $this->flash->error("perfil was not found");

                return $this->dispatcher->forward(array(
                    "controller" => "perfil",
                    "action" => "index"
                ));
            }

            $this->view->ID = $perfil->ID;

            $this->tag->setDefault("ID", $perfil->getID());
            $this->tag->setDefault("DESCRIPTION", $perfil->getDescriptioN());
            $this->tag->setDefault("STATUS", $perfil->getStatuS());
            $this->tag->setDefault("SOFTDEL", $perfil->getSoftdeL());
            $this->tag->setDefault("USERCREATE", $perfil->getUsercreatE());
            $this->tag->setDefault("DATECREATE", $perfil->getDatecreatE());
            $this->tag->setDefault("USERUPDATE", $perfil->getUserupdatE());
            $this->tag->setDefault("DATEUPDATE", $perfil->getDateupdatE());
            
        }
    }

    /**
     * Creates a new perfil
     */
    public function createAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "perfil",
                "action" => "index"
            ));
        }

        $perfil = new Perfil();

        $perfil->setDescriptioN($this->request->getPost("DESCRIPTION"));
        $perfil->setStatuS($this->request->getPost("STATUS"));
        $perfil->setSoftdeL($this->request->getPost("SOFTDEL"));
        $perfil->setUsercreatE($this->request->getPost("USERCREATE"));
        $perfil->setDatecreatE($this->request->getPost("DATECREATE"));
        $perfil->setUserupdatE($this->request->getPost("USERUPDATE"));
        $perfil->setDateupdatE($this->request->getPost("DATEUPDATE"));
        

        if (!$perfil->save()) {
            foreach ($perfil->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "perfil",
                "action" => "new"
            ));
        }

        $this->flash->success("perfil was created successfully");

        return $this->dispatcher->forward(array(
            "controller" => "perfil",
            "action" => "index"
        ));

    }

    /**
     * Saves a perfil edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            return $this->dispatcher->forward(array(
                "controller" => "perfil",
                "action" => "index"
            ));
        }

        $ID = $this->request->getPost("ID");

        $perfil = Perfil::findFirstByID($ID);
        if (!$perfil) {
            $this->flash->error("perfil does not exist " . $ID);

            return $this->dispatcher->forward(array(
                "controller" => "perfil",
                "action" => "index"
            ));
        }

        $perfil->setDescriptioN($this->request->getPost("DESCRIPTION"));
        $perfil->setStatuS($this->request->getPost("STATUS"));
        $perfil->setSoftdeL($this->request->getPost("SOFTDEL"));
        $perfil->setUsercreatE($this->request->getPost("USERCREATE"));
        $perfil->setDatecreatE($this->request->getPost("DATECREATE"));
        $perfil->setUserupdatE($this->request->getPost("USERUPDATE"));
        $perfil->setDateupdatE($this->request->getPost("DATEUPDATE"));
        

        if (!$perfil->save()) {

            foreach ($perfil->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "perfil",
                "action" => "edit",
                "params" => array($perfil->ID)
            ));
        }

        $this->flash->success("perfil was updated successfully");

        return $this->dispatcher->forward(array(
            "controller" => "perfil",
            "action" => "index"
        ));

    }

    /**
     * Deletes a perfil
     *
     * @param string $ID
     */
    public function deleteAction($ID)
    {

        $perfil = Perfil::findFirstByID($ID);
        if (!$perfil) {
            $this->flash->error("perfil was not found");

            return $this->dispatcher->forward(array(
                "controller" => "perfil",
                "action" => "index"
            ));
        }

        if (!$perfil->delete()) {

            foreach ($perfil->getMessages() as $message) {
                $this->flash->error($message);
            }

            return $this->dispatcher->forward(array(
                "controller" => "perfil",
                "action" => "search"
            ));
        }

        $this->flash->success("perfil was deleted successfully");

        return $this->dispatcher->forward(array(
            "controller" => "perfil",
            "action" => "index"
        ));
    }

}
