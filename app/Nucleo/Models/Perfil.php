<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       30/06/2015 04:48:50
 *
 */
        

namespace Nucleo\Models;

use Phalcon\Mvc\Model;

/**
 * Class Perfil
 * @package Nucleo\Models
 */
class Perfil extends Model
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $status;

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
     * Method to set the value of field description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Method to set the value of field status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

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
     * Returns the value of field description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the value of field status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
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
        $this->setSource('perfil');
        $this->hasMany('id', 'Nucleo\Models\Access', 'perfil', array('alias' => 'Access'));
        $this->belongsTo('usercreate', 'Nucleo\Models\Users', 'id', array('alias' => 'Users'));
        $this->belongsTo('userupdate', 'Nucleo\Models\Users', 'id', array('alias' => 'Users'));
    }

    public function getSource()
    {
        return 'perfil';
    }

}
