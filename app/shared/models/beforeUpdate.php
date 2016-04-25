<?php

namespace DevDenners\Models;

use Phalcon\Db\RawValue;

trait beforeUpdate {

    public function beforeUpdate() {
        $this->updateBy = $this->getDI()->getSession()->get('auth-identity')->userName;
        $this->updateIn = new RawValue('SYSDATE');
        $this->skipAttributesOnUpdate(['createBy', 'createIn']);
    }

}
