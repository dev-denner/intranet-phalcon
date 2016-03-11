<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Forms;

use Nucleo\Models\Users;

class UsersForm extends \DevDenners\Library\Forms\FormBase {

  public function initialize($entity = null, $options = []) {

    if (is_null($entity)) {
      $entity = new Users();
    }

    $reset = [
        'id' => [],
        'cpf' => [],
        'password' => [],
        'confirmPassword' => [],
        'mustChangePassword' => [],
        'email' => [],
        'name' => [],
        'rememberMe' => [],
        'status' => [],
        'csrf' => [],
    ];

    $element = $reset;
    $attributes = $reset;
    $type = $options['type'];
    $hasTitle = isset($options['title']) ? $options['title'] : true;
    $formAttributes = $this->getFormAttributes($type);
    $typeForms = $entity->typeForms();
    $attributesForm = ['class' => 'col-md-8 col-md-offset-2'];
    $legend = null;

    $email = '_email';

    $url = $this->di->get('url');
    $uri = $url->getBaseUri() . 'users';

    $this->setAction($uri . '/' . $formAttributes['action']);

    $this->setAttributes([
        'autocomplete' => 'off',
        'class' => 'form-horizontal',
    ]);

    //////////////////////////////////// attributes ////////////////////////////////////
    if ($type != 'search') {

      $attributes['id'] = ['maxlength' => 11, 'required' => 'required'];
      $attributes['cpf'] = ['maxlength' => 14, 'required' => 'required'];
      $attributes['password'] = ['maxlength' => 105,];
      $attributes['confirmPassword'] = ['maxlength' => 105,];
      $attributes['email'] = ['maxlength' => 105,];
      $attributes['name'] = ['maxlength' => 105,];
      $attributes['status'] = ['required' => 'required',];
    }

    //////////////////////////////////// element ////////////////////////////////////

    $element['id'] = $this->_hidden('id', $attributes['id']);
    $element['cpf'] = $this->_text('cpf', $attributes['cpf']);
    $element['cpf']->setLabel('CPF');
    $element['password'] = $this->_password('password', $attributes['password']);
    $element['password']->setLabel('Senha');
    $element['confirmPassword'] = $this->_password('confirmPassword', $attributes['confirmPassword']);
    $element['confirmPassword']->setLabel('Confirme sua Senha');
    $element['mustChangePassword'] = $this->_checkbox('mustChangePassword');
    $element['mustChangePassword']->setLabel('Forçar troca de Senha');

    if ($type == 'search') {
      $email = '_text';
    }
    $element['email'] = $this->$email('email', $attributes['email']);
    $element['email']->setLabel('E-mail');
    $element['name'] = $this->_text('name', $attributes['name']);
    $element['name']->setLabel('Nome');
    $element['rememberMe'] = $this->_checkbox('rememberMe');
    $element['rememberMe']->setLabel('Lembre de mim');

    $select = [
        'entity' => 'Nucleo\Models\TablesSystem',
        'filter' => [
            'field' => 'table',
            'value' => 'status'
        ],
        'selectField' => [
            'key' => 'code',
            'value' => 'value'
        ],
        'selectEmpty' => true,
    ];
    $element['status'] = $this->_select('status', $attributes['status'], $select);
    $element['status']->setLabel('Status');
    $element['csrf'] = $this->_hidden($this->security->getTokenKey(), [
        'required' => 'required',
        'value' => $this->security->getToken(),
    ]);
    $element['csrf'] = $this->validatorIdentical($element['csrf']);

    //////////////////////////////////// validator ////////////////////////////////////

    $element['id'] = $this->validatorPresenceOf($element['id']);
    $element['cpf'] = $this->validatorPresenceOf($element['cpf']);
    //$element['cpf'] = $this->validatorUniqueness($element['cpf'], 'Users');
    $regex = '([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})';
    //$element['cpf'] = $this->validatorRegex($element['cpf'], $regex);
    $element['password'] = $this->validatorPresenceOf($element['password']);
    $element['confirmPassword'] = $this->validatorPresenceOf($element['confirmPassword']);
    $element['confirmPassword'] = $this->validatorConfirmation($element['confirmPassword'], 'password');
    $element['email'] = $this->validatorPresenceOf($element['email']);
    //$element['email'] = $this->validatorUniqueness($element['email'], 'Users');
    $element['status'] = $this->validatorPresenceOf($element['status']);

    if ($hasTitle) {
      $legend = $formAttributes['legend'];
    }

    $this->startFieldset($legend, $attributesForm);

    foreach ($typeForms as $field => $permission) {
      if ($field == $type) {
        foreach ($element as $keyField => $fieldForm) {
          if ($permission[$keyField]) {
            $element[$keyField]->clear();
            $this->add($element[$keyField]);
          }
        }
      }
    }
    $buttonAttribute = [
        'class' => $formAttributes['class'] . ' pull-right',
        'type' => 'submit',
    ];

    $element = $this->_submit($formAttributes['value'], $buttonAttribute);
    $this->add($element);

    if ($type == 'search') {

      $resetButtonAttribute = [
          'class' => 'bgm-gray waves-effect pull-right',
          'type' => 'button',
          'onclick' => 'resetting()',
          'id' => 'reset',
      ];

      $element = $this->_button('Limpar', $resetButtonAttribute);
      $this->add($element);
    }

    $this->endFieldset();
  }

}
