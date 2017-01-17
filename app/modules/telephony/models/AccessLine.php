<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace App\Modules\Telephony\Models;

use App\Shared\Models\ModelBase;
use App\Shared\Models\beforeCreate;
use App\Shared\Models\beforeUpdate;
use Phalcon\Mvc\Model\Behavior\SoftDelete;

class AccessLine extends ModelBase {

    use beforeCreate;

use beforeUpdate;

    /**
     *
     * @var type
     */
    protected $id;

    /**
     *
     * @var type
     */
    protected $cpf;

    /**
     *
     * @var type
     */
    protected $linha;

    /**
     *
     * @var type
     */
    protected $sdel;

    /**
     *
     * @var type
     */
    protected $createIn;

    /**
     *
     * @var type
     */
    protected $createBy;

    /**
     *
     * @var type
     */
    protected $updateIn;

    /**
     *
     * @var type
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
     * @param int $id
     * @return \Telephony\Models\AccessLine
     */
    public function setId(int $id) {
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @param string $cpf
     * @return \Telephony\Models\AccessLine
     */
    public function setCpf($cpf) {
        $this->cpf = $cpf;
        return $this;
    }

    /**
     *
     * @param string $linha
     * @return \Telephony\Models\AccessLine
     */
    public function setLinha($linha) {
        $this->linha = $linha;
        return $this;
    }

    /**
     *
     * @param string $sdel
     * @return \Telephony\Models\AccessLine
     */
    public function setSdel($sdel) {
        $this->sdel = $sdel;
        return $this;
    }

    /**
     *
     * @param string $createIn
     * @return \Telephony\Models\AccessLine
     */
    public function setCreateIn($createIn) {
        $this->createIn = $createIn;
        return $this;
    }

    /**
     *
     * @param string $createBy
     * @return \Telephony\Models\AccessLine
     */
    public function setCreateBy($createBy) {
        $this->createBy = $createBy;
        return $this;
    }

    /**
     *
     * @param type $updateIn
     * @return \Telephony\Models\AccessLine
     */
    public function setUpdateIn($updateIn) {
        $this->updateIn = $updateIn;
        return $this;
    }

    /**
     *
     * @param string $updateBy
     * @return \Telephony\Models\AccessLine
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
        return 'ACESSO_LINHA';
    }

    /**
     *
     * @return type
     */
    public static function columnMap() {
        return [
            'ID_ACESSO_LINHA' => 'id',
            'CD_CPF_AGENTE' => 'cpf',
            'CD_LINHA' => 'linha',
            'SDEL' => 'sdel',
            'CREATEBY' => 'createBy',
            'CREATEIN' => 'createIn',
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
