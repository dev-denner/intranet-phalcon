<?php

namespace App\Modules\Nucleo\Models\Mysql;

use App\Shared\Models\ModelBase;

/**
 * FailedLogins
 * This model registers unsuccessfull logins registered and non-registered users have made
 */
class Clicks extends ModelBase {

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $usersName;

    /**
     *
     * @var string
     */
    public $uri;

    /**
     *
     * @var date
     */
    public $dataAccess;

    public function initialize() {
        parent::initialize();
        $this->setConnectionService('helpersDb');
    }

}
