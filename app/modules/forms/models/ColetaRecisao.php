<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Forms\Models;

use App\Shared\Models\ModelBase;
use App\Shared\Models\beforeCreate;
use App\Shared\Models\beforeUpdate;
use Phalcon\Mvc\Model\Behavior\SoftDelete;

class ColetaRecisao extends ModelBase {

    use beforeCreate;

use beforeUpdate;

    protected $id;
    protected $contract;
    protected $sequence;
    protected $status;
    protected $sdel;
    protected $createBy;
    protected $createIn;
    protected $updateBy;
    protected $updateIn;

    public function getId() {
        return $this->id;
    }

    public function getContract() {
        return $this->contract;
    }

    public function getSequence() {
        return $this->sequence;
    }

    public function getStatus() {
        return $this->status;
    }

    public function getSdel() {
        return $this->sdel;
    }

    public function getCreateBy() {
        return $this->createBy;
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

    public function setContract($contract) {
        $this->contract = $contract;
        return $this;
    }

    public function setSequence($sequence) {
        $this->sequence = $sequence;
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

    public function setCreateBy($createBy) {
        $this->createBy = $createBy;
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

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'FRM_COLETA_RESCISAO';
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public static function columnMap() {
        return [
            'ID_FRM_COLETA_RESCISAO' => 'id',
            'CD_CONTRATO' => 'contract',
            'DS_SEQUENCIA' => 'sequence',
            'ST_STATUS' => 'status',
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

    public function getSequenceTable() {

        $connection = $this->customSimpleQuery('db');
        $query = "SELECT SQ_FRM_COLETA_RESCISAO.nextval FROM DUAL";
        $nextval = $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
        return $nextval[0]['NEXTVAL'];
    }

}
