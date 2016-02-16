<?php

/**
 * @copyright   2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Models;

class Perfils extends ModelBase {

  use beforeCreate;

use beforeUpdate;

  /**
   *
   * @var integer
   */
  protected $id;

  /**
   *
   * @var integer
   */
  protected $user;

  /**
   *
   * @var integer
   */
  protected $group;

  /**
   *
   * @var integer
   */
  protected $module;

  /**
   *
   * @var integer
   */
  protected $controller;

  /**
   *
   * @var integer
   */
  protected $action;

  /**
   *
   * @var string
   */
  protected $status;

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
   * Method to set the value of field user
   *
   * @param integer $user
   * @return $this
   */
  public function setUser($user) {
    $this->user = $user;

    return $this;
  }

  /**
   * Method to set the value of field group
   *
   * @param integer $group
   * @return $this
   */
  public function setGroup($group) {
    $this->group = $group;

    return $this;
  }

  /**
   * Method to set the value of field module
   *
   * @param integer $module
   * @return $this
   */
  public function setModule($module) {
    $this->module = $module;

    return $this;
  }

  /**
   * Method to set the value of field controller
   *
   * @param integer $controller
   * @return $this
   */
  public function setController($controller) {
    $this->controller = $controller;

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
   * Method to set the value of field status
   *
   * @param string $status
   * @return $this
   */
  public function setStatus($status) {
    $this->status = $status;

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
   * Returns the value of field user
   *
   * @return integer
   */
  public function getUser() {
    return $this->user;
  }

  /**
   * Returns the value of field group
   *
   * @return integer
   */
  public function getGroup() {
    return $this->group;
  }

  /**
   * Returns the value of field module
   *
   * @return integer
   */
  public function getModule() {
    return $this->module;
  }

  /**
   * Returns the value of field controller
   *
   * @return integer
   */
  public function getController() {
    return $this->controller;
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
   * Returns the value of field status
   *
   * @return string
   */
  public function getStatus() {
    return $this->status;
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
    $this->belongsTo('action', 'Nucleo\Models\Actions', 'id', array('alias' => 'Actions'));
    $this->belongsTo('controller', 'Nucleo\Models\Controllers', 'id', array('alias' => 'Controllers'));
    $this->belongsTo('group', 'Nucleo\Models\Groups', 'id', array('alias' => 'Groups'));
    $this->belongsTo('module', 'Nucleo\Models\Modules', 'id', array('alias' => 'Modules'));
    $this->belongsTo('user', 'Nucleo\Models\Users', 'id', array('alias' => 'Users'));

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
    return 'perfils';
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
        'user' => 'user',
        'group' => 'group',
        'module' => 'module',
        'controller' => 'controller',
        'action' => 'action',
        'status' => 'status',
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
