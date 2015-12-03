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
 * Class Controllers
 * @package Nucleo\Models
 */
class Controllers extends Model
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $title;

    /**
     * @var string
     */
    protected $slug;

    /**
     * @var integer
     */
    protected $module;

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
     * Method to set the value of field title
     *
     * @param string $title
     * @return $this
     */
    public function setTitle($title)
    {
        $this->title = $title;

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
     * Returns the value of field title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
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
     * Returns the value of field module
     *
     * @return integer
     */
    public function getModule()
    {
        return $this->module;
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
        $this->setSource('controllers');
        $this->hasMany('id', 'Nucleo\Models\Actions', 'controller', array('alias' => 'Actions'));
        $this->hasMany('id', 'Nucleo\Models\Profiles', 'controller', array('alias' => 'Profiles'));
        $this->belongsTo('module', 'Nucleo\Models\Modules', 'id', array('alias' => 'Modules'));
    }

    public function getSource()
    {
        return 'controllers';
    }

}
