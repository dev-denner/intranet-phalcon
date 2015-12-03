<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Models;

use Phalcon\Mvc\Model;
use \Phalcon\Mvc\Model\Validator\Email;

/**
 * Class Users
 * @package Nucleo\Models
 */
class Users extends Model {

  /**
   * @var integer
   */
  protected $id;

  /**
   * @var string
   */
  protected $cpf;

  /**
   * @var string
   */
  protected $password;

  /**
   * @var string
   */
  protected $mustchangepassword;

  /**
   * @var string
   */
  protected $email;

  /**
   * @var string
   */
  protected $name;

  /**
   * @var string
   */
  protected $status;

  /**
   * @var string
   */
  protected $token;

  /**
   * @var string
   */
  protected $sdel;

  /**
   * @var string
   */
  protected $usercreate;

  /**
   * @var string
   */
  protected $datacreate;

  /**
   * @var string
   */
  protected $userupdate;

  /**
   * @var string
   */
  protected $dataupdate;

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
   * Method to set the value of field cpf
   *
   * @param string $cpf
   * @return $this
   */
  public function setCpf($cpf) {
    $this->cpf = $cpf;

    return $this;
  }

  /**
   * Method to set the value of field password
   *
   * @param string $password
   * @return $this
   */
  public function setPassword($password) {
    $this->password = $password;

    return $this;
  }

  /**
   * Method to set the value of field mustchangepassword
   *
   * @param string $mustchangepassword
   * @return $this
   */
  public function setMustchangepassword($mustchangepassword) {
    $this->mustchangepassword = $mustchangepassword;

    return $this;
  }

  /**
   * Method to set the value of field email
   *
   * @param string $email
   * @return $this
   */
  public function setEmail($email) {
    $this->email = $email;

    return $this;
  }

  /**
   * Method to set the value of field name
   *
   * @param string $name
   * @return $this
   */
  public function setName($name) {
    $this->name = $name;

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
   * Method to set the value of field usercreate
   *
   * @param string $usercreate
   * @return $this
   */
  public function setUsercreate($usercreate) {
    $this->usercreate = $usercreate;

    return $this;
  }

  /**
   * Method to set the value of field datacreate
   *
   * @param string $datacreate
   * @return $this
   */
  public function setDatacreate($datacreate) {
    $this->datacreate = $datacreate;

    return $this;
  }

  /**
   * Method to set the value of field userupdate
   *
   * @param string $userupdate
   * @return $this
   */
  public function setUserupdate($userupdate) {
    $this->userupdate = $userupdate;

    return $this;
  }

  /**
   * Method to set the value of field dataupdate
   *
   * @param string $dataupdate
   * @return $this
   */
  public function setDataupdate($dataupdate) {
    $this->dataupdate = $dataupdate;

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
   * Returns the value of field cpf
   *
   * @return string
   */
  public function getCpf() {
    return $this->cpf;
  }

  /**
   * Returns the value of field password
   *
   * @return string
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * Returns the value of field mustchangepassword
   *
   * @return string
   */
  public function getMustchangepassword() {
    return $this->mustchangepassword;
  }

  /**
   * Returns the value of field email
   *
   * @return string
   */
  public function getEmail() {
    return $this->email;
  }

  /**
   * Returns the value of field name
   *
   * @return string
   */
  public function getName() {
    return $this->name;
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
   * Returns the value of field token
   *
   * @return string
   */
  public function getToken() {
    return $this->token;
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
   * Returns the value of field usercreate
   *
   * @return string
   */
  public function getUsercreate() {
    return $this->usercreate;
  }

  /**
   * Returns the value of field datacreate
   *
   * @return string
   */
  public function getDatacreate() {
    return $this->datacreate;
  }

  /**
   * Returns the value of field userupdate
   *
   * @return string
   */
  public function getUserupdate() {
    return $this->userupdate;
  }

  /**
   * Returns the value of field dataupdate
   *
   * @return string
   */
  public function getDataupdate() {
    return $this->dataupdate;
  }

  /**
   * Validations and business logic
   */
  public function validation() {

    $this->validate(
            new Email(
            array(
        'field' => 'email',
        'required' => true,
            )
            )
    );
    if ($this->validationHasFailed() == true) {
      return false;
    }
  }

  /**
   * Initialize method for model.
   */
  public function initialize() {
    $this->setSource('users');
    $this->hasMany('id', 'Nucleo\Models\Logins', 'user', array('alias' => 'Logins'));
    $this->hasMany('id', 'Nucleo\Models\Profiles', 'user', array('alias' => 'Profiles'));
    $this->hasMany('id', 'Nucleo\Models\Users_groups', 'user', array('alias' => 'Users_groups'));
  }

  /**
   * Allows to query a set of records that match the specified conditions
   *
   * @param mixed $parameters
   * @return Users[]
   */
  public static function find($parameters = null) {
    return parent::find($parameters);
  }

  /**
   * Allows to query the first record that match the specified conditions
   *
   * @param mixed $parameters
   * @return Users
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
    return 'users';
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
        'cpf' => 'cpf',
        'password' => 'password',
        'mustchangepassword' => 'mustchangepassword',
        'email' => 'email',
        'name' => 'name',
        'status' => 'status',
        'token' => 'token',
        'sdel' => 'sdel',
        'usercreate' => 'usercreate',
        'datacreate' => 'datacreate',
        'userupdate' => 'userupdate',
        'dataupdate' => 'dataupdate'
    );
  }

}
