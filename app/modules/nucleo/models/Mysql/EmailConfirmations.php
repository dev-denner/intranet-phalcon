<?php

namespace Nucleo\Models\Mysql;

use SysPhalcon\Models\ModelBase;

/**
 * EmailConfirmations
 * Stores the reset password codes and their evolution
 */
class EmailConfirmations extends ModelBase {

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
     * @var type
     */
    public $code;

    /**
     *
     * @var integer
     */
    public $createdAt;

    /**
     *
     * @var integer
     */
    public $modifiedAt;

    /**
     *
     * @var type
     */
    public $confirmed;

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate() {
        // Timestamp the confirmation
        $this->createdAt = time();

        // Generate a random confirmation code
        $this->code = preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(24)));

        // Set status to non-confirmed
        $this->confirmed = 'N';
    }

    /**
     * Sets the timestamp before update the confirmation
     */
    public function beforeValidationOnUpdate() {
        // Timestamp the confirmation
        $this->modifiedAt = time();
    }

    /**
     * Send a confirmation e-mail to the user after create the account
     */
    public function afterCreate() {
        $this->getDI()
                  ->getMail()
                  ->send(array(
                      $this->user->email => $this->user->name
                            ), "Por favor, confirme seu E-mail", 'confirmation', array(
                      'confirmUrl' => '/confirm/' . $this->code . '/' . $this->user->email
        ));
    }

    public function initialize() {
        parent::initialize();
        $this->setConnectionService('helpersDb');
    }

}
