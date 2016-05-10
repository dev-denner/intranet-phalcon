<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace SysPhalcon\Library\DataTable;

use Phalcon\Paginator\Adapter\Model as Paginator;
use Phalcon\Paginator\AdapterInterface;
use Phalcon\Paginator\Pager;

class Datatable extends \Phalcon\Mvc\User\Plugin {

    /**
     *
     * @var array
     */
    private $length = [];

    /**
     *
     * @var string
     */
    private $filter = '';

    /**
     *
     * @var array
     */
    private $data = [];

    /**
     *
     * @var array
     */
    private $order = [];

    /**
     *
     * @var array
     */
    private $action = [];

    /**
     *
     * @var object
     */
    private $pagination = null;

    /**
     *
     * @var array
     */
    private $header = [];

    /**
     *
     * @var string
     */
    private $url = '';

    /**
     *
     * @var string
     */
    private $title = '';

    /**
     *
     * @var string
     */
    private $subTitle = '';

    /**
     *
     * @return type
     */
    public function getFilter() {
        return $this->filter;
    }

    /**
     *
     * @return type
     */
    public function getData() {
        return $this->data;
    }

    /**
     *
     * @return type
     */
    public function getOrder() {
        return $this->order;
    }

    /**
     *
     * @return type
     */
    public function getAction() {
        return $this->action;
    }

    /**
     *
     * @return type
     */
    public function getPagination() {
        return $this->pagination;
    }

    /**
     *
     * @return type
     */
    public function getHearder() {
        return $this->header;
    }

    /**
     *
     * @return type
     */
    public function getUrl() {
        return $this->url;
    }

    /**
     *
     * @return type
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     *
     * @return type
     */
    public function getSubTitle() {
        return $this->subTitle;
    }

    /**
     *
     * @param type $filter
     * @return \SysPhalcon\Library\DataTable\Datatable
     */
    public function setFilter($filter) {
        $this->filter = $filter;
        return $this;
    }

    /**
     *
     * @param type $data
     * @return \SysPhalcon\Library\DataTable\Datatable
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    /**
     *
     * @param type $order
     * @return \SysPhalcon\Library\DataTable\Datatable
     */
    public function setOrder($order) {
        if (is_array($order)) {
            if (array_key_exists('order', $order)) {
                $this->order = $order['order'];
            }
        } else {
            $this->order = $order;
        }
        return $this;
    }

    /**
     *
     * @param type $action
     * @return \SysPhalcon\Library\DataTable\Datatable
     */
    public function setAction($action) {
        if (is_array($action)) {
            if (array_key_exists('action', $action)) {
                $this->action = $action['action'];
            }
        } else {
            $this->action = $action;
        }
        return $this;
    }

    /**
     *
     * @param type $pagination
     * @return \SysPhalcon\Library\DataTable\Datatable
     */
    public function setPagination($pagination) {

        if (is_array($pagination)) {
            if (array_key_exists('pagination', $pagination)) {
                $this->pagination = $pagination['pagination'];
            }
        } else {
            $this->pagination = $pagination;
        }
        return $this;
    }

    /**
     *
     * @param type $header
     * @return \SysPhalcon\Library\DataTable\Datatable
     */
    public function setHearder($header) {

        $this->header = $header;
        return $this;
    }

    /**
     *
     * @param type $url
     * @return \SysPhalcon\Library\DataTable\Datatable
     */
    public function setUrl($url) {
        $this->url = $url;
        return $this;
    }

    /**
     *
     * @param array $length
     * @return \SysPhalcon\Library\DataTable\Datatable
     */
    public function setLength(array $length) {

        $di = $this->di->get('config');

        $this->length = $length;

        if (!array_key_exists('limiter', $length)) {
            $this->length['limiter'] = $di->pagination->limiter;
        }
        if (!array_key_exists('options', $length)) {
            $this->length['options'] = $di->pagination->options;
        }
        if (!array_key_exists('perpage', $length)) {
            $this->length['perpage'] = $di->pagination->perpage;
        }

        return $this;
    }

    /**
     *
     * @param type $title
     * @return \SysPhalcon\Library\DataTable\Datatable
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     *
     * @param type $subTitle
     * @return \SysPhalcon\Library\DataTable\Datatable
     */
    public function setSubTitle($subTitle) {
        $this->subTitle = $subTitle;
        return $this;
    }

    /**
     * Construct for class.
     * @param array $options
     */
    public function __construct() {

    }

    /**
     * Render datatable
     * @return type
     */
    public function render() {

        $sources = [];

        $hiddenArea = $this->makeHiddenArea();
        $titleArea = $this->makeTitleArea();
        $actionsArea = $this->makeActionsArea();
        $lengthArea = $this->makeLengthArea();
        $filterArea = $this->makeFilterArea();
        $tableArea = $this->makeTableArea();
        $infoArea = $this->makeInfoArea();
        $paginationArea = $this->makePaginationArea();
        $formArea = $this->makeFormArea();
        $hasData = empty($this->data) ? false : true;

        include(__DIR__ . '/html.php');

        return;
    }

