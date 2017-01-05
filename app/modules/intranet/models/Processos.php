<?php

/**
 * @copyright   2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Intranet\Models;

use SysPhalcon\Models\ModelBase;
use SysPhalcon\Models\beforeCreate;
use SysPhalcon\Models\beforeUpdate;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
use Phalcon\Db\RawValue;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Processos extends ModelBase {

    use beforeCreate;

use beforeUpdate;

    /**
     *
     * @var int
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $code;

    /**
     *
     * @var string
     */
    protected $department;

    /**
     *
     * @var string
     */
    protected $description;

    /**
     *
     * @var string
     */
    protected $link;

    /**
     *
     * @var string
     */
    protected $version;

    /**
     *
     * @var string
     */
    protected $dateUpdated;

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
    public function getCode() {
        return $this->code;
    }

    /**
     *
     * @return type
     */
    public function getDepartment() {
        return $this->department;
    }

    /**
     *
     * @return type
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     *
     * @return type
     */
    public function getLink() {
        return $this->link;
    }

    /**
     *
     * @return type
     */
    public function getVersion() {
        return $this->version;
    }

    /**
     *
     * @return type
     */
    public function getDateUpdated() {
        $myDateTime = \DateTime::createFromFormat('d-M-y', $this->dateUpdated);
        return $myDateTime->format('d/m/Y');
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
    public function getCreateBy() {
        return $this->createBy;
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
    public function getUpdateBy() {
        return $this->updateBy;
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
     * @param type $id
     * @return \Intranet\Models\Processos
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @param type $code
     * @return \Intranet\Models\Processos
     */
    public function setCode($code) {
        $this->code = $code;
        return $this;
    }

    /**
     *
     * @param type $department
     * @return \Intranet\Models\Processos
     */
    public function setDepartment($department) {
        $this->department = $department;
        return $this;
    }

    /**
     *
     * @param type $description
     * @return \Intranet\Models\Processos
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     *
     * @param type $link
     * @return \Intranet\Models\Processos
     */
    public function setLink($link) {
        $this->link = $link;
        return $this;
    }

    /**
     *
     * @param type $version
     * @return \Intranet\Models\Processos
     */
    public function setVersion($version) {
        $this->version = $version;
        return $this;
    }

    /**
     *
     * @param type $dateUpdated
     * @return \Intranet\Models\Processos
     */
    public function setDateUpdated($dateUpdated) {
        $this->dateUpdated = new RawValue("TO_DATE('{$dateUpdated}', 'DD/MM/YYYY')");
        return $this;
    }

    /**
     *
     * @param type $sdel
     * @return \Intranet\Models\Processos
     */
    public function setSdel($sdel) {
        $this->sdel = $sdel;
        return $this;
    }

    /**
     *
     * @param type $createBy
     * @return \Intranet\Models\Processos
     */
    public function setCreateBy($createBy) {
        $this->createBy = $createBy;
        return $this;
    }

    /**
     *
     * @param type $createIn
     * @return \Intranet\Models\Processos
     */
    public function setCreateIn($createIn) {
        $this->createIn = $createIn;
        return $this;
    }

    /**
     *
     * @param type $updateBy
     * @return \Intranet\Models\Processos
     */
    public function setUpdateBy($updateBy) {
        $this->updateBy = $updateBy;
        return $this;
    }

    /**
     *
     * @param type $updateIn
     * @return \Intranet\Models\Processos
     */
    public function setUpdateIn($updateIn) {
        $this->updateIn = $updateIn;
        return $this;
    }

    /**
     * Initialize method for model.
     */
    public function initialize() {

        parent::initialize();
        $this->belongsTo('department', '\Nucleo\Models\Departments', 'id', ['alias' => 'Departments']);

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
        return 'PROCESSO_TIC';
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public static function columnMap() {
        return [
            'ID_PROCESSO_TIC' => 'id',
            'CD_COD_PROCESSO' => 'code',
            'CD_DEPARTAMENTO' => 'department',
            'DS_DESCRICAO' => 'description',
            'DS_LINK' => 'link',
            'DS_VERSAO' => 'version',
            'DT_DATA_ATUALIZACAO' => 'dateUpdated',
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

    public function getReport($search = '', $departmento = '') {

        if (!empty($search)) {
            $search = " AND (UPPER(PR.CD_COD_PROCESSO) LIKE UPPER('%{$search}%') OR UPPER(PR.DS_DESCRICAO) LIKE UPPER('%{$search}%') OR UPPER(DP.DS_TITULO) LIKE UPPER('%{$search}%'))";
        }

        if (!empty($departmento)) {
            $search .= ' AND PR.CD_DEPARTAMENTO = ' . $departmento;
        }

        $sql = "SELECT PR.CD_COD_PROCESSO Processo, DP.DS_TITULO Departamento, PR.DS_DESCRICAO Descrição, PR.DS_LINK Links, PR.DS_VERSAO Versão, TO_CHAR(PR.DT_DATA_ATUALIZACAO, 'DD/MM/YYYY') Data_de_Atualização FROM PROCESSO_TIC PR INNER JOIN DEPARTAMENTO DP ON DP.ID_DEPARTAMENTO = PR.CD_DEPARTAMENTO AND DP.SDEL IS NULL WHERE PR.SDEL IS NULL {$search} ORDER BY 1";

        $listagemGeral = new Processos();
        return new Resultset(null, $listagemGeral, $listagemGeral->getReadConnection()->query($sql));
    }

}
