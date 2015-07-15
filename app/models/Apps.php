<?php

class Apps extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $ID;

    /**
     *
     * @var string
     */
    protected $CONTROLLER;

    /**
     *
     * @var string
     */
    protected $NAME;

    /**
     *
     * @var integer
     */
    protected $MODULE;

    /**
     *
     * @var string
     */
    protected $SOFTDEL;

    /**
     *
     * @var integer
     */
    protected $USERCREATE;

    /**
     *
     * @var string
     */
    protected $DATECREATE;

    /**
     *
     * @var integer
     */
    protected $USERUPDATE;

    /**
     *
     * @var string
     */
    protected $DATEUPDATE;

    /**
     * Method to set the value of field ID
     *
     * @param integer $ID
     * @return $this
     */
    public function setID($ID)
    {
        $this->ID = $ID;

        return $this;
    }

    /**
     * Method to set the value of field CONTROLLER
     *
     * @param string $CONTROLLER
     * @return $this
     */
    public function setControlleR($CONTROLLER)
    {
        $this->CONTROLLER = $CONTROLLER;

        return $this;
    }

    /**
     * Method to set the value of field NAME
     *
     * @param string $NAME
     * @return $this
     */
    public function setNamE($NAME)
    {
        $this->NAME = $NAME;

        return $this;
    }

    /**
     * Method to set the value of field MODULE
     *
     * @param integer $MODULE
     * @return $this
     */
    public function setModulE($MODULE)
    {
        $this->MODULE = $MODULE;

        return $this;
    }

    /**
     * Method to set the value of field SOFTDEL
     *
     * @param string $SOFTDEL
     * @return $this
     */
    public function setSoftdeL($SOFTDEL)
    {
        $this->SOFTDEL = $SOFTDEL;

        return $this;
    }

    /**
     * Method to set the value of field USERCREATE
     *
     * @param integer $USERCREATE
     * @return $this
     */
    public function setUsercreatE($USERCREATE)
    {
        $this->USERCREATE = $USERCREATE;

        return $this;
    }

    /**
     * Method to set the value of field DATECREATE
     *
     * @param string $DATECREATE
     * @return $this
     */
    public function setDatecreatE($DATECREATE)
    {
        $this->DATECREATE = $DATECREATE;

        return $this;
    }

    /**
     * Method to set the value of field USERUPDATE
     *
     * @param integer $USERUPDATE
     * @return $this
     */
    public function setUserupdatE($USERUPDATE)
    {
        $this->USERUPDATE = $USERUPDATE;

        return $this;
    }

    /**
     * Method to set the value of field DATEUPDATE
     *
     * @param string $DATEUPDATE
     * @return $this
     */
    public function setDateupdatE($DATEUPDATE)
    {
        $this->DATEUPDATE = $DATEUPDATE;

        return $this;
    }

    /**
     * Returns the value of field ID
     *
     * @return integer
     */
    public function getID()
    {
        return $this->ID;
    }

    /**
     * Returns the value of field CONTROLLER
     *
     * @return string
     */
    public function getControlleR()
    {
        return $this->CONTROLLER;
    }

    /**
     * Returns the value of field NAME
     *
     * @return string
     */
    public function getNamE()
    {
        return $this->NAME;
    }

    /**
     * Returns the value of field MODULE
     *
     * @return integer
     */
    public function getModulE()
    {
        return $this->MODULE;
    }

    /**
     * Returns the value of field SOFTDEL
     *
     * @return string
     */
    public function getSoftdeL()
    {
        return $this->SOFTDEL;
    }

    /**
     * Returns the value of field USERCREATE
     *
     * @return integer
     */
    public function getUsercreatE()
    {
        return $this->USERCREATE;
    }

    /**
     * Returns the value of field DATECREATE
     *
     * @return string
     */
    public function getDatecreatE()
    {
        return $this->DATECREATE;
    }

    /**
     * Returns the value of field USERUPDATE
     *
     * @return integer
     */
    public function getUserupdatE()
    {
        return $this->USERUPDATE;
    }

    /**
     * Returns the value of field DATEUPDATE
     *
     * @return string
     */
    public function getDateupdatE()
    {
        return $this->DATEUPDATE;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->hasMany('ID', 'Actions', 'APP', array('alias' => 'Actions'));
        $this->belongsTo('MODULE', 'Modules', 'ID', array('alias' => 'Modules'));
        $this->belongsTo('USERCREATE', 'Users', 'ID', array('alias' => 'Users'));
        $this->belongsTo('USERUPDATE', 'Users', 'ID', array('alias' => 'Users'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Apps[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Apps
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'apps';
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public function columnMap()
    {
        return array(
            'ID' => 'ID',
            'CONTROLLER' => 'CONTROLLER',
            'NAME' => 'NAME',
            'MODULE' => 'MODULE',
            'SOFTDEL' => 'SOFTDEL',
            'USERCREATE' => 'USERCREATE',
            'DATECREATE' => 'DATECREATE',
            'USERUPDATE' => 'USERUPDATE',
            'DATEUPDATE' => 'DATEUPDATE'
        );
    }

}
