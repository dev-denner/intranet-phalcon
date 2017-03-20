<?php

/**
 * @copyright   2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Forms\Models;

use App\Shared\Models\ModelBase;
use App\Shared\Models\beforeCreate;
use App\Shared\Models\beforeUpdate;

class Form extends ModelBase
{

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
    protected $name;

    /**
     *
     * @var string
     */
    protected $desc;

    /**
     *
     * @var string
     */
    protected $typeReturn;

    /**
     *
     * @var string
     */
    protected $return;

    /**
     *
     * @var string
     */
    protected $view;

    /**
     *
     * @var string
     */
    protected $status;

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
    public function getId()
    {
        return $this->id;
    }

    /**
     *
     * @return type
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     *
     * @return type
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     *
     * @return type
     */
    public function getTypeReturn()
    {
        return $this->typeReturn;
    }

    /**
     *
     * @return type
     */
    public function getReturn()
    {
        return $this->return;
    }

    /**
     *
     * @return type
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     *
     * @return type
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     *
     * @return type
     */
    public function getSdel()
    {
        return $this->sdel;
    }

    /**
     *
     * @return type
     */
    public function getCreateBy()
    {
        return $this->createBy;
    }

    /**
     *
     * @return type
     */
    public function getCreateIn()
    {
        return $this->createIn;
    }

    /**
     *
     * @return type
     */
    public function getUpdateBy()
    {
        return $this->updateBy;
    }

    /**
     *
     * @return type
     */
    public function getUpdateIn()
    {
        return $this->updateIn;
    }

    /**
     *
     * @param type $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     *
     * @param type $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     *
     * @param type $desc
     * @return $this
     */
    public function setDesc($desc)
    {
        $this->desc = $desc;
        return $this;
    }

    /**
     *
     * @param type $typeReturn
     * @return $this
     */
    public function setTypeReturn($typeReturn)
    {
        $this->typeReturn = $typeReturn;
        return $this;
    }

    /**
     *
     * @param type $return
     * @return $this
     */
    public function setReturn($return)
    {
        $this->return = $return;
        return $this;
    }

    /**
     *
     * @param type $view
     * @return $this
     */
    public function setView($view)
    {
        $this->view = $view;
        return $this;
    }

    /**
     *
     * @param type $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    /**
     *
     * @param type $sdel
     * @return $this
     */
    public function setSdel($sdel)
    {
        $this->sdel = $sdel;
        return $this;
    }

    /**
     *
     * @param type $createBy
     * @return $this
     */
    public function setCreateBy($createBy)
    {
        $this->createBy = $createBy;
        return $this;
    }

    /**
     *
     * @param type $createIn
     * @return $this
     */
    public function setCreateIn($createIn)
    {
        $this->createIn = $createIn;
        return $this;
    }

    /**
     *
     * @param type $updateBy
     * @return $this
     */
    public function setUpdateBy($updateBy)
    {
        $this->updateBy = $updateBy;
        return $this;
    }

    /**
     *
     * @param type $updateIn
     * @return $this
     */
    public function setUpdateIn($updateIn)
    {
        $this->updateIn = $updateIn;
        return $this;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {

        parent::initialize();

        $this->hasMany('id', __NAMESPACE__ . '\FormTab', 'form', ['alias' => 'FormTab']);
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
    public function getSource()
    {
        return 'F_FORMULARIO';
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public static function columnMap()
    {
        return array(
            'ID_F_FORMULARIO' => 'id',
            'NM_NOME' => 'name',
            'DS_DESCRICAO' => 'desc',
            'CD_TIPO_RETORNO' => 'typeReturn',
            'DS_RETORNO' => 'return',
            'DS_VIEW' => 'view',
            'ST_STATUS' => 'status',
            'SDEL' => 'sdel',
            'CREATEBY' => 'createBy',
            'CREATEIN' => 'createIn',
            'UPDATEBY' => 'updateBy',
            'UPDATEIN' => 'updateIn'
        );
    }

    public static function getDeleted()
    {
        return 'sdel';
    }

}
