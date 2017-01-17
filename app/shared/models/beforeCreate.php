<?php

namespace App\Shared\Models;

use Phalcon\Db\RawValue;

trait beforeCreate {

    public function beforeCreate() {
        $this->createBy = $this->getDI()->getSession()->get('auth-identity')['userInfo']['userName'];
        $this->createIn = new RawValue('SYSDATE');
        $this->skipAttributesOnCreate(['updateBy', 'updateIn']);
    }

}
