<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DevDenners\Library\FlashMessage;

/**
 * Description of Closable
 *
 * @author denner.fernandes
 */
class Closable extends \DevDenners\Library\FlashMessage\Session {

  public function __construct($cssClasses = null) {
    if (is_array($cssClasses)) {
      $cssClasses = array_map(function ($cssClass) {
        return $cssClass . ' fade in';
      }, $cssClasses);
    }
    parent::__construct($cssClasses);
  }

  public function message($type, $message) {
    $button = '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
    parent::message($type, $button . $message);
  }

}
