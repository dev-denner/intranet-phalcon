<?php

use \Phalcon\Mvc\Model\Validator\Email;
use \Phalcon\Mvc\Model\Behavior\SoftDelete;
use Phalcon\Mvc\Model\Behavior\Timestampable;

class Users extends \Phalcon\Mvc\Model {

  /**
   *
   * @var integer
   */
  protected $ID;

  /**
   *
   * @var string
   */
  protected $CPF;

  /**
   *
   * @var string
   */
  protected $PASSWORD;

  /**
   *
   * @var string
   */
  protected $EMAIL;

  /**
   *
   * @var string
   */
  protected $NAME;

  /**
   *
   * @var string
   */
  protected $STATUS;

  /**
   *
   * @var string
   */
  protected $TOKEN;

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
  public function setID($ID) {
    $this->ID = $ID;

    return $this;
  }

  /**
   * Method to set the value of field CPF
   *
   * @param string $CPF
   * @return $this
   */
  public function setCpF($CPF) {
    $this->CPF = $CPF;

    return $this;
  }

  /**
   * Method to set the value of field PASSWORD
   *
   * @param string $PASSWORD
   * @return $this
   */
  public function setPassworD($PASSWORD) {
    $this->PASSWORD = $PASSWORD;

    return $this;
  }

  /**
   * Method to set the value of field EMAIL
   *
   * @param string $EMAIL
   * @return $this
   */
  public function setEmaiL($EMAIL) {
    $this->EMAIL = $EMAIL;

    return $this;
  }

  /**
   * Method to set the value of field NAME
   *
   * @param string $NAME
   * @return $this
   */
  public function setNamE($NAME) {
    $this->NAME = $NAME;

    return $this;
  }

  /**
   * Method to set the value of field STATUS
   *
   * @param string $STATUS
   * @return $this
   */
  public function setStatuS($STATUS) {
    $this->STATUS = $STATUS;

    return $this;
  }

  /**
   * Method to set the value of field TOKEN
   *
   * @param string $TOKEN
   * @return $this
   */
  public function setTokeN($TOKEN) {
    $this->TOKEN = $TOKEN;

    return $this;
  }

  /**
   * Method to set the value of field SOFTDEL
   *
   * @param string $SOFTDEL
   * @return $this
   */
  public function setSoftdeL($SOFTDEL) {
    $this->SOFTDEL = $SOFTDEL;

    return $this;
  }

  /**
   * Method to set the value of field USERCREATE
   *
   * @param integer $USERCREATE
   * @return $this
   */
  public function setUsercreatE($USERCREATE) {
    $this->USERCREATE = $USERCREATE;

    return $this;
  }

  /**
   * Method to set the value of field DATECREATE
   *
   * @param string $DATECREATE
   * @return $this
   */
  public function setDatecreatE($DATECREATE) {
    $this->DATECREATE = $DATECREATE;

    return $this;
  }

  /**
   * Method to set the value of field USERUPDATE
   *
   * @param integer $USERUPDATE
   * @return $this
   */
  public function setUserupdatE($USERUPDATE) {
    $this->USERUPDATE = $USERUPDATE;

    return $this;
  }

  /**
   * Method to set the value of field DATEUPDATE
   *
   * @param string $DATEUPDATE
   * @return $this
   */
  public function setDateupdatE($DATEUPDATE) {
    $this->DATEUPDATE = $DATEUPDATE;

    return $this;
  }

  /**
   * Returns the value of field ID
   *
   * @return integer
   */
  public function getID() {
    return $this->ID;
  }

  /**
   * Returns the value of field CPF
   *
   * @return string
   */
  public function getCpF() {
    return $this->CPF;
  }

  /**
   * Returns the value of field PASSWORD
   *
   * @return string
   */
  public function getPassworD() {
    return $this->PASSWORD;
  }

  /**
   * Returns the value of field EMAIL
   *
   * @return string
   */
  public function getEmaiL() {
    return $this->EMAIL;
  }

  /**
   * Returns the value of field NAME
   *
   * @return string
   */
  public function getNamE() {
    return $this->NAME;
  }

  /**
   * Returns the value of field STATUS
   *
   * @return string
   */
  public function getStatuS() {
    return $this->STATUS;
  }

  /**
   * Returns the value of field TOKEN
   *
   * @return string
   */
  public function getTokeN() {
    return $this->TOKEN;
  }

  /**
   * Returns the value of field SOFTDEL
   *
   * @return string
   */
  public function getSoftdeL() {
    return $this->SOFTDEL;
  }

