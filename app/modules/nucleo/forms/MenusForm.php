<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Forms;

use Nucleo\Models\Menus;

class MenusForm extends \DevDenners\Library\Forms\FormBase {

  public function initialize($entity = null, $options = []) {

    if (is_null($entity)) {
      $entity = new Menus();
    }

    $reset = [
        'id' => [],
        'title' => [],
        'slug' => [],
        'parents' => [],
        'action' => [],
    ];

    $element = $reset;
    $attributes = $reset;

    $type = $options['type'];
    $hasTitle = isset($options['title']) ? $options['title'] : true;
    $formAttributes = $this->getFormAttributes($type);
    $typeForms = $entity->typeForms();
    $attributesForm = ['class' => 'col-md-8 col-md-offset-2'];
    $legend = null;

    $url = $this->di->get('url');
    $uri = $url->getBaseUri() . 'menus';

    $this->setAction($uri . '/' . $formAttributes['action']);

    $this->setAttributes([
        'autocomplete' => 'off',
        'class' => 'form-horizontal',
    ]);

    //////////////////////////////////// attributes ////////////////////////////////////
    if ($type != 'search') {

      $attributes['id'] = ['maxlength' => 11, 'required' => 'required'];
      $attributes['title'] = ['maxlength' => 50, 'required' => 'required'];
      $attributes['slug'] = ['maxlength' => 255, 'required' => 'required'];
    }

    //////////////////////////////////// element ////////////////////////////////////

    $element['id'] = $this->_hidden('id', $attributes['id']);
    $element['title'] = $this->_text('title', $attributes['title']);
    $element['title']->setLabel('Título');
    $element['slug'] = $this->_text('slug', $attributes['slug']);
    $element['slug']->setLabel('Slug');

    $select = [
        'entity' => 'Nucleo\Models\Menus',
        'selectField' => [
            'key' => 'id',
            'value' => 'title'
        ],
        'selectEmpty' => true,
    ];
    $element['parents'] = $this->_select('parents', [], $select);
    $element['parents']->setLabel('Pai');

    $select = [
        'entity' => 'Nucleo\Models\Actions',
        'selectField' => [
            'key' => 'id',
            'value' => 'title'
        ],
        'selectEmpty' => true,
    ];
    $element['action'] = $this->_select('action', [], $select);
    $element['action']->setLabel('Ação');

    //////////////////////////////////// validator ////////////////////////////////////
    
    $element['id'] = $this->validatorPresenceOf($element['id']);
    $element['title'] = $this->validatorPresenceOf($element['title']);
    $element['slug'] = $this->validatorPresenceOf($element['slug']);

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
