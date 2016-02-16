<?php

/**
 * @copyright   2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Models;

use Phalcon\Mvc\Model\Validator\Email as Email;

class Users extends ModelBase {

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
  protected $cpf;

  /**
   *
   * @var string
   */
  protected $password;

  /**
   *
   * @var string
   */
  protected $mustChangePassword;

  /**
   *
   * @var string
   */
  protected $email;

  /**
   *
   * @var string
   */
  protected $name;

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
   * Method to set the value of field senha
   *
   * @param string $senha
   * @return $this
   */
  public function setPassword($password) {
    $this->password = $password;

    return $this;
  }

  /**
   * Method to set the value of field mustChangePassword
   *
   * @param string $mustChangePassword
   * @return $this
   */
  public function setMustChangePassword($mustChangePassword) {

    if (!is_null($mustChangePassword)) {
      $this->mustChangePassword = 1;
    } else {
      $this->mustChangePassword = $mustChangePassword;
    }

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
   * Returns the value of field cpf
   *
   * @return string
   */
  public function getCpf() {
    return $this->cpf;
  }

  /**
   * Returns the value of field senha
   *
   * @return string
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * Returns the value of field mustChangePassword
   *
   * @return string
   */
  public function getMustChangePassword() {
    if (1 == ((int) $this->mustChangePassword)) {
      return 'on';
    } else {
      return $this->mustChangePassword;
    }
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
   * Validations and business logic
   *
   * @return boolean
   */
  public function validation() {
    $this->validate(new Email(array('field' => 'email', 'required' => true,)));

    if ($this->validationHasFailed() == true) {
      return false;
    }

    return true;
  }

  /**
   * Initialize method for model.
   */
  public function initialize() {

    $this->setSchema('NUCLEO');

    $this->hasMany('id', 'Nucleo\Models\Logins', 'userId', array('alias' => 'Logins'));
    $this->hasMany('id', 'Nucleo\Models\Notifications', 'userId', array('alias' => 'Notifications'));
    $this->hasMany('id', 'Nucleo\Models\Perfils', 'user', array('alias' => 'Perfils'));
    $this->hasMany('id', 'Nucleo\Models\Tokens', 'usersId', array('alias' => 'Tokens'));
    $this->hasMany('id', 'Nucleo\Models\UsersGroups', 'userId', array('alias' => 'UsersGroups'));

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
    return 'USUARIO_N';
  }

  /**
   * Independent Column Mapping.
   * Keys are the real names in the table and the values their names in the application
   *
   * @return array
   */
  public static function columnMap() {
    return [
        'ID_USUARIO' => 'id',
        'CD_CPF' => 'cpf',
        'DS_SENHA' => 'password',
        'FL_MUDASENHA' => 'mustChangePassword',
        'DS_EMAIL' => 'email',
        'DS_NOME' => 'name',
        'FL_STATUS' => 'status',
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
            'id' => false,
            'cpf' => true,
            'password' => false,
            'confirmPassword' => false,
            'mustChangePassword' => false,
            'email' => true,
            'name' => true,
            'status' => true,
            'csrf' => false,
        ),
        'search' => array(
            'id' => false,
            'cpf' => true,
            'password' => false,
            'confirmPassword' => false,
            'mustChangePassword' => false,
            'email' => true,
            'name' => true,
            'status' => true,
            'csrf' => false,
        ),
        'insert' => array(
            'id' => false,
            'cpf' => true,
            'password' => true,
            'confirmPassword' => false,
            'mustChangePassword' => true,
            'email' => true,
            'name' => true,
            'status' => true,
            'csrf' => false,
        ),
        'update' => array(
            'id' => true,
            'cpf' => true,
            'password' => true,
            'confirmPassword' => false,
            'mustChangePassword' => true,
            'email' => true,
            'name' => true,
            'status' => true,
            'csrf' => false,
        ),
        'registration' => array(
            'id' => false,
            'cpf' => true,
            'password' => true,
            'confirmPassword' => true,
            'mustChangePassword' => false,
            'email' => true,
            'name' => true,
            'status' => false,
            'csrf' => true,
        ),
        'password' => array(
            'id' => true,
            'cpf' => false,
            'password' => true,
            'confirmPassword' => true,
            'mustChangePassword' => false,
            'email' => false,
            'name' => false,
            'status' => false,
            'csrf' => true,
        ),
    );
  }

  public function desc() {

    return array(
        'id' => array(
            'type' => 'hidden',
            'primary' => true,
            'attributes' => array(
                'maxlength' => 11,
                'required' => 'required'
            ),
            'validation' => array(
                'PresenceOf' => true,
            ),
        ),
        'cpf' => array(
            'type' => 'text',
            'title' => 'CPF',
            'attributes' => array(
                'maxlength' => 14,
                'required' => 'required'
            ),
            'validation' => array(
                'PresenceOf' => true,
                'Uniqueness' => 'Users',
                'Regex' => '([0-9]{2}[\.]?[0-9]{3}[\.]?[0-9]{3}[\/]?[0-9]{4}[-]?[0-9]{2})|([0-9]{3}[\.]?[0-9]{3}[\.]?[0-9]{3}[-]?[0-9]{2})',
            ),
        ),
        'password' => array(
            'type' => 'password',
            'title' => 'Senha',
            'attributes' => array(
                'maxlength' => 105,
            ),
            'validation' => array(
                'PresenceOf' => true,
            ),
        ),
        'confirmPassword' => array(
            'type' => 'password',
            'title' => 'Confirme sua Senha',
            'virtual' => true,
            'attributes' => array(
                'maxlength' => 105,
            ),
            'validation' => array(
                'PresenceOf' => true,
                'Confirmation' => 'password',
            ),
        ),
        'mustChangePassword' => array(
            'type' => 'checkbox',
            'title' => 'Forçar troca de Senha',
            'attributes' => array(),
            'actions' => array(
                'list' => false,
                'search' => false,
                'insert' => true,
                'update' => true,
                'registration' => false,
            )
        ), 'email' => array(
            'type' => 'email',
            'title' => 'E-mail',
            'attributes' => array(
                'maxlength' => 105,
            ),
            'validation' => array(
                'Email' => true,
                'Uniqueness' => 'Users'
            ),
        ),
        'name' => array(
            'type' => 'text',
            'title' => 'Nome',
            'attributes' => array(
                'maxlength' => 105
            ),
        ),
        'status' => array(
            'type' => 'select',
            'title' => 'Status',
            'select' => array(
                'entity' => 'Nucleo\Models\TablesSystem',
                'filter' => array(
                    'field' => 'table',
                    'value' => 'status'
                ),
                'selectField' => array(
                    'key' => 'code',
                    'value' => 'value'
                ),
                'selectEmpty' => true,
            ),
            'attributes' => array(
                'required' => 'required'
            ),
            'validation' => array(
                'PresenceOf' => true,
            ),
        ),
        'csrf' => array(
            'type' => 'hidden',
            'attributes' => array(
                'required' => 'required'
            ),
            'validation' => array(
                'Identical' => true,
            ),
        )
    );
  }

}
