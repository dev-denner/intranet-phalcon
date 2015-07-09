<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       30/06/2015 04:48:44
 *
 */
        

namespace Nucleo\Models;

use Phalcon\Mvc\Model;

/**
 * Class Actions
 * @package Nucleo\Models
 */
class Actions extends Model
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var integer
     */
    protected $app;

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
     * Method to set the value of field slug
     *
     * @param string $slug
     * @return $this
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Method to set the value of field app
     *
     * @param integer $app
     * @return $this
     */
    public function setApp($app)
    {
        $this->app = $app;

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
     * Returns the value of field name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Returns the value of field slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Returns the value of field app
     *
     * @return integer
     */
    public function getApp()
    {
        return $this->app;
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
        $this->setSource('actions');
        $this->hasMany('id', 'Nucleo\Models\Access', 'action', array('alias' => 'Access'));
        $this->belongsTo('app', 'Nucleo\Models\Apps', 'id', array('alias' => 'Apps'));
        $this->belongsTo('usercreate', 'Nucleo\Models\Users', 'id', array('alias' => 'Users'));
        $this->belongsTo('userupdate', 'Nucleo\Models\Users', 'id', array('alias' => 'Users'));
    }

    public function getSource()
    {
        return 'actions';
    }

}
