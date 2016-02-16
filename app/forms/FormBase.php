<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormBase
 *
 * @author denner.fernandes
 */
class FormBase extends FormBootstrap {

  private $_name;
  private $_attributes;

  public function setName($name) {

    if ($name == 'csrf') {
      $this->_name = $this->security->getTokenKey();
      $this->setAttr(array(
          'value' => $this->security->getToken(),
          'id' => $name,
      ));
    } else {
      $this->_name = $name;
    }
  }

  public function setAttr($attributes) {

    foreach ($attributes['attributes'] as $key => $value) {
      $this->_attr[$key] = $value;
    }
    if ($attributes['active']) {
      if ($attributes['active'] == 'search') {
        unset($this->_attr['required']);
      }
    }
    return $this;
  }

  protected function _element($name, $attr) {

    $this->_attr = array();
    $this->setName($name);
    $this->setAttr($attr);

    $function = '_' . $attr['type'];
    $element = $this->$function($attr);

    if (isset($attr['title'])) {
      $element->setLabel($attr['title']);
    }
    return $element;
  }

  protected function _validation($element, $attr) {

    foreach ($attr['validation'] as $key => $value) {

      $function = 'validator' . $key;

      if ($attr['active'] != 'search') {

        if ($value === true) {
          $element = $this->$function($element);
        } elseif (is_array($value)) {
          $element = $this->$function($element, $value[0], $value[1]);
        } else {
          $element = $this->$function($element, $value);
        }
      }
    }
    return $element;
  }

  protected function _typeForm($options) {
    $return = array();

    switch ($options) {
      case 'insert':
        $return = array(
            'action' => 'create',
            'title' => 'Inserir',
            'button' => 'success'
        );
        break;
      case 'update':
        $return = array(
            'action' => 'save',
            'title' => 'Atualizar',
            'button' => 'primary'
        );
        break;
      case 'search':
        $return = array(
            'action' => 'search',
            'title' => 'Buscar',
            'button' => 'default'
        );
        break;

      default:
        $return = array(
            'action' => 'search',
            'title' => 'Buscar',
            'button' => 'default'
        );
        break;
    }
    return $return;
  }

  protected function _formAtt($options) {

    $controller = $this->di->get('url')->getBaseUri() . $options['controller'];
    $names = $this->_typeForm($options['active']['action']);

    $this->setAction($controller . '/' . $names['action']);

    $this->setAttributes([
        "autocomplete" => "off",
        "class" => "form-horizontal",
    ]);

    $this->setName($names['title']);
    $this->_attr = array();
    $this->setAttr(array(
        'attributes' => array(
            'value' => $names['title'],
            'class' => 'pull-right btn-' . $names['button'],
            'type' => 'button'
    )));

    $element = $this->_submit();

    return $element;
  }

  private function _text() {

    $element = new \Phalcon\Forms\Element\Text($this->_name, $this->_attr);
    return $element;
  }

  private function _email() {
    $element = new \Phalcon\Forms\Element\Email($this->_name, $this->_attr);
    return $element;
  }

  private function _password() {
    $element = new \Phalcon\Forms\Element\Password($this->_name, $this->_attr);
    return $element;
  }

  private function _select($select) {

    $select = $select['select'];
    $filter = $select['filter'];
    $entity = new $select['entity']();
    $dados = $entity::find($filter['field'] . " = '{$filter['value']}'");
    $selectField = $select['selectField'];
    $this->_attr['using'] = array(
        $selectField['key'],
        $selectField['value']
    );

    if ($select['selectEmpty']) {
      $this->_attr['useEmpty'] = true;
      $this->_attr['emptyText'] = 'Escolha um opção';
      $this->_attr['emptyValue'] = '';
    }

    $element = new \Phalcon\Forms\Element\Select($this->_name, $dados, $this->_attr);

    return $element;
  }

  private function _checkbox() {
    $element = new \Phalcon\Forms\Element\Check($this->_name, $this->_attr);
    return $element;
  }

  private function _textarea() {
    $element = new \Phalcon\Forms\Element\TextArea($this->_name, $this->_attr);
    return $element;
  }

  private function _hidden() {
    $element = new \Phalcon\Forms\Element\Hidden($this->_name, $this->_attr);
    return $element;
  }

  private function _file() {
    $element = new \Phalcon\Forms\Element\File($this->_name, $this->_attr);
    return $element;
  }

  private function _date() {
    $element = new \Phalcon\Forms\Element\Date($this->_name, $this->_attr);
    return $element;
  }

  private function _numeric() {
    $element = new \Phalcon\Forms\Element\Numeric($this->_name, $this->_attr);
    return $element;
  }

  private function _radio() {
    $element = new \Phalcon\Forms\Element\Radio($this->_name, $this->_attr);
    return $element;
  }

  private function _submit() {
    $element = new \Phalcon\Forms\Element\Submit($this->_name, $this->_attr);
    return $element;
  }

  private function _button() {

    $element = new \Phalcon\Forms\Element\Submit($this->_name, $this->_attr);
    return $element;
  }

  private function validatorPresenceOf($element) {
    $element->addValidator(
            new \Phalcon\Validation\Validator\PresenceOf(
            array('message' => 'O campo :field não pode ficar em branco.')
    ));
    return $element;
  }

  private function validatorEmail($element) {
    $element->addValidator(
            new \Phalcon\Validation\Validator\Email(
            ['message' => 'O campo :field não parece um e-mail válido.']
    ));
    return $element;
  }

  private function validatorRegex($element, $regex) {
    $element->addValidator(
            new \Phalcon\Validation\Validator\Regex(
            ['message' => 'Não é um formato válido para o campo :field.',
        'pattern' => $regex,]
    ));
    return $element;
  }

  private function validatorStringLength($element, $min = 1, $max = 255) {
    $element->addValidator(new \Phalcon\Validation\Validator\StringLength([
        'max' => $max,
        'min' => $min,
        'messageMaximum' => 'Valor do campo :field muito longo. Max: ' . $max,
        'messageMinimum' => 'Valor do campo :field muito curto. Min: ' . $min
    ]));
    return $element;
  }

  private function validatorConfirmation($element, $field) {
    $element->addValidator(new \Phalcon\Validation\Validator\Confirmation([
        'message' => 'Os campos :field e ' . $field . ' não coincidem.',
        'with' => $field
    ]));
    return $element;
  }

  private function validatorUniqueness($element, $model) {
    $element->addValidator(new \Phalcon\Validation\Validator\Uniqueness([
        'model' => $model,
        'message' => 'O campo :field deve ser único.'
    ]));
    return $element;
  }

  private function validatorIdentical($element, $model) {
    $element->addValidator(new \Phalcon\Validation\Validator\Identical([
        'value' => $this->security->getSessionToken(),
        'message' => 'Error CSRF: Falha na validação.'
    ]));
    return $element;
  }

  public function messages($name) {
    if ($this->hasMessagesFor($name)) {
      foreach ($this->getMessagesFor($name) as $message) {
        $this->flash->error($message);
      }
    }
  }

}
