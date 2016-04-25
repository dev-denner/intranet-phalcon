<?php

/**
 * @copyright   2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Models;

use DevDenners\Models\ModelBase;
use DevDenners\Models\beforeCreate;
use DevDenners\Models\beforeUpdate;

class UsersGroups extends ModelBase {

    use beforeCreate;

use beforeUpdate;

    /**
     *
     * @var integer
     */
    protected $id;

    /**
     *
     * @var integer
     */
    protected $userId;

    /**
     *
     * @var integer
     */
    protected $groupId;

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
     * Method to set the value of field userId
     *
     * @param integer $userId
     * @return $this
     */
    public function setUserId($userId) {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Method to set the value of field groupId
     *
     * @param integer $groupId
     * @return $this
     */
    public function setGroupId($groupId) {
        $this->groupId = $groupId;

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
     * Returns the value of field userId
     *
     * @return integer
     */
    public function getUserId() {
        return $this->userId;
    }

    /**
     * Returns the value of field groupId
     *
     * @return integer
     */
    public function getGroupId() {
        return $this->groupId;
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
        $this->belongsTo('groupId', __NAMESPACE__ . '\Groups', 'id', ['alias' => 'Groups']);
        $this->belongsTo('userId', __NAMESPACE__ . '\Users', 'id', ['alias' => 'Users']);

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
        return 'USUARIO_GRUPO';
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public static function columnMap() {
        return array(
            'ID_USUARIO_GRUPO' => 'id',
            'CD_USUARIO' => 'userId',
            'CD_GRUPO' => 'groupId',
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
