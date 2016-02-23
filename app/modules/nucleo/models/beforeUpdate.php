<?php

namespace Nucleo\Models;

trait beforeUpdate {

  public function beforeUpdate() {
    $this->updateIn = new \Phalcon\Db\RawValue('SYSDATE');
    $this->skipAttributesOnUpdate(
            array('createIn')
    );
  }

}
