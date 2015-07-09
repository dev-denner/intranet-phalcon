<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       30/06/2015 03:34:59
 *
 */

namespace Nucleo\Models;

use Phalcon\Mvc\Model;
use \Phalcon\Mvc\Model\Validator\Email;
use \Phalcon\Mvc\Model\Behavior\SoftDelete;
use Phalcon\Mvc\Model\Behavior\Timestampable;

/**
 * Class Users
 * @package Nucleo\Models
 */
class Users extends ModelBase {

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
  protected $delete;

  /**
   * @var integer
   */
  protected $usercreate;

  /**
   * @var string
   */
  protected $datecreate;

  /**
   * @var integer
   */
  protected $userupdate;

  /**
   * @var string
   */
  protected $dateupdate;

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
   * Method to set the value of field delete
   *
   * @param string $delete
   * @return $this
   */
  public function setDelete($delete) {
    $this->delete = $delete;

    return $this;
  }

  /**
   * Method to set the value of field usercreate
   *
   * @param integer $usercreate
   * @return $this
   */
  public function setUsercreate($usercreate) {
    $this->usercreate = $usercreate;

    return $this;
  }

  /**
   * Method to set the value of field datecreate
   *
   * @param string $datecreate
   * @return $this
   */
  public function setDatecreate($datecreate) {
    $this->datecreate = $datecreate;

    return $this;
  }

  /**
   * Method to set the value of field userupdate
   *
   * @param integer $userupdate
   * @return $this
   */
  public function setUserupdate($userupdate) {
    $this->userupdate = $userupdate;

    return $this;
  }

  /**
   * Method to set the value of field dateupdate
   *
   * @param string $dateupdate
   * @return $this
   */
  public function setDateupdate($dateupdate) {
    $this->dateupdate = $dateupdate;

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
   * Returns the value of field delete
   *
   * @return string
   */
  public function getDelete() {
    return $this->delete;
  }

  /**
   * Returns the value of field usercreate
   *
   * @return integer
   */
  public function getUsercreate() {
    return $this->usercreate;
  }

  /**
   * Returns the value of field datecreate
   *
   * @return string
   */
  public function getDatecreate() {
    return $this->datecreate;
  }

  /**
   * Returns the value of field userupdate
   *
   * @return integer
   */
  public function getUserupdate() {
    return $this->userupdate;
  }

  /**
   * Returns the value of field dateupdate
   *
   * @return string
   */
  public function getDateupdate() {
    return $this->dateupdate;
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
    $this->hasMany('id', 'Nucleo\Models\Access', 'usercreate', array('alias' => 'Access'));
    $this->hasMany('id', 'Nucleo\Models\Access', 'userupdate', array('alias' => 'Access'));
    $this->hasMany('id', 'Nucleo\Models\Actions', 'usercreate', array('alias' => 'Actions'));
    $this->hasMany('id', 'Nucleo\Models\Actions', 'userupdate', array('alias' => 'Actions'));
    $this->hasMany('id', 'Nucleo\Models\Apps', 'usercreate', array('alias' => 'Apps'));
    $this->hasMany('id', 'Nucleo\Models\Apps', 'userupdate', array('alias' => 'Apps'));
    $this->hasMany('id', 'Nucleo\Models\Modules', 'usercreate', array('alias' => 'Modules'));
    $this->hasMany('id', 'Nucleo\Models\Modules', 'userupdate', array('alias' => 'Modules'));
    $this->hasMany('id', 'Nucleo\Models\Perfil', 'usercreate', array('alias' => 'Perfil'));
    $this->hasMany('id', 'Nucleo\Models\Perfil', 'userupdate', array('alias' => 'Perfil'));
    $this->hasMany('id', 'Nucleo\Models\Users', 'usercreate', array('alias' => 'Users'));
    $this->hasMany('id', 'Nucleo\Models\Users', 'userupdate', array('alias' => 'Users'));
    $this->belongsTo('usercreate', 'Nucleo\Models\Users', 'id', array('alias' => 'Users'));
    $this->belongsTo('userupdate', 'Nucleo\Models\Users', 'id', array('alias' => 'Users'));

    $this->addBehavior(new SoftDelete([
        'field' => 'delete',
        'value' => '1'
    ]));

    $this->addBehavior(new Timestampable(array(
        'beforeCreate' => array(
            'field' => 'datecreate',
            'format' => function() {
              $datetime = new Datetime(new DateTimeZone('America/Sao_Paulo'));
              return $datetime->format('Y-m-d H:i:sP');
            }
        ),
        'beforeUpdate' => array(
            'field' => 'dateupdate',
            'format' => function() {
              $datetime = new Datetime(new DateTimeZone('America/Sao_Paulo'));
              return $datetime->format('Y-m-d H:i:sP');
            }
        )
            )
    ));
  }

  public function getSource() {
    return 'users';
  }

}
