<?php

namespace SysPhalcon\Models;

use Phalcon\Db\RawValue;

trait beforeUpdate {

    public function beforeUpdate() {

        $this->updateBy = $this->getDI()->getSession()->get('auth-identity')['userInfo']['userName'];
        $this->updateIn = new RawValue('SYSDATE');
        $this->skipAttributesOnUpdate(['createBy', 'createIn']);
    }

}
