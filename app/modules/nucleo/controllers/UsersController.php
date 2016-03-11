<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Controllers;

use Phalcon\Mvc\Model\Criteria as Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;
use DevDenners\Library\DataTable\Datatable;
use Nucleo\Models\Users;
use Nucleo\Forms\UsersForm;

class UsersController extends ControllerBase {

  /**
   *
   * @var type 
   */
  public $entity;

  /**
   * initialize
   */
  public function initialize() {
    $this->tag->setTitle(' Usuários ');
    parent::initialize();

    $this->entity = new Users();
  }

  /**
   * Index action
   * 
   * @return type
   */
  public function indexAction() {

    $numberPage = 1;

    if ($this->request->isPost()) {
      $this->setSessionDataTable();
      $query = Criteria::fromInput($this->di, '\Nucleo\Models\Users', $_POST);
      $this->persistent->parameters = $query->getParams();
      $this->persistent->parameters = $this->setSearch($this->entity);
      $this->persistent->searchparameters = $_POST;
    } else {
      $numberPage = $this->request->getQuery('page', 'int', 1, true);
    }

    $limiter = empty($this->session->get('datatable_length')) ? 10 : $this->session->get('datatable_length');
    $filter = empty($this->session->get('datatable_filter')) ? '' : $this->session->get('datatable_filter');
    $order = empty($this->session->get('datatable_order')) ? 'id' : $this->session->get('datatable_order');

    $parameters = $this->persistent->parameters;

    if (!is_array($parameters)) {
      $parameters = array();
    }

    $parameters['order'] = $order;

    $users = Users::find($parameters);

    $paginator = new Paginator(array(
        'data' => $users,
        'limit' => $limiter,
        'page' => $numberPage
    ));

    $datatable = new Datatable();
    $datatable->setTitle('Usuários');
    $datatable->setSubTitle('Todos os usuários do sistema.');
    $datatable->setUrl($this->uri . 'users/');
    $datatable->setAction($this->_actions($this->actionsController()));
    $datatable->setOrder($order);
    $datatable->setLength(['limiter' => $limiter]);
    $datatable->setFilter($filter);
    $datatable->setPagination($paginator->getPaginate());
    $datatable->setHearder($this->getHeader());
    $datatable->setData($this->getDatas($paginator->getPaginate()));

    $this->view->datatable = $datatable;
  }

  public function getHeader() {
    return [
        'id' => 'ID',
        'cpf' => 'CPF',
        'email' => 'E-mail',
        'name' => 'Nome',
        'status' => 'Status',
    ];
  }

  public function getDatas($dados) {

    $return = [];
    $rows = [];
    $header = $this->getHeader();

    foreach ($dados->items as $num => $object) {
      foreach ($header as $keyHeader => $valueHeader) {
        $rows[$keyHeader] = $object->$keyHeader;
      }
      $return[$num] = $rows;
    }

    return $return;
  }

  /**
   * Displays the creation form
   */
  public function newAction() {

    if ($this->request->isAjax()) {
      $this->newAjax();
    } else {
      $this->newGet();
    }
  }

  /**
   * 
   */
  private function newGet() {
    $user = $this->entity;
    $form = ['type' => 'insert'];
    $userForm = new UsersForm($user, $form);
    $this->view->form = $userForm;
  }

  /**
   * 
   */
  private function newAjax() {
    $user = $this->entity;

    $form = [
        'type' => 'insert',
        'title' => false
    ];

    $userForm = new UsersForm($user, $form);
    $this->view->disable();
    echo $userForm->renderForm();
  }

  /**
   * Edits a user
   *
   * @param string $id
   */
  public function editAction($id) {

    if ($this->request->isAjax()) {
      $this->editAjax($id);
    } else {
      $this->editGet($id);
    }
  }

  /**
   * 
   * @param type $id
   * @return type
   */
  private function editGet($id) {
    if (is_null($id)) {
      $this->flash->error('Usuário não encontrado');
      return $this->response->redirect('users');
    }

    $user = Users::find(array(
                'conditions' => 'id = ?1',
                'bind' => array(1 => $id)
    ));

    if (!$user) {
      $this->flash->error('Usuário não encontrado');
      return $this->response->redirect('users');
    }

    $form = [
        'type' => 'update',
    ];

    $user = $user[0];
    $userForm = new UsersForm($user, $form);
    $this->view->form = $userForm;
  }

  /**
   * 
   * @param type $id
   */
  private function editAjax($id) {

    if (!is_null($id)) {
      $user = Users::find(array(
                  'conditions' => 'id = ?1',
                  'bind' => array(1 => $id)
      ));
      if ($user) {

        $form = [
            'type' => 'update',
            'title' => false
        ];

        $user = $user[0];
        $userForm = new UsersForm($user, $form);
        $this->view->disable();

        echo $userForm->renderForm();
      } else {
        echo 'Usuário não encontrado!';
      }
    } else {
      echo 'Usuário não encontrado!';
    }
  }

  /**
   * Creates a new user
   */
  public function createAction() {
    if (!$this->request->isPost()) {
      $this->flash->error('Acesso Inválido');
      return $this->response->redirect('users');
    }

    $user = $this->entity;

    $form = [
        'action' => 'validation',
        'type' => 'insert',
    ];

    $userForm = new UsersForm($user, $form);

    $data = $this->request->getPost();

    if (!$userForm->isValid($data, $user)) {
      foreach ($userForm->getMessages() as $message) {
        $this->flash->error($message);
      }
      return $this->response->redirect('users/new');
    }

    $user->setId($user->autoincrement());
    $user->setCpf($this->request->getPost('cpf', 'int'));
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
    $this->flash->success('Usuário criado com sucesso');
    return $this->response->redirect('users');
  }

