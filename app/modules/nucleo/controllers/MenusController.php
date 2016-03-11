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
use Nucleo\Models\Menus;
use Nucleo\Forms\MenusForm;

class MenusController extends ControllerBase {

  /**
   *
   * @var type 
   */
  public $entity;

  /**
   * initialize
   */
  public function initialize() {
    $this->tag->setTitle(' Menus ');
    parent::initialize();

    $this->entity = new Menus();
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
      $query = Criteria::fromInput($this->di, '\Nucleo\Models\Menus', $_POST);
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

    $menus = Menus::find($parameters);

    $paginator = new Paginator(array(
        'data' => $menus,
        'limit' => $limiter,
        'page' => $numberPage
    ));

    $datatable = new Datatable();
    $datatable->setTitle('Menus');
    $datatable->setSubTitle('Todos os usuários do sistema.');
    $datatable->setUrl($this->uri . 'menus/');
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
        'title' => 'Título',
        'slug' => 'Slug',
        'parents' => 'Pai',
        'action' => 'Ação',
    ];
  }

  public function getDatas($dados) {

    $return = [];
    $rows = [];
    $header = $this->getHeader();

    foreach ($dados->items as $num => $object) {
      foreach ($header as $keyHeader => $valueHeader) {
        if ($keyHeader == 'parents') {
          $rows[$keyHeader] = $object->menus->title;
        } elseif ($keyHeader == 'action') {
          $rows[$keyHeader] = $object->actions->title;
        } else {
          $rows[$keyHeader] = $object->$keyHeader;
        }
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
    $menu = $this->entity;
    $form = ['type' => 'insert'];
    $menuForm = new MenusForm($menu, $form);
    $this->view->form = $menuForm;
  }

  /**
   * 
   */
  private function newAjax() {
    $menu = $this->entity;

    $form = [
        'type' => 'insert',
        'title' => false
    ];

    $menuForm = new MenusForm($menu, $form);
    $this->view->disable();
    echo $menuForm->renderForm();
  }

  /**
   * Edits a menu
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
      $this->flash->error('Menu não encontrado');
      return $this->response->redirect('menus');
    }

    $menu = Menus::find(array(
                'conditions' => 'id = ?1',
                'bind' => array(1 => $id)
    ));

    if (!$menu) {
      $this->flash->error('Menu não encontrado');
      return $this->response->redirect('menus');
    }

    $form = [
        'type' => 'update',
    ];

    $menu = $menu[0];
    $menuForm = new MenusForm($menu, $form);
    $this->view->form = $menuForm;
  }

  /**
   * 
   * @param type $id
   */
  private function editAjax($id) {

    if (!is_null($id)) {
      $menu = Menus::find(array(
                  'conditions' => 'id = ?1',
                  'bind' => array(1 => $id)
      ));
      if ($menu) {

        $form = [
            'type' => 'update',
            'title' => false
        ];

        $menu = $menu[0];
        $menuForm = new MenusForm($menu, $form);
        $this->view->disable();

        echo $menuForm->renderForm();
      } else {
        echo 'Menu não encontrado!';
      }
    } else {
      echo 'Menu não encontrado!';
    }
  }

  /**
   * Creates a new menu
   */
  public function createAction() {
    if (!$this->request->isPost()) {
      $this->flash->error('Acesso Inválido');
      return $this->response->redirect('menus');
    }

    $menu = $this->entity;

    $form = [
        'action' => 'validation',
        'type' => 'insert',
    ];

    $menuForm = new MenusForm($menu, $form);

    $data = $this->request->getPost();

    if (!$menuForm->isValid($data, $menu)) {
      foreach ($menuForm->getMessages() as $message) {
        $this->flash->error($message);
      }
      return $this->response->redirect('menus/new');
    }

    $menu->setId($menu->autoincrement());
    $menu->setTitle($this->request->getPost('title', 'string'));
    $menu->setSlug($this->request->getPost('slug', 'string'));
    $menu->setParents($this->request->getPost('parents', 'int'));
    $menu->setAction($this->request->getPost('action', 'int'));

    if (!$menu->create()) {
      foreach ($menu->getMessages() as $message) {
        $this->flash->error($message);
      }
      return $this->response->redirect('menus/new');
    }
    $this->flash->success('Menu criado com sucesso');
    return $this->response->redirect('menus');
  }

  /**
   * Saves a menu edited
   *
   */
  public function saveAction() {

    if (!$this->request->isPost()) {
      $this->flash->error('Acesso Inválido');
      return $this->response->redirect('menus');
    }
    $id = $this->request->getPost('id', 'int');

    $menu = Menus::find(array(
                'conditions' => 'id = ?1',
                'bind' => array(1 => $id)
    ));
    if (!$menu) {
      $this->flash->error('Menu ' . $id . ' não existe');
      return $this->response->redirect('menus');
    }

    $menu = $menu[0];

    $form = [
        'action' => 'validation',
        'type' => 'update',
    ];

    $menuForm = new MenusForm($menu, $form);

    $data = $this->request->getPost();

    var_dump($menuForm->isValid($data, $menu));
    if (!$menuForm->isValid($data, $menu)) {
      foreach ($menuForm->getMessages() as $message) {
        $this->flash->error($message);
      }
      return $this->response->redirect('menus/edit/' . $id);
    }

    $menu->setId($this->request->getPost('id'));
    $menu->setTitle($this->request->getPost('title', 'string'));
    $menu->setSlug($this->request->getPost('slug', 'string'));
    $menu->setParents($this->request->getPost('parents', 'int'));
    $menu->setAction($this->request->getPost('action', 'int'));

    if (!$menu->update()) {

      foreach ($menu->getMessages() as $message) {
        $this->flash->error($message);
      }
      return $this->response->redirect('menus/edit/' . $menu->id);
    }
    $this->flash->success('Menu atualizado com sucesso');
    return $this->response->redirect('menus');
  }

  /**
   * Deletes a menu
   *
   * @param string $id
   */
  public function deleteAction() {

    if ($this->request->isAjax()) {
      $this->deleteAjax();
    } else {
      $this->deletePost();
    }
  }

  /**
   * 
   * @param type $id
   * @return type
   */
  private function deletePost($id) {

    if (!$this->request->isPost()) {
      $this->flash->error('Acesso Inválido.');
      return $this->response->redirect('menus');
    }

    $menu = Menus::find(array(
                'conditions' => 'id = ?1',
                'bind' => array(1 => $this->request->getPost('id'))
    ));

    if (!$menu) {
      $this->flash->error('Menu não encontrado.');
      return $this->response->redirect('menus');
    }

    if (!$menu->delete()) {

      foreach ($menu->getMessages() as $message) {
        $this->flash->error($message);
      }
      return $this->response->redirect('menus');
    }
    $this->flash->success('Menu deletado com sucesso.');
    return $this->response->redirect('menus');
  }

  /**
   * 
   * @return type
   */
  private function deleteAjax() {

    if (!$this->request->isPost()) {
      echo 'Acesso Inválido.';
      return $this->response->redirect('menus');
    }
    $this->view->disable();
    $menu = Menus::find(array(
                'conditions' => 'id = ?1',
                'bind' => array(1 => $this->request->getPost('id', 'int'))
    ));

    if ($menu) {
      if (!$menu->delete()) {
        $return = '';
        foreach ($menu->getMessages() as $message) {
          $return .= $message;
        }
        echo $return;
      } else {
        echo 'ok';
      }
    } else {
      echo 'Menu não encontrado';
    }
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
    return $this->response->redirect('menus');
  }

  /**
   * 
   * @param type $id
   */
  private function viewAjax($id) {

    $header = $this->getHeader();
    $data = [];

    $menu = Menus::find(array(
                'conditions' => 'id = ?1',
                'bind' => array(1 => (int) $id)
    ));

    foreach ($menu as $num => $object) {
      foreach ($header as $keyHeader => $valueHeader) {
        if ($keyHeader == 'parents') {
          $data[$keyHeader] = $object->menus->title;
        } elseif ($keyHeader == 'action') {
          $data[$keyHeader] = $object->actions->title;
        } else {
          $data[$keyHeader] = $object->$keyHeader;
        }
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
   * Searches for menus
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
    return $this->response->redirect('menus');
  }

  /**
   * 
   */
  private function searchAjax() {

    $form = [
        'type' => 'search',
        'title' => false
    ];

    $menu = $this->entity;
    $menuForm = new MenusForm($menu, $form);

    if (!is_null($this->persistent->searchparameters)) {

      $menu->setTitle($this->persistent->searchparameters['title']);
      $menu->setSlug($this->persistent->searchparameters['slug']);
      $menu->setParents($this->persistent->searchparameters['parents']);
      $menu->setAction($this->persistent->searchparameters['action']);
    }
    $this->view->disable();
    echo $menuForm->renderForm();
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
