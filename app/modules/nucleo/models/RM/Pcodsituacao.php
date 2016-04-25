<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models\RM;

use DevDenners\Models\ModelBase;

class Pcodsituacao extends ModelBase {

    protected $siCodCliente;
    protected $siDescricao;

    public function initialize() {

        parent::initialize();

        $this->setSchema('RM');
        $this->setConnectionService('rmDb');
        $this->setReadConnectionService('rmDb');

        $this->hasMany('siCodCliente', __NAMESPACE__ . '\Pfunc', 'pfCodSituacao', ['alias' => 'Pfunc',]);
    }

    public function getSource() {
        return 'PCODSITUACAO';
    }

    public static function columnMap() {
        return [
            'CODCLIENTE' => 'siCodCliente',
            'DESCRICAO' => 'siDescricao',
        ];
    }

}
