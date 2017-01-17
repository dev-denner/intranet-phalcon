<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace App\Modules\Nucleo\Models\RM;

use App\Shared\Models\ModelBase;

class Gfilial extends ModelBase {

    protected $fiCodColigada;
    protected $fiCodFilial;
    protected $fiNomeFantasia;
    protected $fiCgc;
    protected $fiNome;

    public function initialize() {

        parent::initialize();

        $this->setSchema('RM');
        $this->setConnectionService('rmDb');
        $this->setReadConnectionService('rmDb');

        $this->hasMany(['fiCodColigada', 'fiCodFilial'], __NAMESPACE__ . '\Pfunc', ['pfCodColigada', 'pfCodFilial'], ['alias' => 'Pfunc',]);
    }

    public function getSource() {
        return 'GFILIAL';
    }

    public static function columnMap() {
        return [
            'CODCOLIGADA' => 'fiCodColigada',
            'CODFILIAL' => 'fiCodFilial',
            'NOMEFANTASIA' => 'fiNomeFantasia',
            'CGC' => 'fiCgc',
            'NOME' => 'fiNome',
        ];
    }

}
