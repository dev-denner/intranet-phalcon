<?php

class Acesso extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     */
    protected $ID;

    /**
     *
     * @var integer
     */
    protected $PERFIL;

    /**
     *
     * @var integer
     */
    protected $ACTION;

    /**
     *
     * @var string
     */
    protected $PERMISSION;

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
     * Method to set the value of field PERFIL
     *
     * @param integer $PERFIL
     * @return $this
     */
    public function setPerfiL($PERFIL)
    {
        $this->PERFIL = $PERFIL;

        return $this;
    }

    /**
     * Method to set the value of field ACTION
     *
     * @param integer $ACTION
     * @return $this
     */
    public function setActioN($ACTION)
    {
        $this->ACTION = $ACTION;

        return $this;
    }

    /**
     * Method to set the value of field PERMISSION
     *
     * @param string $PERMISSION
     * @return $this
     */
    public function setPermissioN($PERMISSION)
    {
        $this->PERMISSION = $PERMISSION;

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
     * Returns the value of field PERFIL
     *
     * @return integer
     */
    public function getPerfiL()
    {
        return $this->PERFIL;
    }

    /**
     * Returns the value of field ACTION
     *
     * @return integer
     */
    public function getActioN()
    {
        return $this->ACTION;
    }

    /**
     * Returns the value of field PERMISSION
     *
     * @return string
     */
    public function getPermissioN()
    {
        return $this->PERMISSION;
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
        $this->belongsTo('ACTION', 'Actions', 'id', array('alias' => 'Actions'));
        $this->belongsTo('PERFIL', 'Perfil', 'ID', array('alias' => 'Perfil'));
        $this->belongsTo('USERCREATE', 'Users', 'ID', array('alias' => 'Users'));
        $this->belongsTo('USERUPDATE', 'Users', 'ID', array('alias' => 'Users'));
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Acesso[]
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Acesso
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
        return 'acesso';
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
            'PERFIL' => 'PERFIL',
            'ACTION' => 'ACTION',
            'PERMISSION' => 'PERMISSION',
            'SOFTDEL' => 'SOFTDEL',
            'USERCREATE' => 'USERCREATE',
            'DATECREATE' => 'DATECREATE',
            'USERUPDATE' => 'USERUPDATE',
            'DATEUPDATE' => 'DATEUPDATE'
        );
    }

}
