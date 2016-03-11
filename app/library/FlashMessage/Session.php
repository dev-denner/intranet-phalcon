<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Session
 *
 * @author denner.fernandes
 */

namespace DevDenners\Library\FlashMessage;

use Phalcon\Flash\Session as FlashSession;

class Session extends FlashSession {

  public function __construct($cssClasses = null) {
    if ($cssClasses === null) {
      $cssClasses = array(
          'success' => 'alert alert-success',
          'notice' => 'alert alert-info',
          'warning' => 'alert alert-warning',
          'error' => 'alert alert-danger',
      );
    }
    parent::__construct($cssClasses);
  }

}
