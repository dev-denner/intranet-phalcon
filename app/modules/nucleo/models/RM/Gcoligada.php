<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models\RM;

use DevDenners\Models\ModelBase;

class Gcoligada extends ModelBase {

    protected $clCodColigada;
    protected $clNomeFantasia;
    protected $clCgc;

    public function initialize() {

        parent::initialize();

        $this->setSchema('RM');
        $this->setConnectionService('rmDb');
        $this->setReadConnectionService('rmDb');

        $this->hasMany('clCodColigada', __NAMESPACE__ . '\Pfunc', 'pfCodColigada', ['alias' => 'Pfunc',]);
    }

    public function getSource() {
        return 'GCOLIGADA';
    }

    public static function columnMap() {
        return [
            'CODCOLIGADA' => 'clCodColigada',
            'NOMEFANTASIA' => 'clNomeFantasia',
            'CGC' => 'clCgc',
        ];
    }

}
