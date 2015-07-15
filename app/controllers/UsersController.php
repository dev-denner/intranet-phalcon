<?php

use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;

class UsersController extends ControllerBase {

  /**
   * Index action
   */
  public function indexAction() {
    $this->persistent->parameters = null;
  }

  /**
   * Searches for users
   */
  public function searchAction() {

    $numberPage = 1;
    if ($this->request->isPost()) {
      $query = Criteria::fromInput($this->di, 'Users', $_POST);
      $this->persistent->parameters = $query->getParams();
    } else {
      $numberPage = $this->request->getQuery('page', 'int');
    }

    $parameters = $this->persistent->parameters;
    if (!is_array($parameters)) {
      $parameters = array();
    }
    $parameters['order'] = 'ID';

    $users = Users::find($parameters);
    if (count($users) == 0) {
      $this->flash->notice('The search did not find any users');

      return $this->dispatcher->forward(array(
                  'controller' => 'users',
                  'action' => 'index'
      ));
    }

    $paginator = new Paginator(array(
        'data' => $users,
        'limit' => 10,
        'page' => $numberPage
    ));

    $this->view->page = $paginator->getPaginate();
  }

  /**
   * Displays the creation form
   */
  public function newAction() {
    
  }

  /**
   * Edits a user
   *
   * @param string $ID
   */
  public function editAction($ID) {

    if (!$this->request->isPost()) {

      $user = Users::findFirstByID($ID);
      if (!$user) {
        $this->flash->error('user was not found');

        return $this->dispatcher->forward(array(
                    'controller' => 'users',
                    'action' => 'index'
        ));
      }

      $this->view->ID = $user->ID;

      $this->tag->setDefault('ID', $user->getID());
      $this->tag->setDefault('CPF', $user->getCpF());
      $this->tag->setDefault('PASSWORD', $user->getPassworD());
      $this->tag->setDefault('EMAIL', $user->getEmaiL());
      $this->tag->setDefault('NAME', $user->getNamE());
      $this->tag->setDefault('STATUS', $user->getStatuS());
    }
  }

  /**
   * Creates a new user
   */
  public function createAction() {

    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  'controller' => 'users',
                  'action' => 'index'
      ));
    }

    $user = new Users();

    $user->setCpF($this->request->getPost('CPF'));
    $user->setPassworD($this->request->getPost('PASSWORD'));
    $user->setEmaiL($this->request->getPost('EMAIL'));
    $user->setNamE($this->request->getPost('NAME'));
    $user->setStatuS($this->request->getPost('STATUS'));

    if (!$user->save()) {
      foreach ($user->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  'controller' => 'users',
                  'action' => 'new'
      ));
    }

    $this->flash->success('user was created successfully');

    return $this->dispatcher->forward(array(
                'controller' => 'users',
                'action' => 'index'
    ));
  }

  /**
   * Saves a user edited
   *
   */
  public function saveAction() {

    if (!$this->request->isPost()) {
      return $this->dispatcher->forward(array(
                  'controller' => 'users',
                  'action' => 'index'
      ));
    }

    $ID = $this->request->getPost('ID');

    $user = Users::findFirstByID($ID);
    if (!$user) {
      $this->flash->error('user does not exist ' . $ID);

      return $this->dispatcher->forward(array(
                  'controller' => 'users',
                  'action' => 'index'
      ));
    }

    $user->setCpF($this->request->getPost('CPF'));
    $user->setPassworD($this->request->getPost('PASSWORD'));
    $user->setEmaiL($this->request->getPost('EMAIL'));
    $user->setNamE($this->request->getPost('NAME'));
    $user->setStatuS($this->request->getPost('STATUS'));

    if (!$user->save()) {

      foreach ($user->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  'controller' => 'users',
                  'action' => 'edit',
                  'params' => array($user->ID)
      ));
    }

    $this->flash->success('user was updated successfully');

    return $this->dispatcher->forward(array(
                'controller' => 'users',
                'action' => 'index'
    ));
  }

  /**
   * Deletes a user
   *
   * @param string $ID
   */
  public function deleteAction($ID) {

    $user = Users::findFirstByID($ID);
    if (!$user) {
      $this->flash->error('user was not found');

      return $this->dispatcher->forward(array(
                  'controller' => 'users',
                  'action' => 'index'
      ));
    }
    Users::findFirst(7)->delete();
exit;
    if (!$user->delete()) {

      foreach ($user->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->dispatcher->forward(array(
                  'controller' => 'users',
                  'action' => 'search'
      ));
    } else {

      $this->flash->success('user was deleted successfully');

      return $this->dispatcher->forward(array(
                  'controller' => 'users',
                  'action' => 'index'
      ));
    }
  }

}
