<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace App\Modules\Nucleo\Models\RM;

use App\Shared\Models\ModelBase;

class Ptpfunc extends ModelBase {

    protected $tiCodCliente;
    protected $tiDescricao;

    public function initialize() {

        parent::initialize();

        $this->setSchema('RM');
        $this->setConnectionService('rmDb');
        $this->setReadConnectionService('rmDb');

        $this->hasMany('tiCodCliente', __NAMESPACE__ . '\Ptpfunc', 'pfCodTipo', ['alias' => 'Ptpfunc',]);
    }

    public function getSource() {
        return 'PTPFUNC';
    }

    public static function columnMap() {
        return [
            'CODCLIENTE' => 'tiCodCliente',
            'DESCRICAO' => 'tiDescricao',
        ];
    }

}
