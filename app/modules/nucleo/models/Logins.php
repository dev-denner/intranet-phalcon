<?php

/**
 * @copyright   2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Models;

class Logins extends ModelBase {

  /**
   *
   * @var integer
   */
  protected $id;

  /**
   *
   * @var integer
   */
  protected $userId;

  /**
   *
   * @var string
   */
  protected $type;

  /**
   *
   * @var string
   */
  protected $ipAddress;

  /**
   *
   * @var integer
   */
  protected $attempted;

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
   * Method to set the value of field userId
   *
   * @param integer $userId
   * @return $this
   */
  public function setUserId($userId) {
    $this->userId = $userId;

    return $this;
  }

  /**
   * Method to set the value of field type
   *
   * @param string $type
   * @return $this
   */
  public function setType($type) {
    $this->type = $type;

    return $this;
  }

  /**
   * Method to set the value of field ipAddress
   *
   * @param string $ipAddress
   * @return $this
   */
  public function setIpAddress($ipAddress) {
    $this->ipAddress = $ipAddress;

    return $this;
  }

  /**
   * Method to set the value of field attempted
   *
   * @param integer $attempted
   * @return $this
   */
  public function setAttempted($attempted) {
    $this->attempted = $attempted;

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
   * Returns the value of field userId
   *
   * @return integer
   */
  public function getUserId() {
    return $this->userId;
  }

  /**
   * Returns the value of field type
   *
   * @return string
   */
  public function getType() {
    return $this->type;
  }

  /**
   * Returns the value of field ipAddress
   *
   * @return string
   */
  public function getIpAddress() {
    return $this->ipAddress;
  }

  /**
   * Returns the value of field attempted
   *
   * @return integer
   */
  public function getAttempted() {
    return $this->attempted;
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
    $this->belongsTo('userId', 'Nucleo\Models\Users', 'id', array('alias' => 'Users'));
  }

  /**
   * Returns table name mapped in the model.
   *
   * @return string
   */
  public function getSource() {
    return 'logins';
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
        'userId' => 'userId',
        'type' => 'type',
        'ipAddress' => 'ipAddress',
        'attempted' => 'attempted',
        'userAgent' => 'userAgent',
        'createIn' => 'createIn'
    );
  }

}
