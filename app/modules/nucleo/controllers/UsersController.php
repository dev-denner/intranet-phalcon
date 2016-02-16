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
use \DataTables\DataTable;
use Nucleo\Models\Users;
use Nucleo\Forms\UsersForm;

class UsersController extends ControllerBase {

  public function initialize() {
    $this->tag->setTitle(' Usuários ');
    parent::initialize();
  }

  /**
   * Index action
   */
  public function indexAction() {
    $this->persistent->parameters = null;

    $user = new Users();
    $userForm = new UsersForm($user, ['action' => 'search']);
    $this->view->form = $userForm;
  }

  /**
   * Searches for users
   */
  public function searchAction() {
    $numberPage = 1;
    if ($this->request->isPost()) {
      
      $query = Criteria::fromInput($this->di, '\Nucleo\Models\Users', $_POST);
      $this->persistent->parameters = $query->getParams();
    } else {
      
      $numberPage = $this->request->getQuery('page', 'int');
    }

    $parameters = $this->persistent->parameters;
    if (!is_array($parameters)) {
      $parameters = array();
    }
    $parameters['order'] = 'id';

    $users = Users::find($parameters);
    if (count($users) == 0) {
      $this->flash->notice('The search did not find any users');

      return $this->response->redirect('users');
    }

    $paginator = new Paginator(array(
        'data' => $users,
        'limit' => 10,
        'page' => $numberPage
    ));

    $this->view->page = $paginator->getPaginate();
  }

  public function search2Action() {
    if ($this->request->isAjax()) {
      $array = $this->modelsManager->createQuery("SELECT * FROM \Nucleo\Models\Users")
                      ->execute()->toArray();

      $dataTables = new DataTable();
      $dataTables->fromArray($array)->sendResponse();
      $this->view->disable();
    }
  }

  /**
   * Displays the creation form
   */
  public function newAction() {
    $user = new Users();
    $userForm = new UsersForm($user, ['action' => 'insert']);
    $this->view->form = $userForm;
  }

  /**
   * Edits a user
   *
   * @param string $id
   */
  public function editAction($id) {
    if (!$this->request->isPost()) {

      $user = Users::find(array(
                  'conditions' => 'id = ?1',
                  'bind' => array(1 => $id)
      ));

      if (!$user) {
        $this->flash->error('user was not found');

        return $this->response->redirect('users');
      }

      $user = $user[0];

      $userForm = new UsersForm($user, ['action' => 'update']);
      $this->view->form = $userForm;
    }
  }

  /**
   * Creates a new user
   */
  public function createAction() {
    if (!$this->request->isPost()) {
      return $this->response->redirect('users');
    }

    $user = new Users();

    $user->setId($this->request->getPost('id'));
    $user->setCpf($this->request->getPost('cpf'));
    $user->setPassword($this->request->getPost('password'));
    $user->setMustChangePassword($this->request->getPost('mustChangePassword'));
    $user->setEmail($this->request->getPost('email', 'email'));
    $user->setName($this->request->getPost('name'));
    $user->setStatus($this->request->getPost('status'));

    if (!$user->create()) {
      foreach ($user->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->response->redirect('users/new');
    }

    $this->flash->success('user was created successfully');

    return $this->response->redirect('users');
  }

  /**
   * Saves a user edited
   *
   */
  public function saveAction() {

    if (!$this->request->isPost()) {
      return $this->response->redirect('users');
    }

    $id = $this->request->getPost('id');

    $user = Users::find(array(
                'conditions' => 'id = ?1',
                'bind' => array(1 => $id)
    ));
    if (!$user) {
      $this->flash->error('user does not exist ' . $id);

      return $this->response->redirect('users');
    }

    $user = $user[0];

    $user->setId($this->request->getPost('id'));
    $user->setCpf($this->request->getPost('cpf'));
    $user->setPassword($this->request->getPost('password'));
    $user->setMustChangePassword($this->request->getPost('mustChangePassword'));
    $user->setEmail($this->request->getPost('email', 'email'));
    $user->setName($this->request->getPost('name'));
    $user->setStatus($this->request->getPost('status'));



    if (!$user->save()) {

      foreach ($user->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->response->redirect('users/edit/' . $user->id);
    }

    $this->flash->success('user was updated successfully');

    return $this->response->redirect('users');
  }

  /**
   * Deletes a user
   *
   * @param string $id
   */
  public function deleteAction($id) {
    $user = Users::find(array(
                'conditions' => 'id = ?1',
                'bind' => array(1 => $id)
    ));
    if (!$user) {
      $this->flash->error('user was not found');

      return $this->response->redirect('users');
    }

    $user = $user[0];

    if (!$user->delete()) {

      foreach ($user->getMessages() as $message) {
        $this->flash->error($message);
      }

      return $this->response->redirect('users');
    }

    $this->flash->success('user was deleted successfully');

    return $this->response->redirect('users');
  }

}
