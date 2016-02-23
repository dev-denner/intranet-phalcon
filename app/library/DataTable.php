<?php

/**
 * Description of DataTable
 *
 * @author denner.fernandes
 */

namespace System\Library;

use Phalcon\Paginator\Adapter\Model as Paginator;

class DataTable extends \Phalcon\Mvc\User\Plugin {

  /**
   *
   * @var object
   */
  private $data;

  /**
   *
   * @var array
   */
  private $entity;

  /**
   *
   * @var array
   */
  private $page;

  /**
   *
   * @var array
   */
  private $button;

  /**
   *
   * @var string
   */
  private $search;

  /**
   *
   * @var array
   */
  private $order;

  /**
   *
   * @var array
   */
  private $action;

  /**
   *
   * @var object
   */
  private $pagination;

  /**
   *
   * @var array
   */
  private $list;

  /**
   *
   * @var string
   */
  private $url;

  /**
   * Returns the value of field data
   *
   * @return object
   */
  public function getData() {
    return $this->data;
  }

  /**
   * Returns the value of field entity
   *
   * @return array
   */
  public function getEntity() {
    return $this->entity;
  }

  /**
   * Returns the value of field page
   *
   * @return array
   */
  public function getPage() {
    return $this->page;
  }

  /**
   * Returns the value of field button
   *
   * @return array
   */
  public function getButton() {
    return $this->button;
  }

  /**
   * Returns the value of field search
   *
   * @return string
   */
  public function getSearch() {
    return $this->search;
  }

  /**
   * Returns the value of field order
   *
   * @return array
   */
  public function getOrder() {
    return $this->order;
  }

  /**
   * Returns the value of field action
   *
   * @return array
   */
  public function getAction() {
    return $this->action;
  }

  /**
   * Returns the value of field pagination
   *
   * @return object
   */
  public function getPagination() {
    return $this->pagination;
  }

  /**
   * Method to set the value of field data
   *
   * @param array $data
   * @return $this
   */
  public function setData($data) {

    if (isset($data['data'])) {
      $this->data = $data['data'];
    } else {
      //validacao da notificacao
    }
    return $this;
  }

  /**
   * Method to set the value of field entity
   *
   * @param array $entity
   * @return $this
   */
  public function setEntity($entity) {

    if (isset($entity['entity'])) {
      $this->entity = $entity['entity'];
    } else {
      //validacao da notificacao
    }
    return $this;
  }

  /**
   * Method to set the value of field page
   *
   * @param array $page
   * @return $this
   */
  public function setPage($page) {

    $di = $this->di->get('config');

    if (isset($page['page'])) {
      $this->page = $page['page'];

      if (!isset($this->page['select'])) {
        $this->page['select'] = $di->pagination->select;
      }
      if (!isset($this->page['options'])) {
        $this->page['options'] = $di->pagination->options;
      }
      if (!isset($this->page['current'])) {
        $this->page['current'] = 1;
      }
      if (!isset($this->page['pages'])) {
        $this->page['pages'] = $di->pagination->pages;
      }
    }
    return $this;
  }

  /**
   * Method to set the value of field button
   *
   * @param array $button
   * @return $this
   */
  public function setButton($button) {

    if (isset($button['button'])) {
      $this->button = $button['button'];
    }
    return $this;
  }

  /**
   * Method to set the value of field search
   *
   * @param string $search
   * @return $this
   */
  public function setSearch($search) {

    if (isset($search['search'])) {
      $this->search = $search['search'];
    }
    return $this;
  }

  /**
   * Method to set the value of field order
   *
   * @param array $order
   * @return $this
   */
  public function setOrder($order) {

    if (isset($order['order'])) {
      $this->order = $order['order'];
    }
    return $this;
  }

  /**
   * Method to set the value of field action
   *
   * @param array $action
   * @return $this
   */
  public function setAction($action) {

    if (isset($action['action'])) {
      $this->action = $action['action'];
    }
    return $this;
  }

  /**
   * Method to set the value of field pagination
   *
   * @param object $pagination
   * @return $this
   */
  public function setPagination($pagination) {
    $this->pagination = $pagination;
    return $this;
  }

  /**
   * Method to set the value of field pagination
   *
   * @param object $pagination
   * @return $this
   */
  public function setList() {
    $desc = $this->entity['desc'];
    $typeForms = $this->entity['forms'];

    foreach ($typeForms as $option => $permission) {
      if ($option == 'list') {
        foreach ($desc as $nameInput => $attr) {
          if ($permission[$nameInput]) {
            $this->list[$nameInput] = $attr['title'];
          }
        }
      }
    }
  }

