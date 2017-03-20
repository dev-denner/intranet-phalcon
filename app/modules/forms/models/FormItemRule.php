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

class FormItemRule extends ModelBase
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
     * @var integer
     */
    protected $formItem;

    /**
     *
     * @var string
     */
    protected $event;

    /**
     *
     * @var string
     */
    protected $rule;

    /**
     *
     * @var string
     */
    protected $message;

    /**
     *
     * @var integer
     */
    protected $callback;

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
    public function getFormItem()
    {
        return $this->formItem;
    }

    /**
     *
     * @return type
     */
    public function getEvents()
    {
        return $this->event;
    }

    /**
     *
     * @return type
     */
    public function getRule()
    {
        return $this->rule;
    }

    /**
     *
     * @return type
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     *
     * @return type
     */
    public function getCallback()
    {
        return $this->callback;
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
     * @param type $formItem
     * @return $this
     */
    public function setFormItem($formItem)
    {
        $this->formItem = $formItem;
        return $this;
    }

    /**
     *
     * @param type $event
     * @return $this
     */
    public function setEvents($event)
    {
        $this->event = $event;
        return $this;
    }

    /**
     *
     * @param type $rule
     * @return $this
     */
    public function setRule($rule)
    {
        $this->rule = $rule;
        return $this;
    }

    /**
     *
     * @param type $message
     * @return $this
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     *
     * @param type $callback
     * @return $this
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
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

        $this->belongsTo('formItem', __NAMESPACE__ . '\FormItem', 'id', ['alias' => 'FormItem']);

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
        return 'F_FORMULARIO_IT_REGRA';
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
            'ID_F_FORMULARIO_IT_REGRA' => 'id',
            'CD_F_FORMULARIO_ITEM' => 'formItem',
            'DS_EVENTO' => 'event',
            'DS_REGRA' => 'rule',
            'DS_MENSAGEM' => 'message',
            'DS_CALLBACK' => 'callback',
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
