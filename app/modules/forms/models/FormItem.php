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

class FormItem extends ModelBase
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
    protected $section;

    /**
     *
     * @var string
     */
    protected $name;

    /**
     *
     * @var string
     */
    protected $label;

    /**
     *
     * @var string
     */
    protected $placeholder;

    /**
     *
     * @var integer
     */
    protected $position;

    /**
     *
     * @var string
     */
    protected $type;

    /**
     *
     * @var string
     */
    protected $value;

    /**
     *
     * @var string
     */
    protected $linkedToType;

    /**
     *
     * @var string
     */
    protected $linkedToField;

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
    public function getSection()
    {
        return $this->section;
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
    public function getLabel()
    {
        return $this->label;
    }

    /**
     *
     * @return type
     */
    public function getPlaceholder()
    {
        return $this->placeholder;
    }

    /**
     *
     * @return type
     */
    public function getPosition()
    {
        return $this->position;
    }

    /**
     *
     * @return type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     *
     * @return type
     */
    public function getValue()
    {
        return $this->value;
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
     * @return type
     */
    public function getLinkedToType()
    {
        return $this->linkedToType;
    }

    /**
     *
     * @return type
     */
    public function getLinkedToField()
    {
        return $this->linkedToField;
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
     * @param type $section
     * @return $this
     */
    public function setSection($section)
    {
        $this->section = $section;
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
     * @param type $label
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     *
     * @param type $placeholder
     * @return $this
     */
    public function setPlaceholder($placeholder)
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    /**
     *
     * @param type $position
     * @return $this
     */
    public function setPosition($position)
    {
        $this->position = $position;
        return $this;
    }

    /**
     *
     * @param type $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }

    /**
     *
     * @param type $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;
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
     *
     * @param type $linkedToType
     * @return $this
     */
    public function setLinkedToType($linkedToType)
    {
        $this->linkedToType = $linkedToType;
        return $this;
    }

    /**
     *
     * @param type $linkedToField
     * @return $this
     */
    public function setLinkedToField($linkedToField)
    {
        $this->linkedToField = $linkedToField;
        return $this;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {

        parent::initialize();

        $this->belongsTo('section', __NAMESPACE__ . '\FormSection', 'id', ['alias' => 'FormSection']);
        $this->hasMany('id', __NAMESPACE__ . '\FormItemRule', 'formItem', ['alias' => 'FormItemRule']);
        $this->hasMany('id', __NAMESPACE__ . '\FormItemVisual', 'formItem', ['alias' => 'FormItemVisual']);

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
        return 'F_FORMULARIO_ITEM';
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
            'ID_F_FORMULARIO_ITEM' => 'id',
            'CD_F_FORMULARIO_SECAO' => 'section',
            'NM_NOME' => 'name',
            'DS_LABEL' => 'label',
            'DS_PLACEHOLDER' => 'placeholder',
            'NU_POSICAO' => 'position',
            'DS_PASTA' => 'folder',
            'DS_TIPO' => 'type',
            'DS_VALOR' => 'value',
            'CD_VINCULO_TIPO' => 'linkedToType',
            'DS_VINCULO_CAMPO' => 'linkedToField',
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
