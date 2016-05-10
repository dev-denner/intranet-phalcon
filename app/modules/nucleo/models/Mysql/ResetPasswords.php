<?php

namespace Nucleo\Models\Mysql;

use SysPhalcon\Models\ModelBase;

/**
 * ResetPasswords
 * Stores the reset password codes and their evolution
 */
class ResetPasswords extends ModelBase {

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
     * @var string
     */
    public $reset;

    /**
     * Before create the user assign a password
     */
    public function beforeValidationOnCreate() {
        // Timestamp the confirmaton
        $this->createdAt = time();

        // Generate a random confirmation code
        $this->code = preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(24)));

        // Set status to non-confirmed
        $this->reset = 'N';
    }

    /**
     * Sets the timestamp before update the confirmation
     */
    public function beforeValidationOnUpdate() {
        // Timestamp the confirmaton
        $this->modifiedAt = time();
    }

    /**
     * Send an e-mail to users allowing him/her to reset his/her password
     */
    public function afterCreate() {

        $user = \Nucleo\Models\Users::findFirst([
                    'userName = ?0',
                    'bind' => [$this->usersName]
        ]);

        $mail = $this->getDI()
                ->getMail()
                ->send([$user->email => $user->name], 'Redefinição de senha da Intranet do Grupo MPE', 'reset', ['resetUrl' => 'reset-password/' . $this->code . '/' . $user->email, 'nameUser' => $user->name]);

        if ($mail != true) {
            throw new \Exception($msg);
        }
    }

    public function initialize() {
        parent::initialize();
        $this->setConnectionService('helpersDb');
    }

}
