<?php

/**
 * @copyright   2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Models;

class Tokens extends ModelBase {

  use beforeCreate;

  /**
   *
   * @var integer
   */
  protected $id;

  /**
   *
   * @var integer
   */
  protected $usersId;

  /**
   *
   * @var string
   */
  protected $token;

  /**
   *
   * @var string
   */
  protected $userAgent;

  /**
   *
   * @var string
   */
  protected $createIn;

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
   * Method to set the value of field usersId
   *
   * @param integer $usersId
   * @return $this
   */
  public function setUsersId($usersId) {
    $this->usersId = $usersId;

    return $this;
  }

  /**
   * Method to set the value of field token
   *
   * @param string $token
   * @return $this
   */
  public function setToken($token) {
    $this->token = $token;

    return $this;
  }

  /**
   * Method to set the value of field userAgent
   *
   * @param string $userAgent
   * @return $this
   */
  public function setUserAgent($userAgent) {
    $this->userAgent = $userAgent;

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
   * Returns the value of field id
   *
   * @return integer
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Returns the value of field usersId
   *
   * @return integer
   */
  public function getUsersId() {
    return $this->usersId;
  }

  /**
   * Returns the value of field token
   *
   * @return string
   */
  public function getToken() {
    return $this->token;
  }

  /**
   * Returns the value of field userAgent
   *
   * @return string
   */
  public function getUserAgent() {
    return $this->userAgent;
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
   * Initialize method for model.
   */
  public function initialize() {
    $this->belongsTo('usersId', 'Nucleo\Models\Users', 'id', array('alias' => 'Users'));
  }

  /**
   * Allows to query a set of records that match the specified conditions
   *
   * @param mixed $parameters
   * @return Tokens[]
   */
  public static function find($parameters = null) {
    return parent::find($parameters);
  }

  /**
   * Allows to query the first record that match the specified conditions
   *
   * @param mixed $parameters
   * @return Tokens
   */
  public static function findFirst($parameters = null) {
    return parent::findFirst($parameters);
  }

  /**
   * Returns table name mapped in the model.
   *
   * @return string
   */
  public function getSource() {
    return 'tokens';
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
        'usersId' => 'usersId',
        'token' => 'token',
        'userAgent' => 'userAgent',
        'createIn' => 'createIn'
    );
  }

}
