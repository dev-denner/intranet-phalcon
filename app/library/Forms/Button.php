<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Button
 *
 * @author denner.fernandes
 */

namespace SysPhalcon\Library\Forms;

use Phalcon\Tag,
    Phalcon\Forms\Element,
    Phalcon\Forms\ElementInterface,
    Phalcon\Forms\Exception;

class Button extends Element implements ElementInterface {

    protected $_icon;
    protected $_name;

    public function __construct($name, $attributes = NULL, $icon = NULL) {
        $this->_icon = $icon;
        $this->_name = $name;

        if (!$attributes) {
            $attributes = [];
        }

        if (!isset($attributes['type'])) {
            $attributes['type'] = 'submit';
        }

        parent::__construct($name, $attributes);
    }

    public function getIcon() {
        return $this->_icon;
    }

    public function setIcon($icon) {
        $this->_icon = $icon;

        return $this;
    }

    public function render($attributes = NULL, $icon = NULL) {
        $icon = $icon ? : $this->_icon;

        $render = Tag::tagHtml('i', ['class' => 'pull-right']);
        $render .= '&nbsp;';
        $render .= Tag::tagHtmlClose('i');
        $render .= Tag::tagHtml('button', $this->prepareAttributes($attributes), FALSE, TRUE);
        $render .= $this->_name;
        $render .= Tag::tagHtml('i', ['class' => $icon]);
        $render .= Tag::tagHtmlClose('i');
        $render .= Tag::tagHtmlClose('button');


        return $render;
    }

}
