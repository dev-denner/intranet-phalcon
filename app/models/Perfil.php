<?php

class Perfil extends \Phalcon\Mvc\Model
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
    protected $DESCRIPTION;

    /**
     *
     * @var string
     */
    protected $STATUS;

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
     * Method to set the value of field DESCRIPTION
     *
     * @param string $DESCRIPTION
     * @return $this
     */
    public function setDescriptioN($DESCRIPTION)
    {
        $this->DESCRIPTION = $DESCRIPTION;

        return $this;
    }

    /**
     * Method to set the value of field STATUS
     *
     * @param string $STATUS
     * @return $this
     */
    public function setStatuS($STATUS)
    {
        $this->STATUS = $STATUS;

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
     * Returns the value of field DESCRIPTION
     *
     * @return string
     */
    public function getDescriptioN()
    {
        return $this->DESCRIPTION;
    }

    /**
     * Returns the value of field STATUS
     *
     * @return string
     */
    public function getStatuS()
    {
        return $this->STATUS;
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
        $this->hasMany('ID', 'Acesso', 'PERFIL', array('alias' => 'Acesso'));
        $this->belongsTo('USERCREATE', 'Users', 'ID', array('alias' => 'Users'));
        $this->belongsTo('USERUPDATE', 'Users', 'ID', array('alias' => 'Users'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Perfil[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Perfil
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
        return 'perfil';
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
            'DESCRIPTION' => 'DESCRIPTION',
            'STATUS' => 'STATUS',
            'SOFTDEL' => 'SOFTDEL',
            'USERCREATE' => 'USERCREATE',
            'DATECREATE' => 'DATECREATE',
            'USERUPDATE' => 'USERUPDATE',
            'DATEUPDATE' => 'DATEUPDATE'
        );
    }

}
