<?php

/**
 * @copyright   2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Models;

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
    $this->parents = $parents;

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
    $this->hasMany('id', 'Nucleo\Models\Menus', 'parents', array('alias' => 'Menus'));
    $this->belongsTo('action', 'Nucleo\Models\Actions', 'id', array('alias' => 'Actions'));
    $this->belongsTo('parents', 'Nucleo\Models\Menus', 'id', array('alias' => 'Menus'));

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
    return 'menus';
  }

  /**
   * Independent Column Mapping.
   * Keys are the real names in the table and the values their names in the application
   *
   * @return array
   */
  public function columnMap() {
    return array(
        'id' => 'id',
        'title' => 'title',
        'slug' => 'slug',
        'parents' => 'parents',
        'action' => 'action',
        'sdel' => 'sdel',
        'createBy' => 'createBy',
        'createIn' => 'createIn',
        'updateBy' => 'updateBy',
        'updateIn' => 'updateIn'
    );
  }

  public static function getDeleted() {
    return 'sdel';
  }

}
