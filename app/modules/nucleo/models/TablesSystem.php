<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Nucleo\Models;

/**
 * Description of TablesSystem
 *
 * @author denner.fernandes
 */
class TablesSystem extends ModelBase {

  use beforeCreate;

use beforeUpdate;

  /**
   *
   * @var string
   */
  protected $table;

  /**
   *
   * @var string
   */
  protected $code;

  /**
   *
   * @var string
   */
  protected $value;

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
   * Method to set the value of field table
   *
   * @param string $table
   * @return $this
   */
  public function setTable($table) {
    $this->table = $table;
    return $this;
  }

  /**
   * Method to set the value of field code
   *
   * @param string $code
   * @return $this
   */
  public function setCode($code) {
    $this->code = $code;
    return $this;
  }

  /**
   * Method to set the value of field value
   *
   * @param string $value
   * @return $this
   */
  public function setValue($value) {
    $this->value = $value;
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
   * Returns the value of field table
   *
   * @return string
   */
  public function getTable() {
    return $this->table;
  }

  /**
   * Returns the value of field code
   *
   * @return string
   */
  public function getCode() {
    return $this->code;
  }

  /**
   * Returns the value of field value
   *
   * @return string
   */
  public function getValue() {
    return $this->value;
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

  public function initialize() {

    $this->setSchema('NUCLEO');

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
    return 'TABELAS_SISTEMA';
  }

  /**
   * Independent Column Mapping.
   * Keys are the real names in the table and the values their names in the application
   *
   * @return array
   */
  public static function columnMap() {
    return [
        'DS_TABELA' => 'table',
        'CD_CODIGO' => 'code',
        'DS_VALOR' => 'value',
        'SDEL' => 'sdel',
        'CREATEBY' => 'createBy',
        'CREATEIN' => 'createIn',
        'UPDATEBY' => 'updateBy',
        'UPDATEIN' => 'updateIn',
    ];
  }

  public static function getDeleted() {
    return 'sdel';
  }

  public function typeForms() {
    return array(
        'list' => array(
            'table' => true,
            'code' => true,
            'value' => true,
        ),
        'search' => array(
            'table' => true,
            'code' => true,
            'value' => true,
        ),
        'insert' => array(
            'table' => true,
            'code' => true,
            'value' => true,
        ),
        'update' => array(
            'table' => true,
            'code' => true,
            'value' => true,
        ),
        'registration' => array(
            'table' => true,
            'code' => true,
            'value' => true,
        ),
        'password' => array(
            'table' => true,
            'code' => true,
            'value' => true,
        ),
    );
  }

  public function desc() {

    return array(
        'table' => array(
            'type' => 'text',
            'title' => 'Tabela',
            'attributes' => array(
                'maxlength' => 30,
                'required' => 'required'
            ),
            'validation' => array(
                'PresenceOf' => true,
            ),
        ),
        'code' => array(
            'type' => 'text',
            'title' => 'Código',
            'attributes' => array(
                'maxlength' => 30,
            ),
            'validation' => array(
                'PresenceOf' => true,
            ),
        ),
        'value' => array(
            'type' => 'text',
            'title' => 'Valor',
            'attributes' => array(
                'maxlength' => 60,
            ),
            'validation' => array(
                'PresenceOf' => true,
            ),
        ),
    );
  }

}
