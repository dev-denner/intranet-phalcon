<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models;

use SysPhalcon\Models\ModelBase;
use Phalcon\Mvc\Model\Behavior\SoftDelete as SoftDelete;
use Phalcon\Mvc\Model\Message as Message;
use Phalcon\Validation as Validation;
use SysPhalcon\Models\beforeCreate;
use SysPhalcon\Models\beforeUpdate;

class CategoriesDocuments extends ModelBase {

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
    protected $description;

    /**
     *
     * @var string
     */
    protected $category;

    /**
     *
     * @var string
     */
    protected $department;

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
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Returns the value of field description
     *
     * @return string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Returns the value of field category
     *
     * @return string
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Returns the value of field department
     *
     * @return string
     */
    public function getDepartment() {
        return $this->department;
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
     * Method to set the value of field id
     *
     * @param string $id
     * @return $this
     */
    function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Method to set the value of field description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Method to set the value of field category
     *
     * @param string $category
     * @return $this
     */
    public function setCategory($category) {
        $this->category = $category;
        return $this;
    }

    /**
     * Method to set the value of field department
     *
     * @param string $department
     * @return $this
     */
    public function setDepartment($department) {
        $this->department = $department;
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
     * Validations and business logic
     *
     * @return boolean
     */
    public function validation() {

    }

    /**
     * Initialize method for model.
     */
    public function initialize() {

        parent::initialize();

        $this->setSchema('NUCLEO');

        $this->belongsTo('department', __NAMESPACE__ . '\Departments', 'id', ['alias' => 'Departments']);
        $this->belongsTo('category', __NAMESPACE__ . '\Categories', 'id', ['alias' => 'Categories']);

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
        return 'CATEGORIA_DOCUMENTO';
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public static function columnMap() {
        return [
            'ID_CATEGORIA_DOCUMENTO' => 'id',
            'DS_DESCRICAO' => 'description',
            'CD_CATEGORIA' => 'category',
            'CD_DEPARTAMENTO' => 'department',
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
