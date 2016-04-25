<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models;

use DevDenners\Models\ModelBase;
use Phalcon\Mvc\Model\Behavior\SoftDelete as SoftDelete;
use Phalcon\Mvc\Model\Message as Message;
use Phalcon\Validation as Validation;
use Phalcon\Validation\Validator\Email as ValidatorEmail;
use Phalcon\Validation\Validator\Uniqueness as Uniqueness;
use DevDenners\Models\beforeCreate;
use DevDenners\Models\beforeUpdate;

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
    protected $name;

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
     * Method to set the value of field name
     *
     * @param string $cpf
     * @return $this
     */
    public function setName($name) {
        $this->name = $name;

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
        $this->mustChangePassword = $mustChangePassword;
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
     * Returns the value of field name
     *
     * @return string
     */
    public function getname() {
        return $this->name;
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
        return $this->mustChangePassword;
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

        /* $validation = new Validation();
          $validation->add('email', new ValidatorEmail(
          ['field' => 'email', 'required' => false, 'message' => 'E-mail não é válido!']
          ));

          $validation->add('cpf', new Uniqueness(
          ['field' => 'cpf', 'message' => 'Esse CPF já está cadastrado no sistema!']
          ));
          $validation->add('email', new Uniqueness(
          [ 'field' => 'email', 'message' => 'Esse E-mail já está cadastrado no sistema!']
          ));

          $this->validate($validation);

          return $this->validationHasFailed() != true; */
    }

    /**
     * Initialize method for model.
     */
    public function initialize() {

        parent::initialize();

        $this->setSchema('NUCLEO');

        $this->hasMany('id', __NAMESPACE__ . '\Logins', 'userId', ['alias' => 'Logins',]);
        $this->hasMany('id', __NAMESPACE__ . '\Notifications', 'userId', ['alias' => 'Notifications']);
        $this->hasMany('id', __NAMESPACE__ . '\Perfils', 'user', ['alias' => 'Perfils']);
        $this->hasMany('id', __NAMESPACE__ . '\Tokens', 'usersId', ['alias' => 'Tokens']);
        $this->hasMany('id', __NAMESPACE__ . '\UsersGroups', 'userId', ['alias' => 'UsersGroups']);

        $this->addBehavior(new SoftDelete([
            'field' => 'sdel',
            'value' => '*'
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
            'DS_NOME' => 'name',
            'DS_SENHA' => 'password',
            'FL_MUDASENHA' => 'mustChangePassword',
            'DS_EMAIL' => 'email',
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

}
