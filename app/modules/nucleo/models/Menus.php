<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models;

use \Phalcon\Mvc\Model\Message as Message;

class Menus extends ModelBase {

  use beforeCreate;

use beforeUpdate;

  /**
   *
   * @var integer
   */
  protected $id;

  /**
   *
   * @var string
   */
  protected $title;

  /**
   *
   * @var string
   */
  protected $slug;

  /**
   *
   * @var integer
   */
  protected $parents;

  /**
   *
   * @var integer
   */
  protected $action;

  /**
   *
   * @var string
   */
  protected $sdel;

  /**
   *
   * @var string
   */
  protected $createBy;

  /**
   *
   * @var string
   */
  protected $createIn;

  /**
   *
   * @var string
   */
  protected $updateBy;

  /**
   *
   * @var string
   */
  protected $updateIn;

  /**
   * Method to set the value of field id
   *
   * @param integer $id
   * @return $this
   */
  public function setId($id) {
    $this->id = $id;

    return $this;
  }

  /**
   * Method to set the value of field title
   *
   * @param string $title
   * @return $this
   */
  public function setTitle($title) {
    $this->title = $title;

    return $this;
  }

  /**
   * Method to set the value of field slug
   *
   * @param string $slug
   * @return $this
   */
  public function setSlug($slug) {
    $this->slug = $slug;

    return $this;
  }

  /**
   * Method to set the value of field parents
   *
   * @param integer $parents
   * @return $this
   */
  public function setParents($parents) {

    if (empty(trim($parents))) {
      $this->parents = null;
    } else {
      $this->parents = $parents;
    }

    return $this;
  }

  /**
   * Method to set the value of field action
   *
   * @param integer $action
   * @return $this
   */
  public function setAction($action) {
    $this->action = $action;

    return $this;
  }

  /**
   * Method to set the value of field sdel
   *
   * @param string $sdel
   * @return $this
   */
  public function setSdel($sdel) {
    $this->sdel = $sdel;

    return $this;
  }

  /**
   * Method to set the value of field createBy
   *
   * @param string $createBy
   * @return $this
   */
  public function setCreateBy($createBy) {
    $this->createBy = $createBy;

    return $this;
  }

  /**
   * Method to set the value of field createIn
   *
   * @param string $createIn
   * @return $this
   */
  public function setCreateIn($createIn) {
    $this->createIn = $createIn;

    return $this;
  }

  /**
   * Method to set the value of field updateBy
   *
   * @param string $updateBy
   * @return $this
   */
  public function setUpdateBy($updateBy) {
    $this->updateBy = $updateBy;

    return $this;
  }

  /**
   * Method to set the value of field updateIn
   *
   * @param string $updateIn
   * @return $this
   */
  public function setUpdateIn($updateIn) {
    $this->updateIn = $updateIn;

    return $this;
  }

  /**
   * Returns the value of field id
   *
   * @return integer
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Returns the value of field title
   *
   * @return string
   */
  public function getTitle() {
    return $this->title;
  }

  /**
   * Returns the value of field slug
   *
   * @return string
   */
  public function getSlug() {
    return $this->slug;
  }

  /**
   * Returns the value of field parents
   *
   * @return integer
   */
  public function getParents() {
    return $this->parents;
  }

  /**
   * Returns the value of field action
   *
   * @return integer
   */
  public function getAction() {
    return $this->action;
  }

  /**
   * Returns the value of field sdel
   *
   * @return string
   */
  public function getSdel() {
    return $this->sdel;
  }

  /**
   * Returns the value of field createBy
   *
   * @return string
   */
  public function getCreateBy() {
    return $this->createBy;
  }

  /**
   * Returns the value of field createIn
   *
   * @return string
   */
  public function getCreateIn() {
    return $this->createIn;
  }

  /**
   * Returns the value of field updateBy
   *
   * @return string
   */
  public function getUpdateBy() {
    return $this->updateBy;
  }

  /**
   * Returns the value of field updateIn
   *
   * @return string
   */
  public function getUpdateIn() {
    return $this->updateIn;
  }

