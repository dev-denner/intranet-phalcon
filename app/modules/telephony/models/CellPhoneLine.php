<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Telephony\Models;

use SysPhalcon\Models\ModelBase;
use SysPhalcon\Models\beforeCreate;
use SysPhalcon\Models\beforeUpdate;
use Phalcon\Mvc\Model\Behavior\SoftDelete;

class CellPhoneLine extends ModelBase {

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
    protected $linha;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $tipo;

    /**
     *
     * @var string
     */
    protected $descontaFolha;

    /**
     *
     * @var string
     */
    protected $cceo;

    /**
     *
     * @var string
     */
    protected $sdel;

    /**
     *
     * @var date
     */
    protected $createIn;

    /**
     *
     * @var string
     */
    protected $createBy;

    /**
     *
     * @var date
     */
    protected $updateIn;

    /**
     *
     * @var string
     */
    protected $updateBy;

    /**
     *
     * @return type
     */
    public function getId() {
        return $this->id;
    }

    /**
     *
     * @return type
     */
    public function getCpf() {
        return $this->cpf;
    }

    /**
     *
     * @return type
     */
    public function getLinha() {
        return $this->linha;
    }

    /**
     *
     * @return type
     */
    public function getName() {
        return $this->name;
    }

    /**
     *
     * @return type
     */
    public function getTipo() {
        return $this->tipo;
    }

    /**
     *
     * @return type
     */
    public function getDescontaFolha() {
        return $this->descontaFolha;
    }

    /**
     *
     * @return type
     */
    public function getCceo() {
        return $this->cceo;
    }

    /**
     *
     * @return type
     */
    public function getSdel() {
        return $this->sdel;
    }

    /**
     *
     * @return type
     */
    public function getCreateIn() {
        return $this->createIn;
    }

    /**
     *
     * @return type
     */
    public function getCreateBy() {
        return $this->createBy;
    }

    /**
     *
     * @return type
     */
    public function getUpdateIn() {
        return $this->updateIn;
    }

    /**
     *
     * @return type
     */
    public function getUpdateBy() {
        return $this->updateBy;
    }

    /**
     *
     * @param type $id
     * @return \Telephony\Models\CellPhoneLine
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @param type $cpf
     * @return \Telephony\Models\CellPhoneLine
     */
    public function setCpf($cpf) {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     *
     * @param type $linha
     * @return \Telephony\Models\CellPhoneLine
     */
    public function setLinha($linha) {
        $this->linha = $linha;
        return $this;
    }

    /**
     *
     * @param type $name
     * @return \Telephony\Models\CellPhoneLine
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     *
     * @param type $tipo
     * @return \Telephony\Models\CellPhoneLine
     */
    public function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     *
     * @param type $descontaFolha
     * @return \Telephony\Models\CellPhoneLine
     */
    public function setDescontaFolha($descontaFolha) {

        if (is_null($descontaFolha)) {
            $descontaFolha = 'N';
        }

        $this->descontaFolha = $descontaFolha;
        return $this;
    }

    /**
     *
     * @param type $cceo
     * @return \Telephony\Models\CellPhoneLine
     */
    public function setCceo($cceo) {
        $this->cceo = $cceo;
        return $this;
    }

    /**
     *
     * @param type $sdel
     * @return \Telephony\Models\CellPhoneLine
     */
    public function setSdel($sdel) {
        $this->sdel = $sdel;
        return $this;
    }

    /**
     *
     * @param type $createIn
     * @return \Telephony\Models\CellPhoneLine
     */
    public function setCreateIn($createIn) {
        $this->createIn = $createIn;
        return $this;
    }

    /**
     *
     * @param type $createBy
     * @return \Telephony\Models\CellPhoneLine
     */
    public function setCreateBy($createBy) {
        $this->createBy = $createBy;
        return $this;
    }

    /**
     *
     * @param type $updateIn
     * @return \Telephony\Models\CellPhoneLine
     */
    public function setUpdateIn($updateIn) {
        $this->updateIn = $updateIn;
        return $this;
    }

    /**
     *
     * @param type $updateBy
     * @return \Telephony\Models\CellPhoneLine
     */
    public function setUpdateBy($updateBy) {
        $this->updateBy = $updateBy;
        return $this;
    }

    /**
     *
     */
    public function initialize() {

        parent::initialize();

        $this->setConnectionService('telefoniaDb');

        $this->addBehavior(new SoftDelete([
            'field' => 'sdel',
            'value' => '*'
        ]));
    }

    /**
     *
     * @return string
     */
    public function getSource() {
        return 'LINHA_CELULAR';
    }

    /**
     *
     * @return type
     */
    public static function columnMap() {
        return [
            'ID' => 'id',
            'CPF' => 'cpf',
            'LINHA' => 'linha',
            'DS_NOME' => 'name',
            'DS_TIPO' => 'tipo',
            'DESC_FOLHA' => 'descontaFolha',
            'CCEO' => 'cceo',
            'SDEL' => 'sdel',
            'USUARIO' => 'createBy',
            'DATAINCLUSO' => 'createIn',
            'UPDATEBY' => 'updateBy',
            'UPDATEIN' => 'updateIn',
        ];
    }

    /**
     *
     * @return string
     */
    public static function getDeleted() {
        return 'sdel';
    }

}
