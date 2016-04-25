<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models;

use DevDenners\Models\ModelBase;
use Phalcon\Db\RawValue;

class ResetPasswords extends ModelBase {

    public $id;
    public $usersId;
    public $code;
    public $createIn;
    public $updateIn;
    public $reset;

    public function beforeValidationOnCreate() {

        $this->createIn = new RawValue('SYSDATE');
        $this->code = preg_replace('/[^a-zA-Z0-9]/', '', base64_encode(openssl_random_pseudo_bytes(24)));
        $this->reset = 'N';
    }

    public function beforeValidationOnUpdate() {
        $this->updateIn = new RawValue('SYSDATE');
    }

    public function afterCreate() {

        $mail = $this->getDI()
                ->getMail()
                ->send([$this->user->email => $this->user->name], 'Redefinir sua senha', 'reset', ['resetUrl' => 'reset-password/' . $this->code . '/' . $this->user->email]);

        if ($mail != true) {
            throw new \Exception($msg);
        }
    }

    public function initialize() {
        $this->belongsTo('usersId', __NAMESPACE__ . '\Users', 'id', array(
            'alias' => 'user'
        ));
    }

    public function getSource() {
        return 'RESET_SENHA';
    }

    public static function columnMap() {
        return [
            'ID_RESET_SENHA' => 'id',
            'CD_USUARIO' => 'usersId',
            'CD_CODIGO' => 'code',
            'FL_RESET' => 'reset',
            'CREATEIN' => 'createIn',
            'UPDATEIN' => 'updateIn',
        ];
    }

}