    private function makeHiddenArea() {
        $return = '<input type = "hidden" id = "datatable_hide_length" value = "' . $this->length['limiter'] . '" />';
        $return .= '<input type = "hidden" id = "datatable_hide_order" value = "' . $this->order . '" />';
        $return .= '<input type = "hidden" id = "datatable_hide_title" value = "' . $this->title . '" />';
        $return .= '<input type = "hidden" id = "datatable_hide_sub_title" value = "' . $this->subTitle . '" />';

        return $return;
    }

    private function makeTitleArea() {
        return '<h2>' . $this->title . '<small>' . $this->subTitle . '</small></h2>';
    }

    private function makeActionsArea() {
        $return = '';
        foreach ($this->makerAction() as $row) {
            $return .= '<li>';
            $return .= '<a class="datatable_button tooltips" href="javascript:void(0);" ';
            $return .= 'onclick="datatable_' . $row['action'] . '(this)" ';
            $return .= 'data-href=\'' . $this->url . $row['action'] . '\' ';
            $return .= 'title="' . $row['label'] . '">';
            $return .= $row['icon'];
            $return .= '</a>';
            $return .= '</li>';
        }
        return $return;
    }

    private function makeLengthArea() {
        $return = '';
        $return .= '<div class="dropdown btn-group">';
        $return .= '<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">';
        $return .= '<span class="dropdown-text">' . $this->length['limiter'] . '</span> <span class="caret"></span>';
        $return .= '</button>';
        $return .= '<ul class="dropdown-menu" role="menu">';
        foreach ($this->length['options'] as $row) {
            $aria = $this->length['limiter'] == $row ? 'true' : 'false';
            $active_length = $this->length['limiter'] == $row ? 'active' : '';
            $return .= '<li class="' . $active_length . '" aria-selected="' . $aria . '">';
            $return .= '<a data-action="' . $row . '" class="dropdown-item dropdown-item-button" onclick="datatable_submit(\'' . $row . '\')">' . $row . '</a>';
            $return .= '</li>';
        }
        $return .= '</ul>';
        $return .= '</div>';
        return $return;
    }

    private function makeFilterArea() {
        return '<input type="text" class="form-control" onblur="datatable_submit()" id="datatable_filter" value="' . $this->filter . '" onclick="this.select()" />';
    }

    private function makeTableArea() {
        $return = '';
        $orderIcon = explode(' ', $this->order);

        $return .= '<table class="table table-condensed table-striped no-margin">';
        if (!empty($this->data)):

            $return .= $this->makeHeaderArea();
            $return .= $this->makeDataArea();

        else:
            $return .= '<tr><th>Não há dados a serem exibidos.</th></tr>';
        endif;
        $return .= '</table>';

        return $return;
    }

    private function makeHeaderArea() {
        $return = '';
        $orderIcon = explode(' ', $this->order);

        $return .= '<thead>';
        $return .= '<tr class="datatable_sorting" role="row">';
        foreach ($this->header as $key => $row):
            $return .= '<th>';
            if ($orderIcon[0] == $key) :
                if (isset($orderIcon[1])) :
                    $icon = 'zmdi-chevron-up';
                else :
                    $icon = 'zmdi-chevron-down';
                endif;
            else :
                $icon = '';
            endif;
            $return .= '<a href="javascript::void(0);" onclick="datatable_sorting(\'' . $key . '\')">';
            $return .= $row . ' <i class="zmdi ' . $icon . '"></i>';
            $return .= '</a>';
            $return .= '</th>';
        endforeach;
        $return .= '<th class="text-right">Comandos</th>';
        $return .= '</tr>';
        $return .= '</thead>';

        return $return;
    }

    private function makeDataArea() {
        $return = '';
        $return .= '<tbody class="datatable_data">';
        foreach ($this->data as $num => $itens):
            $return .= '<tr onclick="datatable_selected(this);">';
            foreach ($this->header as $key => $row):
                $key == 'id' ? $ID = $itens[$key] : $ID;
                $value = 'data-id="' . $ID . '"';
                $return .= '<td ' . $value . '>';
                $return .= $itens[$key];
                $return .= '</td>';
            endforeach;
            $return .= '<td class="text-right">';
            $return .= '<button type="button" class="btn btn-info waves-effect" data-href="' . $this->url . 'view" data-id="' . $ID . '" onclick="datatable_view(this)">';
            $return .= '<span class="zmdi zmdi-eye"></span>';
            $return .= '</button>';
            $return .= '<button type="button" class="btn btn-default waves-effect" data-href="' . $this->url . 'edit" data-id="' . $ID . '" onclick="datatable_edit(this)">';
            $return .= '<span class="zmdi zmdi-edit"></span>';
            $return .= '</button>';
            $return .= '<button type="button" class="btn btn-danger waves-effect" data-href="' . $this->url . 'delete" data-id="' . $ID . '" onclick="datatable_delete(this)">';
            $return .= '<span class="zmdi zmdi-delete"></span>';
            $return .= '</button>';
            $return .= '</td>';
            $return .= '</tr>';
        endforeach;
        $return .= '</tbody>';
        return $return;
    }