  /**
   * Returns the value of field USERCREATE
   *
   * @return integer
   */
  public function getUsercreatE() {
    return $this->USERCREATE;
  }

  /**
   * Returns the value of field DATECREATE
   *
   * @return string
   */
  public function getDatecreatE() {
    return $this->DATECREATE;
  }

  /**
   * Returns the value of field USERUPDATE
   *
   * @return integer
   */
  public function getUserupdatE() {
    return $this->USERUPDATE;
  }

  /**
   * Returns the value of field DATEUPDATE
   *
   * @return string
   */
  public function getDateupdatE() {
    return $this->DATEUPDATE;
  }

  /**
   * Validations and business logic
   */
  public function validation() {

    $this->validate(
            new Email(
            array(
        'field' => 'EMAIL',
        'required' => true,
            )
            )
    );
    if ($this->validationHasFailed() == true) {
      return false;
    }
  }

  /**
   * Initialize method for model.
   */
  public function initialize() {

    $config = $this->di->get('config');

    $this->hasMany('ID', 'Acesso', 'USERCREATE', array('alias' => 'Acesso'));
    $this->hasMany('ID', 'Acesso', 'USERUPDATE', array('alias' => 'Acesso'));
    $this->hasMany('ID', 'Actions', 'USERCREATE', array('alias' => 'Actions'));
    $this->hasMany('ID', 'Actions', 'USERUPDATE', array('alias' => 'Actions'));
    $this->hasMany('ID', 'Apps', 'USERCREATE', array('alias' => 'Apps'));
    $this->hasMany('ID', 'Apps', 'USERUPDATE', array('alias' => 'Apps'));
    $this->hasMany('ID', 'Modules', 'USERCREATE', array('alias' => 'Modules'));
    $this->hasMany('ID', 'Modules', 'USERUPDATE', array('alias' => 'Modules'));
    $this->hasMany('ID', 'Perfil', 'USERCREATE', array('alias' => 'Perfil'));
    $this->hasMany('ID', 'Perfil', 'USERUPDATE', array('alias' => 'Perfil'));
    $this->hasMany('ID', 'Users', 'USERCREATE', array('alias' => 'Users'));
    $this->hasMany('ID', 'Users', 'USERUPDATE', array('alias' => 'Users'));
    $this->belongsTo('USERCREATE', 'Users', 'ID', array('alias' => 'Users'));
    $this->belongsTo('USERUPDATE', 'Users', 'ID', array('alias' => 'Users'));

    $this->skipAttributes(array('ID', 'SOFTDEL', 'USERCREATE', 'DATECREATE', 'USERUPDATE', 'DATEUPDATE'));

    $this->addBehavior(new SoftDelete([
        'field' => 'SOFTDEL',
        'value' => '*'
    ]));

    $this->addBehavior(new Timestampable(array(
        'beforeCreate' => array(
            'field' => 'DATECREATE',
            'format' => function() {
              $datetime = new Datetime(new DateTimeZone('America/Sao_Paulo'));
              return $datetime->format('Y-m-d H:i:sP');
            }
        ),
        'beforeUpdate' => array(
            'field' => 'DATEUPDATE',
            'format' => 'Y-m-d H:i:sP'
        )
            )
    ));
  }

  /**
   * Allows to query a set of records that match the specified conditions
   *
   * @param mixed $parameters
   * @return Users[]
   */
  public static function find($parameters = null) {
    return parent::find($parameters);
  }

  /**
   * Allows to query the first record that match the specified conditions
   *
   * @param mixed $parameters
   * @return Users
   */
  public static function findFirst($parameters = null) {
    return parent::findFirst($parameters);
  }

  /**
   * Returns table name mapped in the model.
   *
   * @return string
   */
  public function getSource() {
    return 'users';
  }

  /**
   * Independent Column Mapping.
   * Keys are the real names in the table and the values their names in the application
   *
   * @return array
   */
  public function columnMap() {
    return array(
        'ID' => 'ID',
        'CPF' => 'CPF',
        'PASSWORD' => 'PASSWORD',
        'EMAIL' => 'EMAIL',
        'NAME' => 'NAME',
        'STATUS' => 'STATUS',
        'TOKEN' => 'TOKEN',
        'SOFTDEL' => 'SOFTDEL',
        'USERCREATE' => 'USERCREATE',
        'DATECREATE' => 'DATECREATE',
        'USERUPDATE' => 'USERUPDATE',
        'DATEUPDATE' => 'DATEUPDATE'
    );
  }

}
