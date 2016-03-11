<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Controllers;

use Phalcon\Mvc\Controller;
use Phalcon\DI\FactoryDefault as Di;

class ControllerBase extends Controller {

  /**
   *
   * @var type 
   */
  protected $uri = '';

  /**
   * 
   */
  public function initialize() {

    $di = $this->di->get('config');
    $this->uri = $di->application->baseUri;

    $this->tag->prependTitle('Intranet | ');
    $this->tag->appendTitle(' | Grupo MPE');
    $this->view->setTemplateAfter('main');
    $this->view->titleLogo = 'Grupo MPE';
  }

  public function _actions(array $actions = []) {

    $options = [];

    foreach ($actions as $key => $value) {
      $options['action'][$key] = $this->actionDefault($key, $value);
    }
    return $options;
  }

  /**
   * 
   * @param type $from
   * @param array $actions
   * @return type
   */
  private function actionDefault($from = '', array $actions = []) {

    $action = $label = '';
    $view = [
        'type' => '',
        'icon' => '',
    ];

    switch ($from) {
      case 'view':
        $action = 'view';
        $label = 'Visualizar';
        $view = [
            'type' => 'font',
            'icon' => 'fa fa-eye',
        ];
        break;
      case 'add':
        $action = 'new';
        $label = 'Incluir';
        $view = [
            'type' => 'font',
            'icon' => 'fa fa-plus-circle',
        ];
        break;
      case 'edit':
        $action = 'edit';
        $label = 'Editar';
        $view = [
            'type' => 'font',
            'icon' => 'fa fa-pencil-square-o',
        ];
        break;
      case 'delete':
        $action = 'delete';
        $label = 'Excluir';
        $view = [
            'type' => 'font',
            'icon' => 'fa fa-trash',
        ];
        break;
      case 'search':
        $action = 'search';
        $label = 'Busca Avançada';
        $view = [
            'type' => 'font',
            'icon' => 'fa fa-search',
        ];
        break;
      case 'print':
        $action = 'print';
        $label = 'Imprimir';
        $view = [
            'type' => 'font',
            'icon' => 'fa fa-print',
        ];
        break;
      case 'excel':
        $action = 'excel';
        $label = 'Excel';
        $view = [
            'type' => 'font',
            'icon' => 'fa fa-file-excel-o',
        ];
        break;
      case 'pdf':
        $action = 'pdf';
        $label = 'PDF';
        $view = [
            'type' => 'font',
            'icon' => 'fa fa-file-pdf-o',
        ];
        break;
      case 'word':
        $action = 'word';
        $label = 'Word';
        $view = [
            'type' => 'font',
            'icon' => 'fa fa-file-word-o',
        ];
        break;
      default:
        $action = '_';
        $label = 'Default';
        $view = [
            'type' => 'font',
            'icon' => 'glyphicon glyphicon-plus',
        ];
        break;
    }

    if (!empty($actions)) {

      if (array_key_exists('action', $actions)) {
        $action = $actions['id'];
      }

      if (array_key_exists('action', $actions)) {
        $action = $actions['action'];
      }

      if (array_key_exists('label', $actions)) {
        $label = $actions['label'];
      }

      if (array_key_exists('view', $actions)) {
        $view = $actions['view'];
      }
    }

    return [
        'action' => $action,
        'label' => $label,
        'view' => $view,
    ];
  }

  /**
   * 
   * @param type $data
   * @param type $entity
   * @return type
   */
  public function getFields($data, $entity) {

    $typeForms = $entity->typeForms();
    $typeForms = $typeForms['view'];
    $return = [];


    foreach ($data as $value) {
      foreach ($typeForms as $key => $permission) {
        if ($permission) {
          $return[$key] = $value->$key;
        }
      }
    }
    return $return;
  }

  /**
   * 
   * @param type $search
   * @param type $entity
   * @param type $par
   * @return string
   */
  public function makeSearch($search, $entity, $par = false) {

    $return = [];
    $fields = $this->getHeader($entity);

    $words = str_replace(' ', '%', $search);

    $and = $par ? ' AND ' : '';

    $return['conditions'] .= $and . '(';

    foreach ($fields as $key => $value) {
      $return['conditions'] .= ' UPPER([' . $key . ']) LIKE UPPER(:' . $key . 's:) OR ';
      $return['bind'][$key . 's'] = "%$words%";
    }

    $return['conditions'] = substr($return['conditions'], 0, -3);
    $return['conditions'] .= ') ';

    return $return;
  }

  /**
   * 
   * @param type $paramCriteria
   * @param type $entity
   */
  public function setSearch($entity) {

    $length = $this->session->get('datatable_length');
    $filter = $this->session->get('datatable_filter');
    $return = [];

    if (!empty($filter)) {

      $par = false;

      if (!is_null($this->persistent->parameters)) {
        $par = true;
      }
      $search = $this->makeSearch($filter, $entity, $par);
      $parameters = $this->persistent->parameters;

      if (!is_array($parameters)) {
        $parameters = array();
      }

      if ($par) {
        $return['conditions'] = $parameters['conditions'] . $search['conditions'];
        $return['bind'] = array_merge($parameters['bind'], $search['bind']);
      } else {
        $return = $search;
      }
    } else {
      $return = $this->persistent->parameters;
    }

    return $return;
  }

  /**
   * 
   */
  public function setSessionDataTable() {

    $keyLength = array_key_exists('datatable_length', $_POST);

    if ($keyLength !== false) {
      $this->session->set('datatable_length', $_POST['datatable_length']);
      unset($_POST['datatable_length']);
    }

    $keyFilter = array_key_exists('datatable_filter', $_POST);

    if ($keyFilter !== false) {
      $this->session->set('datatable_filter', $_POST['datatable_filter']);
      unset($_POST['datatable_filter']);
    }

    $keyOrder = array_key_exists('datatable_order', $_POST);

    if ($keyOrder !== false) {
      $this->session->set('datatable_order', $_POST['datatable_order']);
      unset($_POST['datatable_order']);
    }
  }

  /**
   * 
   * @param type $data
   * @param type $type
   * @param type $columns
   * @return string
   */
  public function makeView($data, $type = '', $columns = 2) {

    $render = '<div class="row">';
    $grid = 'col-md-' . 12 / $columns;
    $render .= "<dl class='$type $grid'>";

    $count = count($data);
    $i = 0;

    foreach ($data as $key => $value) {

      if ($i >= $count / $columns) {
        $render .= "</dl><dl class='$type $grid'>";
        $i = 0;
      }

      $render .= "<dt class='{$key}'>{$value['header']}:</dt>";
      $render .= "<dd>{$value['data']}</dd>";

      $i++;
    }

    $render .= '</dl>';
    $render .= '</div>';

    return $render;
  }

  /**
   * 
   * @param type $header
   * @return type
   */
  public function getOrder($header) {

    $return = '';
    $keys = array_keys($header);

    foreach ($keys as $value) {
      $return .= $value . ', ';
    }

    return substr($return, 0, -2);
  }

}
