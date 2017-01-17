<?php

namespace App\Modules\Nucleo\Models\Mysql;

use App\Shared\Models\ModelBase;

/**
 * PasswordChanges
 * Register when a user changes his/her password
 */
class PasswordChanges extends ModelBase {

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
    public $ipAddress;

    /**
     *
     * @var string
     */
    public $userAgent;

    /**
     *
     * @var integer
     */
    public $createdAt;

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate() {
        // Timestamp the confirmaton
        $this->createdAt = time();
    }

    public function initialize() {
        parent::initialize();
        $this->setConnectionService('helpersDb');
    }

}