    private function makeInfoArea() {
        $info = $this->makerInfo();
        return 'Exibindo ' . $info['start'] . ' a ' . $info['finish'] . ' de ' . $info['total'] . ' registro(s)';
    }

    private function makePaginationArea() {
        $return = '';
        foreach ($this->makerPagination() as $row) {
            $return .= '<li class="' . $row['active'] . '">';
            $return .= '<a href="' . $this->url . $row['url'] . '" title="' . $row['label'] . '" class="tooltips">';
            $return .= $row['icon'];
            $return .= '<span class="sr-only">' . $row['label'] . '</span>';
            $return .= '</a>';
            $return .= '</li>';
        }
        return $return;
    }

    private function makeFormArea() {
        $return = '';
        $return .= '<form action="' . $this->url . '" id="emissary" method="post">';
        $return .= '<input type="hidden" name="datatable_length" value="' . $this->length['limiter'] . '">';
        $return .= '<input type="hidden" name="datatable_filter" value="' . $this->filter . '">';
        $return .= '<input type="hidden" name="datatable_order" value="' . $this->order . '">';
        $return .= '</form>';
        return $return;
    }

    /**
     * Create the information
     * @return type
     */
    private function makerInfo() {

        $data = $this->pagination;
        $start = ($data->current * $data->limit) - ($data->limit - 1);
        $total = $data->total_items;
        $aux = $data->current * $data->limit;
        $finish = $aux > $total ? $total : $aux;

        return [
            'start' => $start,
            'finish' => $finish,
            'total' => $total
        ];
    }

    /**
     * Create actions
     * @return string
     */
    private function makerAction() {

        $data = '';
        $icon = '';

        foreach ($this->action as $key => $value) {
            $icon = $this->makeIcons($value['view']['type'], $value['view']['icon']);
            $data[] = [
                'action' => $value['action'],
                'label' => $value['label'],
                'icon' => $icon
            ];
        }
        return $data;
    }

    /**
     * Create pagination
     * @return string
     */
    private function makerPagination() {

        $data = '';
        $active = '';
        $icon = '';

        $page = $this->pagination;

        $total_pages = $page->total_pages;
        $pages = $this->length['perpage'] > $total_pages ? $total_pages : $this->length['perpage'];

        $icon = $this->makeIcons('font', 'zmdi zmdi-more-horiz');
        $active = $page->current == $page->first ? 'disabled' : '';
        $data[] = [
            'active' => $active,
            'url' => '',
            'label' => 'Primeiro',
            'icon' => $icon
        ];

        $icon = $this->makeIcons('font', 'zmdi zmdi-chevron-left');
        $active = $page->current == $page->before ? 'disabled' : '';
        $data[] = [
            'active' => $active,
            'url' => '?page=' . $page->before,
            'label' => 'Anterior',
            'icon' => $icon
        ];

        $min = $page->current - floor($pages / 2);
        $max = $page->current + floor($pages / 2);

        if ($min < 1) {
            $from = 1;
        } elseif ($max > $total_pages) {
            $from = $total_pages - $pages + 1;
        } else {
            $from = $min;
        }

        $to = $from + $pages;

        for ($i = $from; $i < $to; $i++) {
            $active = $page->current == $i ? 'active' : '';
            $data[] = [
                'active' => $active,
                'url' => '?page=' . $i,
                'label' => '',
                'icon' => $i
            ];
        }

        $icon = $this->makeIcons('font', 'zmdi zmdi-chevron-right');
        $active = $page->current == $page->next ? 'next disabled' : '';
        $data[] = [
            'active' => $active,
            'url' => '?page=' . $page->next,
            'label' => 'Próximo',
            'icon' => $icon
        ];

        $icon = $this->makeIcons('font', 'zmdi zmdi-more-horiz');
        $active = $page->current == $page->last ? 'next last disabled' : '';
        $data[] = [
            'active' => $active,
            'url' => '?page=' . $page->last,
            'label' => 'Último',
            'icon' => $icon
        ];

        return $data;
    }

    /**
     * Create icons
     * @param string $type
     * @param string $icon
     * @param string $label
     * @param int $width
     * @return string
     */
    private function makeIcons($type, $icon, $label = '', $width = 14) {

        $render = '';

        if ($type == 'font') {
            $render = '<i class="zmdi ' . $icon . '" aria-hidden="true" style="font-size:' . $width . 'px"></i>';
        } else {

            $uri = $this->getBaseUri() . 'assets/img/';

            $uri .= $icon;
            $render = '<img src="' . $uri . '" alt="' . $label . '" width="' . $width . 'px" />';
        }

        return $render;
    }

    /**
     * Destruct for class.
     */
    public function __destruct() {

    }

}
