<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       30/06/2015 04:48:38
 *
 */
        

namespace Nucleo\Models;

use Phalcon\Mvc\Model;

/**
 * Class Apps
 * @package Nucleo\Models
 */
class Apps extends Model
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $controller;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var integer
     */
    protected $module;

    /**
     * @var string
     */
    protected $delete;

    /**
     * @var integer
     */
    protected $usercreate;

    /**
     * @var string
     */
    protected $datecreate;

    /**
     * @var integer
     */
    protected $userupdate;

    /**
     * @var string
     */
    protected $dateupdate;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field controller
     *
     * @param string $controller
     * @return $this
     */
    public function setController($controller)
    {
        $this->controller = $controller;

        return $this;
    }

    /**
     * Method to set the value of field name
     *
     * @param string $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Method to set the value of field module
     *
     * @param integer $module
     * @return $this
     */
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Method to set the value of field delete
     *
     * @param string $delete
     * @return $this
     */
    public function setDelete($delete)
    {
        $this->delete = $delete;

        return $this;
    }

    /**
     * Method to set the value of field usercreate
     *
     * @param integer $usercreate
     * @return $this
     */
    public function setUsercreate($usercreate)
    {
        $this->usercreate = $usercreate;

        return $this;
    }

    /**
     * Method to set the value of field datecreate
     *
     * @param string $datecreate
     * @return $this
     */
    public function setDatecreate($datecreate)
    {
        $this->datecreate = $datecreate;

        return $this;
    }

    /**
     * Method to set the value of field userupdate
     *
     * @param integer $userupdate
     * @return $this
     */
    public function setUserupdate($userupdate)
    {
        $this->userupdate = $userupdate;

        return $this;
    }

    /**
     * Method to set the value of field dateupdate
     *
     * @param string $dateupdate
     * @return $this
     */
    public function setDateupdate($dateupdate)
    {
        $this->dateupdate = $dateupdate;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field controller
     *
     * @return string
     */
    public function getController()
    {
        return $this->controller;
    }

    /**
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field module
     *
     * @return integer
     */
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Returns the value of field delete
     *
     * @return string
     */
    public function getDelete()
    {
        return $this->delete;
    }

    /**
     * Returns the value of field usercreate
     *
     * @return integer
     */
    public function getUsercreate()
    {
        return $this->usercreate;
    }

    /**
     * Returns the value of field datecreate
     *
     * @return string
     */
    public function getDatecreate()
    {
        return $this->datecreate;
    }

    /**
     * Returns the value of field userupdate
     *
     * @return integer
     */
    public function getUserupdate()
    {
        return $this->userupdate;
    }

    /**
     * Returns the value of field dateupdate
     *
     * @return string
     */
    public function getDateupdate()
    {
        return $this->dateupdate;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('apps');
        $this->hasMany('id', 'Nucleo\Models\Actions', 'app', array('alias' => 'Actions'));
        $this->belongsTo('module', 'Nucleo\Models\Modules', 'id', array('alias' => 'Modules'));
        $this->belongsTo('usercreate', 'Nucleo\Models\Users', 'id', array('alias' => 'Users'));
        $this->belongsTo('userupdate', 'Nucleo\Models\Users', 'id', array('alias' => 'Users'));
    }

    public function getSource()
    {
        return 'apps';
    }

}
