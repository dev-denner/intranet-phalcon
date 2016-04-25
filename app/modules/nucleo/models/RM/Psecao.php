<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models\RM;

use DevDenners\Models\ModelBase;

class Psecao extends ModelBase {

    protected $psCodColigada;
    protected $psCodigo;
    protected $psDescricao;
    protected $psCentroCusto;

    public function initialize() {

        parent::initialize();

        $this->setSchema('RM');
        $this->setConnectionService('rmDb');
        $this->setReadConnectionService('rmDb');

        $this->hasMany(['psCodColigada', 'psCodigo'], __NAMESPACE__ . '\Pfunc', ['pfCodColigada', 'pfCodSecao'], ['alias' => 'Pfunc',]);
    }

    public function getSource() {
        return 'PSECAO';
    }

    public static function columnMap() {
        return [
            'CODCOLIGADA' => 'psCodColigada',
            'CODIGO' => 'psCodigo',
            'DESCRICAO' => 'psDescricao',
            'NROCENCUSTOCONT' => 'psCentroCusto',
        ];
    }

}
