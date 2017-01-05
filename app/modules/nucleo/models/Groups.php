<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Models;

use SysPhalcon\Models\ModelBase;
use SysPhalcon\Models\beforeCreate;
use SysPhalcon\Models\beforeUpdate;
use Phalcon\Mvc\Model\Behavior\SoftDelete;

class Groups extends ModelBase {

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
    protected $title;

    /**
     *
     * @var string
     */
    protected $status;

    /**
     *
     * @var string
     */
    protected $type;

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
     * Method to set the value of field title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title) {
        $this->title = $title;

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
     * Method to set the value of field type
     *
     * @param string $type
     * @return $this
     */
    public function setType($type) {
        $this->type = $type;

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
     * Returns the value of field title
     *
     * @return string
     */
    public function getTitle() {
        return $this->title;
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
     * Returns the value of field type
     *
     * @return string
     */
    public function getType() {
        return $this->type;
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
        parent::initialize();
        $this->hasMany('id', __NAMESPACE__ . '\Perfils', 'groupId', ['alias' => 'Perfils']);
        $this->hasMany('id', __NAMESPACE__ . '\UsersGroups', 'groupId', ['alias' => 'UsersGroups']);
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
        return 'GRUPO';
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public static function columnMap() {
        return array(
            'ID_GRUPO' => 'id',
            'DS_TITULO' => 'title',
            'FL_STATUS' => 'status',
            'FL_TIPO' => 'type',
            'SDEL' => 'sdel',
            'CREATEBY' => 'createBy',
            'CREATEIN' => 'createIn',
            'UPDATEBY' => 'updateBy',
            'UPDATEIN' => 'updateIn',
        );
    }

    public static function getDeleted() {
        return 'sdel';
    }

}
