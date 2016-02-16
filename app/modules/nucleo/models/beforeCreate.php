<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Nucleo\Models;

trait beforeCreate {

  public function beforeCreate() {
    $this->createIn = new \Phalcon\Db\RawValue('SYSDATE');
    $this->skipAttributesOnCreate(
            array('updateIn')
    );
  }

}
