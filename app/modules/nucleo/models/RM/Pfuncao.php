<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace App\Modules\Nucleo\Models\RM;

use App\Shared\Models\ModelBase;

class Pfuncao extends ModelBase {

    protected $fuCodColigada;
    protected $fuCodigo;
    protected $fuNome;
    protected $fuCargo;
    protected $fuDescricao;

    public function initialize() {

        parent::initialize();

        $this->setSchema('RM');
        $this->setConnectionService('rmDb');
        $this->setReadConnectionService('rmDb');

        $this->hasMany(['fuCodColigada', 'fuCodigo'], __NAMESPACE__ . '\Pfunc', ['pfCodColigada', 'pfCodFuncao'], ['alias' => 'Pfunc',]);
    }

    public function getSource() {
        return 'PFUNCAO';
    }

    public static function columnMap() {
        return [
            'CODCOLIGADA' => 'fuCodColigada',
            'CODIGO' => 'fuCodigo',
            'NOME' => 'fuNome',
            'CARGO' => 'fuCargo',
            'DESCRICAO' => 'fuDescricao',
        ];
    }

}