  /**
   * Initialize method for model.
   */
  public function initialize() {
    
    $this->hasMany('id', __NAMESPACE__ . '\Menus', 'parents', ['alias' => 'Menus']);
    $this->belongsTo('action', __NAMESPACE__ . '\Actions', 'id', ['alias' => 'Actions']);
    $this->belongsTo('parents', __NAMESPACE__ . '\Menus', 'id', ['alias' => 'Menus']);

    $this->addBehavior(new \Phalcon\Mvc\Model\Behavior\SoftDelete([
        'field' => 'sdel',
        'value' => date('*')
    ]));
  }

  /**
   * Returns table name mapped in the model.
   *
   * @return string
   */
  public function getSource() {
    return 'MENU';
  }

  /**
   * Independent Column Mapping.
   * Keys are the real names in the table and the values their names in the application
   *
   * @return array
   */
  public static function columnMap() {
    return array(
        'ID_MENU' => 'id',
        'DS_TITULO' => 'title',
        'DS_SLUG' => 'slug',
        'CD_PAI' => 'parents',
        'CD_ACAO' => 'action',
        'SDEL' => 'sdel',
        'CREATEBY' => 'createBy',
        'CREATEIN' => 'createIn',
        'UPDATEBY' => 'updateBy',
        'UPDATEIN' => 'updateIn',
        'PHALCON_RN' => 'PHALCON_RN',
    );
  }

  public static function getDeleted() {
    return 'sdel';
  }

  public function typeForms() {
    return [
        'list' => [
            'id' => true,
            'title' => true,
            'slug' => true,
            'parents' => true,
            'action' => true,
            'createBy' => false,
            'createIn' => false,
            'updateBy' => false,
            'updateIn' => false,
        ],
        'view' => [
            'id' => true,
            'title' => true,
            'slug' => true,
            'parents' => true,
            'action' => true,
            'createBy' => true,
            'createIn' => true,
            'updateBy' => true,
            'updateIn' => true,
        ],
        'search' => [
            'id' => false,
            'title' => true,
            'slug' => true,
            'parents' => true,
            'action' => true,
            'createBy' => false,
            'createIn' => false,
            'updateBy' => false,
            'updateIn' => false,
        ],
        'insert' => [
            'id' => false,
            'title' => true,
            'slug' => true,
            'parents' => true,
            'action' => true,
            'createBy' => false,
            'createIn' => false,
            'updateBy' => false,
            'updateIn' => false,
        ],
        'update' => [
            'id' => true,
            'title' => true,
            'slug' => true,
            'parents' => true,
            'action' => true,
            'createBy' => false,
            'createIn' => false,
            'updateBy' => false,
            'updateIn' => false,
        ],
    ];
  }

  public function desc() {

    return [
        'id' => [
            'type' => 'hidden',
            'primary' => true,
            'attributes' => [
                'maxlength' => 11,
                'required' => 'required'
            ],
            'validation' => [
                'PresenceOf' => true,
            ],
        ],
        'title' => [
            'type' => 'text',
            'title' => 'Título',
            'attributes' => [
                'maxlength' => 50,
                'required' => 'required'
            ],
            'validation' => [
                'PresenceOf' => true,
            ],
        ],
        'slug' => [
            'type' => 'text',
            'title' => 'Slug',
            'attributes' => [
                'maxlength' => 255,
            ],
            'validation' => [
                'PresenceOf' => true,
            ],
        ],
        'parents' => [
            'type' => 'select',
            'title' => 'Pai',
            'select' => [
                'entity' => '\Nucleo\Models\Menus',
                'selectField' => [
                    'key' => 'id',
                    'value' => 'title'
                ],
                'selectEmpty' => true,
            ],
            'foreign' => 'Menus/title',
            'attributes' => [],
            'validation' => [],
        ],
        'action' => [
            'type' => 'select',
            'title' => 'Acao',
            'select' => [
                'entity' => '\Nucleo\Models\Actions',
                'selectField' => [
                    'key' => 'id',
                    'value' => 'title'
                ],
                'selectEmpty' => true,
            ],
            'foreign' => 'Actions/title',
            'attributes' => [
                'required' => 'required'
            ],
            'validation' => [
                'PresenceOf' => true,
            ],
        ],
        'createBy' => [
            'type' => 'text',
            'title' => 'Criado por',
        ],
        'createIn' => [
            'type' => 'text',
            'title' => 'Criado em',
        ],
        'updateBy' => [
            'type' => 'text',
            'title' => 'Atualizado por',
        ],
        'updateIn' => [
            'type' => 'text',
            'title' => 'Atualizado em',
        ],
    ];
  }

}
