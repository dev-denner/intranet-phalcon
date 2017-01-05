<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Forms\Models;

use SysPhalcon\Models\ModelBase;
use SysPhalcon\Models\beforeUpdate;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
use Phalcon\Db\RawValue;

class SolicitacoesExternas extends ModelBase {

    use beforeUpdate;

    protected $id;
    protected $cpf;
    protected $type;
    protected $status;
    protected $sdel;
    protected $createIn;
    protected $updateBy;
    protected $updateIn;

    public function getId() {
        return $this->id;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getType() {
        return $this->type;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getSdel() {
        return $this->sdel;
    }

    public function getCreateIn() {
        return $this->createIn;
    }

    public function getUpdateBy() {
        return $this->updateBy;
    }

    public function getUpdateIn() {
        return $this->updateIn;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
        return $this;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }

    public function setStatus($status) {
        $this->status = $status;
        return $this;
    }

    public function setSdel($sdel) {
        $this->sdel = $sdel;
        return $this;
    }

    public function setCreateIn($createIn) {
        $this->createIn = $createIn;
        return $this;
    }

    public function setUpdateBy($updateBy) {
        $this->updateBy = $updateBy;
        return $this;
    }

    public function setUpdateIn($updateIn) {
        $this->updateIn = $updateIn;
        return $this;
    }

    /**
     * Initialize method for model.
     */
    public function initialize() {

        parent::initialize();

        $this->addBehavior(new SoftDelete([
            'field' => 'sdel',
            'value' => '*'
        ]));
    }

    public function beforeCreate() {

        $this->createIn = new RawValue('SYSDATE');
        $this->skipAttributesOnUpdate(['updateBy', 'updateIn']);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'FRM_EXTERNO';
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public static function columnMap() {
        return [
            'ID_FRM_EXTERNO' => 'id',
            'CD_CPF' => 'cpf',
            'DS_TIPO' => 'type',
            'ST_STATUS' => 'status',
            'SDEL' => 'sdel',
            'CREATEIN' => 'createIn',
            'UPDATEBY' => 'updateBy',
            'UPDATEIN' => 'updateIn',
        ];
    }

    public static function getDeleted() {
        return 'sdel';
    }

}
