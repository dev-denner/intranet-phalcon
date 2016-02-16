<?php

/**
 * @copyright   2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Models;

class Empresas extends ModelBase {

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
  protected $codigo;

  /**
   *
   * @var string
   */
  protected $cnpj;

  /**
   *
   * @var string
   */
  protected $razaoSocial;

  /**
   *
   * @var string
   */
  protected $nomeFantasia;

  /**
   *
   * @var string
   */
  protected $codProtheus;

  /**
   *
   * @var string
   */
  protected $lojaProtheus;

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
   * Method to set the value of field codigo
   *
   * @param string $codigo
   * @return $this
   */
  public function setCodigo($codigo) {
    $this->codigo = $codigo;

    return $this;
  }

  /**
   * Method to set the value of field cnpj
   *
   * @param string $cnpj
   * @return $this
   */
  public function setCnpj($cnpj) {
    $this->cnpj = $cnpj;

    return $this;
  }

  /**
   * Method to set the value of field razaoSocial
   *
   * @param string $razaoSocial
   * @return $this
   */
  public function setRazaoSocial($razaoSocial) {
    $this->razaoSocial = $razaoSocial;

    return $this;
  }

  /**
   * Method to set the value of field nomeFantasia
   *
   * @param string $nomeFantasia
   * @return $this
   */
  public function setNomeFantasia($nomeFantasia) {
    $this->nomeFantasia = $nomeFantasia;

    return $this;
  }

  /**
   * Method to set the value of field codProtheus
   *
   * @param string $codProtheus
   * @return $this
   */
  public function setCodProtheus($codProtheus) {
    $this->codProtheus = $codProtheus;

    return $this;
  }

  /**
   * Method to set the value of field lojaProtheus
   *
   * @param string $lojaProtheus
   * @return $this
   */
  public function setLojaProtheus($lojaProtheus) {
    $this->lojaProtheus = $lojaProtheus;

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
   * Returns the value of field codigo
   *
   * @return string
   */
  public function getCodigo() {
    return $this->codigo;
  }

  /**
   * Returns the value of field cnpj
   *
   * @return string
   */
  public function getCnpj() {
    return $this->cnpj;
  }

  /**
   * Returns the value of field razaoSocial
   *
   * @return string
   */
  public function getRazaoSocial() {
    return $this->razaoSocial;
  }

  /**
   * Returns the value of field nomeFantasia
   *
   * @return string
   */
  public function getNomeFantasia() {
    return $this->nomeFantasia;
  }

  /**
   * Returns the value of field codProtheus
   *
   * @return string
   */
  public function getCodProtheus() {
    return $this->codProtheus;
  }

  /**
   * Returns the value of field lojaProtheus
   *
   * @return string
   */
  public function getLojaProtheus() {
    return $this->lojaProtheus;
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
    $this->hasMany('id', 'Nucleo\Models\Funcionarios', 'empresa', array('alias' => 'Funcionarios'));

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
    return 'empresas';
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
        'codigo' => 'codigo',
        'cnpj' => 'cnpj',
        'razaoSocial' => 'razaoSocial',
        'nomeFantasia' => 'nomeFantasia',
        'codProtheus' => 'codProtheus',
        'lojaProtheus' => 'lojaProtheus',
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