  /**
   * Saves a user edited
   *
   */
  public function saveAction() {

    if (!$this->request->isPost()) {
      $this->flash->error('Acesso Inválido');
      return $this->response->redirect('users');
    }
    $id = $this->request->getPost('id', 'int');

    $user = Users::find(array(
                'conditions' => 'id = ?1',
                'bind' => array(1 => $id)
    ));
    if (!$user) {
      $this->flash->error('Usuário ' . $id . ' não existe');
      return $this->response->redirect('users');
    }

    $user = $user[0];

    $form = [
        'action' => 'validation',
        'type' => 'update',
    ];

    $userForm = new UsersForm($user, $form);

    $data = $this->request->getPost();

    var_dump($userForm->isValid($data, $user));
    if (!$userForm->isValid($data, $user)) {
      foreach ($userForm->getMessages() as $message) {
        $this->flash->error($message);
      }
      return $this->response->redirect('users/edit/' . $id);
    }

    $user->setId($this->request->getPost('id'));
    $user->setCpf($this->request->getPost('cpf'));
    $user->setPassword($this->request->getPost('password'));
    $user->setMustChangePassword($this->request->getPost('mustChangePassword'));
    $user->setEmail($this->request->getPost('email', 'email'));
    $user->setName($this->request->getPost('name'));
    $user->setStatus($this->request->getPost('status'));

    if (!$user->update()) {

      foreach ($user->getMessages() as $message) {
        $this->flash->error($message);
      }
      return $this->response->redirect('users/edit/' . $user->id);
    }
    $this->flash->success('Usuário atualizado com sucesso');
    return $this->response->redirect('users');
  }

  /**
   * Deletes a user
   *
   * @param string $id
   */
  public function deleteAction() {

    if ($this->request->isAjax()) {
      $this->deleteAjaxAction();
    } else {
      $this->deletePostAction();
    }
  }

  /**
   * 
   * @param type $id
   * @return type
   */
  private function deletePostAction() {

    if (!$this->request->isPost()) {
      $this->flash->error('Acesso Inválido.');
      return $this->response->redirect('users');
    }

    $user = Users::find(array(
                'conditions' => 'id = ?1',
                'bind' => array(1 => $this->request->getPost('id'))
    ));

    if (!$user) {
      $this->flash->error('Usuário não encontrado.');
      return $this->response->redirect('users');
    }

    if (!$user->delete()) {

      foreach ($user->getMessages() as $message) {
        $this->flash->error($message);
      }
      return $this->response->redirect('users');
    }
    $this->flash->success('Usuário deletado com sucesso.');
    return $this->response->redirect('users');
  }

  /**
   * 
   * @return type
   */
  private function deleteAjaxAction() {
    if (!$this->request->isPost()) {
      echo 'Acesso Inválido.';
      return $this->response->redirect('users');
    }

    $user = Users::find(array(
                'conditions' => 'id = ?1',
                'bind' => array(1 => $this->request->getPost('id', 'int'))
    ));

    if (!$user) {
      return 'Usuário não encontrado';
    }
    if (!$user->delete()) {
      $return = '';
      foreach ($user->getMessages() as $message) {
        $return .= $message;
      }
      echo $return;
    } else {
      echo 'ok';
    }
    exit;
    $this->view->disable();
  }

  /**
   * viewAction
   * access ajax
   */
  public function viewAction($id) {
    if ($this->request->isAjax($id)) {
      $this->viewAjax($id);
    } else {
      $this->viewGet($id);
    }
  }

  /**
   * 
   * @param type $id
   * @return type
   */
  private function viewGet($id) {
    return $this->response->redirect('users');
  }

  /**
   * 
   * @param type $id
   */
  private function viewAjax($id) {

    $header = $this->getHeader();
    $data = [];

    $user = Users::find(array(
                'conditions' => 'id = ?1',
                'bind' => array(1 => (int) $id)
    ));

    foreach ($user as $num => $object) {
      foreach ($header as $keyHeader => $valueHeader) {
        $data[$keyHeader] = $object->$keyHeader;
      }
    }

    $return = [];

    foreach ($header as $key => $value) {

      $return[$key] = [
          'header' => $value,
          'data' => $data[$key],
      ];
    }

    $this->view->disable();
    echo $this->makeView($return, 'dl-horizontal');
  }

  /**
   * Searches for users
   * access ajax
   */
  public function searchAction() {

    if ($this->request->isAjax()) {
      $this->searchAjax();
    } else {
      $this->searchGet();
    }
  }

  /**
   * 
   * @return type
   */
  private function searchGet() {
    return $this->response->redirect('users');
  }

  /**
   * 
   */
  private function searchAjax() {

    $form = [
        'type' => 'search',
        'title' => false
    ];

    $user = $this->entity;
    $userForm = new UsersForm($user, $form);

    if (!is_null($this->persistent->searchparameters)) {
      $user->setCpf($this->persistent->searchparameters['cpf']);
      $user->setEmail($this->persistent->searchparameters['email']);
      $user->setName($this->persistent->searchparameters['name']);
      $user->setStatus($this->persistent->searchparameters['status']);
    }
    $this->view->disable();
    echo $userForm->renderForm();
  }

  /**
   * 
   * @return type
   */
  private function actionsController() {
    return [
        'add' => [],
        'search' => [],
        'print' => [],
        'excel' => [],
        'pdf' => [],
        'word' => [],
    ];
  }

}
