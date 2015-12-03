<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
**/
        

namespace Nucleo\Models;

use Phalcon\Mvc\Model;

/**
 * Class Modules
 * @package Nucleo\Models
 */
class Modules extends Model
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
    protected $status;

    /**
     * @var string
     */
    protected $sdel;

    /**
     * @var string
     */
    protected $usercreate;

    /**
     * @var string
     */
    protected $datacreate;

    /**
     * @var string
     */
    protected $userupdate;

    /**
     * @var string
     */
    protected $dataupdate;

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
     * Method to set the value of field sdel
     *
     * @param string $sdel
     * @return $this
     */
    public function setSdel($sdel)
    {
        $this->sdel = $sdel;

        return $this;
    }

    /**
     * Method to set the value of field usercreate
     *
     * @param string $usercreate
     * @return $this
     */
    public function setUsercreate($usercreate)
    {
        $this->usercreate = $usercreate;

        return $this;
    }

    /**
     * Method to set the value of field datacreate
     *
     * @param string $datacreate
     * @return $this
     */
    public function setDatacreate($datacreate)
    {
        $this->datacreate = $datacreate;

        return $this;
    }

    /**
     * Method to set the value of field userupdate
     *
     * @param string $userupdate
     * @return $this
     */
    public function setUserupdate($userupdate)
    {
        $this->userupdate = $userupdate;

        return $this;
    }

    /**
     * Method to set the value of field dataupdate
     *
     * @param string $dataupdate
     * @return $this
     */
    public function setDataupdate($dataupdate)
    {
        $this->dataupdate = $dataupdate;

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
     * Returns the value of field status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Returns the value of field sdel
     *
     * @return string
     */
    public function getSdel()
    {
        return $this->sdel;
    }

    /**
     * Returns the value of field usercreate
     *
     * @return string
     */
    public function getUsercreate()
    {
        return $this->usercreate;
    }

    /**
     * Returns the value of field datacreate
     *
     * @return string
     */
    public function getDatacreate()
    {
        return $this->datacreate;
    }

    /**
     * Returns the value of field userupdate
     *
     * @return string
     */
    public function getUserupdate()
    {
        return $this->userupdate;
    }

    /**
     * Returns the value of field dataupdate
     *
     * @return string
     */
    public function getDataupdate()
    {
        return $this->dataupdate;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('modules');
        $this->hasMany('id', 'Nucleo\Models\Controllers', 'module', array('alias' => 'Controllers'));
        $this->hasMany('id', 'Nucleo\Models\Profiles', 'module', array('alias' => 'Profiles'));
    }

    public function getSource()
    {
        return 'modules';
    }

}
