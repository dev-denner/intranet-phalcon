<?php

namespace Nucleo\Models;

trait beforeCreate {

  public function beforeCreate() {
    $this->createIn = new \Phalcon\Db\RawValue('SYSDATE');
    $this->skipAttributesOnCreate(
            array('updateIn')
    );
  }

}