  /**
   * Method to set the value of field url
   *
   * @param string $url
   * @return $this
   */
  public function setUrl($url) {

    if (isset($url['url'])) {
      $this->url = $url['url'];
    } else {
      //validacao da notificacao
    }
    return $this;
  }

  /**
   * Construct for class.
   * @param array $options
   */
  public function __construct($options = []) {

    $this->setData($options);
    $this->setEntity($options);
    $this->setPage($options);
    $this->setButton($options);
    $this->setSearch($options);
    $this->setOrder($options);
    $this->setAction($options);
    $this->setList();
    $this->setUrl($options);
  }

  public function render() {

    $render = '';
    $this->makePagination();


    $render .= '<div class="table-responsive">';
    $render .= '<table class="table table-bordered table-condensed table-hover table-striped DataTable">';

    //tHeader
    $render .= $this->renderHead();

    //tBody
    $render .= $this->renderOrder();
    $render .= $this->renderData();
    //tFoot
    $render .= $this->renderFoot();

    $render .= '</table>';
    $render .= '</div>';

    return $render;
  }

  public function renderHead() {
    $render = '';

    $colspan = count($this->list);

    $render .= '<thead>';
    $render .= '<tr>';
    $render .= '<td colspan="' . $colspan . '">';

    $render .= '<div class="row">';
    $render .= '<div class="col-md-3 col-xs-5">' . $this->renderPage() . '</div>';
    $render .= '<div class="col-md-6 col-xs-7">' . $this->renderButton() . '</div>';
    $render .= '<div class="col-md-3 col-xs-12">' . $this->renderSearch() . '</div>';
    $render .= '</div>';

    $render .= '</td>';
    $render .= '</tr>';
    $render .= '</thead>';

    return $render;
  }

  public function renderFoot() {
    $render = '';

    $colspan = count($this->list);

    $render .= '<thead>';
    $render .= '<tr>';
    $render .= '<td colspan="' . $colspan . '">';

    $render .= '<div class="row">';
    $render .= '<div class="col-md-3 col-xs-12">' . $this->renderInfo() . '</div>';
    $render .= '<div class="col-md-4 col-xs-6">' . $this->renderAction() . '</div>';
    $render .= '<div class="col-md-5 col-xs-6">' . $this->renderPagination() . '</div>';
    $render .= '</div>';

    $render .= '</td>';
    $render .= '</tr>';
    $render .= '</thead>';

    return $render;
  }

  private function makePagination() {
    $paginator = new Paginator(array(
        'data' => $this->data,
        'limit' => $this->page['select'],
        'page' => $this->page['current']
    ));

    $this->setPagination($paginator);
    return $this;
  }

  private function renderPage() {

    $render = '';
    $selected = '';

    $render .= '<div class="DataTable_Page">';
    $render .= '<div class="form-group">';
    $render .= '<div class="row">';
    $render .= '<div class="col-sm-4">';
    $render .= '<select aria-controls="data_table_page" class="form-control input-sm" id="data_table_page">';
    foreach ($this->page['options'] as $value) {
      $selected = $value == $this->page['select'] ? 'selected="selected"' : '';
      $render .= '<option value="' . $value . '" ' . $selected . '>' . $value . '</option>';
    }
    $render .= '</select>';
    $render .= '</div>';
    $render .= '<label for="data_table_page" class="col-sm-8 control-label hidden-xs"> registros por página</label>';
    $render .= '</div>';
    $render .= '</div>';
    $render .= '</div>';

    return $render;
  }

  private function renderButton() {

    if (!empty($this->button)) {

      $render = '';

      $render .= '<div class="DataTable_Button">';
      $render .= '<div class="btn-group">';

      foreach ($this->button as $value) {

        $render .= '<a class="btn btn-default btn-sm" tabindex="0" aria-controls="data_table_button" onclick="' . $value['action'] . '">';
        $render .= '<span>' . $value['label'] . '</span>';
        $render .= '</a>';
      }

      $render .= '</div>';
      $render .= '</div>';
    }

    return $render;
  }

  private function renderSearch() {

    $render = '';

    $render .= '<div class="DataTable_Search">';
    $render .= '<div class="form-group">';
    $render .= '<div class="row">';
    $render .= '<label for="data_table_search" class="col-sm-4 control-label">Pesquisa: </label>';
    $render .= '<div class="col-sm-8">';
    $render .= '<input type="search" value="' . $this->search . '" class="form-control input-sm" id="data_table_search" aria-controls="data_table_search" />';

    $render .= '</div>';
    $render .= '</div>';
    $render .= '</div>';

    return $render;
  }

