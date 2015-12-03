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
 * Class Logins
 * @package Nucleo\Models
 */
class Logins extends Model
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var integer
     */
    protected $user;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $ipaddress;

    /**
     * @var integer
     */
    protected $attempted;

    /**
     * @var string
     */
    protected $userAgent;

    /**
     * @var string
     */
    protected $datacreate;

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
     * Method to set the value of field user
     *
     * @param integer $user
     * @return $this
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Method to set the value of field type
     *
     * @param string $type
     * @return $this
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Method to set the value of field ipaddress
     *
     * @param string $ipaddress
     * @return $this
     */
    public function setIpaddress($ipaddress)
    {
        $this->ipaddress = $ipaddress;

        return $this;
    }

    /**
     * Method to set the value of field attempted
     *
     * @param integer $attempted
     * @return $this
     */
    public function setAttempted($attempted)
    {
        $this->attempted = $attempted;

        return $this;
    }

    /**
     * Method to set the value of field userAgent
     *
     * @param string $userAgent
     * @return $this
     */
    public function setUseragent($userAgent)
    {
        $this->userAgent = $userAgent;

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
     * Returns the value of field user
     *
     * @return integer
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Returns the value of field type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Returns the value of field ipaddress
     *
     * @return string
     */
    public function getIpaddress()
    {
        return $this->ipaddress;
    }

    /**
     * Returns the value of field attempted
     *
     * @return integer
     */
    public function getAttempted()
    {
        return $this->attempted;
    }

    /**
     * Returns the value of field userAgent
     *
     * @return string
     */
    public function getUseragent()
    {
        return $this->userAgent;
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
        $this->setSource('logins');
        $this->belongsTo('user', 'Nucleo\Models\Users', 'id', array('alias' => 'Users'));
    }

    public function getSource()
    {
        return 'logins';
    }

}
