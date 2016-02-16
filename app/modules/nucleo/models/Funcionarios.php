<?php

/**
 * @copyright   2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Models;

use Phalcon\Mvc\Model\Validator\Email as Email;

class Funcionarios extends ModelBase {

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
  protected $chapa;

  /**
   *
   * @var string
   */
  protected $nome;

  /**
   *
   * @var string
   */
  protected $cpf;

  /**
   *
   * @var integer
   */
  protected $empresa;

  /**
   *
   * @var string
   */
  protected $situacao;

  /**
   *
   * @var string
   */
  protected $tipo;

  /**
   *
   * @var string
   */
  protected $dataAdmissao;

  /**
   *
   * @var string
   */
  protected $cargo;

  /**
   *
   * @var string
   */
  protected $email;

  /**
   *
   * @var string
   */
  protected $centroCusto;

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
   * Method to set the value of field chapa
   *
   * @param string $chapa
   * @return $this
   */
  public function setChapa($chapa) {
    $this->chapa = $chapa;

    return $this;
  }

  /**
   * Method to set the value of field nome
   *
   * @param string $nome
   * @return $this
   */
  public function setNome($nome) {
    $this->nome = $nome;

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
   * Method to set the value of field empresa
   *
   * @param integer $empresa
   * @return $this
   */
  public function setEmpresa($empresa) {
    $this->empresa = $empresa;

    return $this;
  }

  /**
   * Method to set the value of field situacao
   *
   * @param string $situacao
   * @return $this
   */
  public function setSituacao($situacao) {
    $this->situacao = $situacao;

    return $this;
  }

  /**
   * Method to set the value of field tipo
   *
   * @param string $tipo
   * @return $this
   */
  public function setTipo($tipo) {
    $this->tipo = $tipo;

    return $this;
  }

  /**
   * Method to set the value of field dataAdmissao
   *
   * @param string $dataAdmissao
   * @return $this
   */
  public function setDataAdmissao($dataAdmissao) {
    $this->dataAdmissao = $dataAdmissao;

    return $this;
  }

  /**
   * Method to set the value of field cargo
   *
   * @param string $cargo
   * @return $this
   */
  public function setCargo($cargo) {
    $this->cargo = $cargo;

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
   * Method to set the value of field centroCusto
   *
   * @param string $centroCusto
   * @return $this
   */
  public function setCentroCusto($centroCusto) {
    $this->centroCusto = $centroCusto;

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
   * Returns the value of field chapa
   *
   * @return string
   */
  public function getChapa() {
    return $this->chapa;
  }

  /**
   * Returns the value of field nome
   *
   * @return string
   */
  public function getNome() {
    return $this->nome;
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
   * Returns the value of field empresa
   *
   * @return integer
   */
  public function getEmpresa() {
    return $this->empresa;
  }

  /**
   * Returns the value of field situacao
   *
   * @return string
   */
  public function getSituacao() {
    return $this->situacao;
  }

  /**
   * Returns the value of field tipo
   *
   * @return string
   */
  public function getTipo() {
    return $this->tipo;
  }

  /**
   * Returns the value of field dataAdmissao
   *
   * @return string
   */
  public function getDataAdmissao() {
    return $this->dataAdmissao;
  }

  /**
   * Returns the value of field cargo
   *
   * @return string
   */
  public function getCargo() {
    return $this->cargo;
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
   * Returns the value of field centroCusto
   *
   * @return string
   */
  public function getCentroCusto() {
    return $this->centroCusto;
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

    return true;
  }

  /**
   * Initialize method for model.
   */
  public function initialize() {
    $this->belongsTo('empresa', 'Nucleo\Models\Empresas', 'id', array('alias' => 'Empresas'));

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
    return 'funcionarios';
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
        'chapa' => 'chapa',
        'nome' => 'nome',
        'cpf' => 'cpf',
        'empresa' => 'empresa',
        'situacao' => 'situacao',
        'tipo' => 'tipo',
        'dataAdmissao' => 'dataAdmissao',
        'cargo' => 'cargo',
        'email' => 'email',
        'centroCusto' => 'centroCusto',
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
