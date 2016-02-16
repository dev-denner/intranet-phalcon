<?php

/**
 * @copyright   2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Nucleo\Models;

class Notifications extends ModelBase {

  use beforeCreate;

use beforeUpdate;

  /**
   *
   * @var integer
   */
  protected $id;

  /**
   *
   * @var integer
   */
  protected $userId;

  /**
   *
   * @var string
   */
  protected $section;

  /**
   *
   * @var string
   */
  protected $subsection;

  /**
   *
   * @var integer
   */
  protected $recipient;

  /**
   *
   * @var string
   */
  protected $message;

  /**
   *
   * @var string
   */
  protected $redirect;

  /**
   *
   * @var integer
   */
  protected $seen;

  /**
   *
   * @var string
   */
  protected $createIn;

  /**
   *
   * @var string
   */
  protected $updateIn;

  /**
   * Method to set the value of field id
   *
   * @param integer $id
   * @return $this
   */
  public function setId($id) {
    $this->id = $id;

    return $this;
  }

  /**
   * Method to set the value of field userId
   *
   * @param integer $userId
   * @return $this
   */
  public function setUserId($userId) {
    $this->userId = $userId;

    return $this;
  }

  /**
   * Method to set the value of field section
   *
   * @param string $section
   * @return $this
   */
  public function setSection($section) {
    $this->section = $section;

    return $this;
  }

  /**
   * Method to set the value of field subsection
   *
   * @param string $subsection
   * @return $this
   */
  public function setSubsection($subsection) {
    $this->subsection = $subsection;

    return $this;
  }

  /**
   * Method to set the value of field recipient
   *
   * @param integer $recipient
   * @return $this
   */
  public function setRecipient($recipient) {
    $this->recipient = $recipient;

    return $this;
  }

  /**
   * Method to set the value of field message
   *
   * @param string $message
   * @return $this
   */
  public function setMessage($message) {
    $this->message = $message;

    return $this;
  }

  /**
   * Method to set the value of field redirect
   *
   * @param string $redirect
   * @return $this
   */
  public function setRedirect($redirect) {
    $this->redirect = $redirect;

    return $this;
  }

  /**
   * Method to set the value of field seen
   *
   * @param integer $seen
   * @return $this
   */
  public function setSeen($seen) {
    $this->seen = $seen;

    return $this;
  }

  /**
   * Method to set the value of field createIn
   *
   * @param string $createIn
   * @return $this
   */
  public function setCreateIn($createIn) {
    $this->createIn = $createIn;

    return $this;
  }

  /**
   * Method to set the value of field updateIn
   *
   * @param string $updateIn
   * @return $this
   */
  public function setUpdateIn($updateIn) {
    $this->updateIn = $updateIn;

    return $this;
  }

  /**
   * Returns the value of field id
   *
   * @return integer
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Returns the value of field userId
   *
   * @return integer
   */
  public function getUserId() {
    return $this->userId;
  }

  /**
   * Returns the value of field section
   *
   * @return string
   */
  public function getSection() {
    return $this->section;
  }

  /**
   * Returns the value of field subsection
   *
   * @return string
   */
  public function getSubsection() {
    return $this->subsection;
  }

  /**
   * Returns the value of field recipient
   *
   * @return integer
   */
  public function getRecipient() {
    return $this->recipient;
  }

  /**
   * Returns the value of field message
   *
   * @return string
   */
  public function getMessage() {
    return $this->message;
  }

  /**
   * Returns the value of field redirect
   *
   * @return string
   */
  public function getRedirect() {
    return $this->redirect;
  }

  /**
   * Returns the value of field seen
   *
   * @return integer
   */
  public function getSeen() {
    return $this->seen;
  }

  /**
   * Returns the value of field createIn
   *
   * @return string
   */
  public function getCreateIn() {
    return $this->createIn;
  }

  /**
   * Returns the value of field updateIn
   *
   * @return string
   */
  public function getUpdateIn() {
    return $this->updateIn;
  }

  /**
   * Initialize method for model.
   */
  public function initialize() {
    $this->belongsTo('userId', 'Nucleo\Models\Users', 'id', array('alias' => 'Users'));
  }

  /**
   * Returns table name mapped in the model.
   *
   * @return string
   */
  public function getSource() {
    return 'notifications';
  }

  /**
   * Independent Column Mapping.
   * Keys are the real names in the table and the values their names in the application
   *
   * @return array
   */
  public function columnMap() {
    return array(
        'id' => 'id',
        'userId' => 'userId',
        'section' => 'section',
        'subsection' => 'subsection',
        'recipient' => 'recipient',
        'message' => 'message',
        'redirect' => 'redirect',
        'seen' => 'seen',
        'createIn' => 'createIn',
        'updateIn' => 'updateIn'
    );
  }

}
