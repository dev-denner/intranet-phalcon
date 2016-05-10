<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models;

use SysPhalcon\Models\ModelBase;
use SysPhalcon\Models\beforeCreate;
use SysPhalcon\Models\beforeUpdate;
use Phalcon\Mvc\Model\Message as Message;

class Menus extends ModelBase {

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
    protected $slug;

    /**
     *
     * @var integer
     */
    protected $department;

    /**
     *
     * @var integer
     */
    protected $module;

    /**
     *
     * @var integer
     */
    protected $controller;

    /**
     *
     * @var integer
     */
    protected $action;

    /**
     *
     * @var integer
     */
    protected $category;

    /**
     *
     * @var integer
     */
    protected $icon;

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
     * Method to set the value of field slug
     *
     * @param string $slug
     * @return $this
     */
    public function setSlug($slug) {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Method to set the value of field department
     *
     * @param integer $department
     * @return $this
     */
    public function setDepartment($department) {

        if (empty($department)) {
            $department = null;
        }
        $this->department = $department;

        return $this;
    }

    /**
     * Method to set the value of field module
     *
     * @param integer $module
     * @return $this
     */
    public function setModule($module) {
        if (empty($module)) {
            $this->module = null;
        } else {
            $this->module = $module;
        }

        return $this;
    }

    /**
     * Method to set the value of field controller
     *
     * @param integer $controller
     * @return $this
     */
    public function setController($controller) {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Method to set the value of field action
     *
     * @param integer $action
     * @return $this
     */
    public function setAction($action) {
        $this->action = $action;

        return $this;
    }

    /**
     * Method to set the value of field category
     *
     * @param integer $category
     * @return $this
     */
    public function setCategory($category) {

        if (empty($category)) {
            $category = null;
        }
        $this->category = $category;

        return $this;
    }

    /**
     * Method to set the value of field icon
     *
     * @param integer $icon
     * @return $this
     */
    public function setIcon($icon) {
        $this->icon = $icon;

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
     * Returns the value of field slug
     *
     * @return string
     */
    public function getSlug() {
        return $this->slug;
    }

    /**
     * Returns the value of field department
     *
     * @return integer
     */
    public function getDepartment() {
        return $this->department;
    }

    /**
     * Returns the value of field module
     *
     * @return integer
     */
    public function getModule() {
        return $this->module;
    }

    /**
     * Returns the value of field controller
     *
     * @return integer
     */
    public function getController() {
        return $this->controller;
    }

    /**
     * Returns the value of field action
     *
     * @return integer
     */
    public function getAction() {
        return $this->action;
    }

    /**
     * Returns the value of field category
     *
     * @return integer
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Returns the value of field icon
     *
     * @return integer
     */
    public function getIcon() {
        return $this->icon;
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

        $this->setSchema('NUCLEO');

        $this->belongsTo('department', __NAMESPACE__ . '\Departments', 'id', ['alias' => 'Departments']);
        $this->belongsTo('category', __NAMESPACE__ . '\Categories', 'id', ['alias' => 'Categories']);
        $this->belongsTo('module', __NAMESPACE__ . '\Modules', 'id', ['alias' => 'Modules']);
        $this->belongsTo('controller', __NAMESPACE__ . '\Controllers', 'id', ['alias' => 'Controllers']);
        $this->belongsTo('action', __NAMESPACE__ . '\Actions', 'id', ['alias' => 'Actions']);



        $this->addBehavior(new \Phalcon\Mvc\Model\Behavior\SoftDelete([
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
        return 'MENU';
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public static function columnMap() {
        return array(
            'ID_MENU' => 'id',
            'DS_TITULO' => 'title',
            'DS_SLUG' => 'slug',
            'CD_DEPARTAMENTO' => 'department',
            'CD_MODULO' => 'module',
            'CD_CONTROLADOR' => 'controller',
            'CD_ACAO' => 'action',
            'CD_CATEGORIA' => 'category',
            'DS_ICONE' => 'icon',
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
