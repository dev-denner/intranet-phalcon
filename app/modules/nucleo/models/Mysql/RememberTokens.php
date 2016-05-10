<?php

namespace Nucleo\Models\Mysql;

use SysPhalcon\Models\ModelBase;

/**
 * RememberTokens
 * Stores the remember me tokens
 */
class RememberTokens extends ModelBase {

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
    public $token;

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