  private function renderOrder() {

    $render = '';

    $render .= '<tr class="DataTable_Order">';
    foreach ($this->list as $key => $value) {
      $render .= '<th data-field="' . $key . '">' . $value . '</th>';
    }

    $render .= '</tr>';

    return $render;
  }

  private function renderData() {

    $data = $this->pagination->getPaginate()->items;
    $render = '';

    $render .= '<tbody>';
    foreach ($data as $items) {
      $render .= '<tr>';
      foreach ($this->list as $key => $value) {
        $render .= '<td>' . $items->$key . '</td>';
      }
      $render .= '</tr>';
    }
    $render .= '</tbody>';

    return $render;
  }

  private function renderInfo() {

    $data = $this->pagination->getPaginate();
    $start = ($data->current * $data->limit) - ($data->limit - 1);
    $total = $data->total_items;
    $aux = $data->current * $data->limit;
    $finish = $aux > $total ? $total : $aux;
    $render = '';

    $render .= '<div class="DataTable_Info" role="alert">';
    $render .= 'Exibindo ' . $start . ' a ' . $finish . ' de ' . $total . ' registro(s)';
    $render .= '</div>';

    return $render;
  }

  private function renderAction() {
    if (!empty($this->action)) {

      $render = '';

      $render .= '<div class="DataTable_Action">';
      $render .= '<div class="btn-group">';

      foreach ($this->action as $value) {

        $render .= '<a class="btn btn-link btn-sm" tabindex="0" aria-controls="data_table_action" onclick="' . $value['action'] . '">';
        $render .= '<span>' . $value['label'] . '</span>';
        $render .= '</a>';
      }

      $render .= '  </div>';
      $render .= '</div>';
    }

    return $render;
  }

  private function renderPagination() {

    $di = $this->di->get('config');
    $uri = $di->application->baseUri;
    $data = $this->pagination->getPaginate();

    $urlFirst = $uri . $this->url;
    $urlBefore = $uri . $this->url . '?page=' . $data->before;
    $urlCurrent = $uri . $this->url . '?page=';
    $urlNext = $uri . $this->url . '?page=' . $data->next;
    $urlLast = $uri . $this->url . '?page=' . $data->last;
    $total_pages = $data->total_pages;
    $pages = $this->page['pages'] > $total_pages ? $total_pages : $this->page['pages'];

    $active = '';

    $render = '';

    $render .= '<div class="DataTable_Pagination">';
    $render .= '<ul class="pagination pagination-sm" aria-controls="data_table_pagination">';

    $active = $data->current == $data->before ? 'disabled' : '';
    $render .= '<li class="' . $active . '">';
    $render .= '<a href="' . $urlBefore . '" title="Anterior">Anterior</a>';
    $render .= '</li>';

    $active = $data->current == $data->first ? 'disabled' : '';
    $render .= '<li class="' . $active . '">';
    $render .= '<a href="' . $urlFirst . '" title="Primeiro">';
    $render .= '<span class="glyphicon glyphicon-backward" aria-hidden="true"></span>';
    $render .= '</a>';
    $render .= '</li>';

    $min = $data->current - floor($pages / 2);
    $max = $data->current + floor($pages / 2);

    if ($min < 1) {
      $from = 1;
    } elseif ($max > $total_pages) {
      $from = $total_pages - $pages + 1;
    } else {
      $from = $min;
    }

    $to = $from + $pages;

    for ($i = $from; $i < $to; $i++) {
      $active = $data->current == $i ? 'active' : '';
      $render .= '<li class="' . $active . '">';
      $render .= '<a href="' . $urlCurrent . $i . '">' . $i . '</a>';
      $render .= '</li>';
    }

    $active = $data->current == $data->last ? 'disabled' : '';
    $render .= '<li class="' . $active . '">';
    $render .= '<a href="' . $urlLast . '" title="Último">';
    $render .= '<span class="glyphicon glyphicon-forward" aria-hidden="true"></span>';
    $render .= '</a>';
    $render .= '</li>';

    $active = $data->current == $data->next ? 'disabled' : '';
    $render .= '<li class="' . $active . '">';
    $render .= '<a href="' . $urlNext . '" title="Próximo">Próximo</a>';
    $render .= '</li>';

    $render .= '</ul>';
    $render .= '</div>';

    return $render;
  }

  /**
   * Destruct for class.
   */
  public function __destruct() {

  }

}
