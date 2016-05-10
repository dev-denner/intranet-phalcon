<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models\RM;

use SysPhalcon\Models\ModelBase;

class Ppessoa extends ModelBase {

    protected $ppCodigo;
    protected $ppNome;
    protected $ppEstadoCivil;
    protected $ppSexo;
    protected $ppCpf;
    protected $ppEmail;
    protected $ppDataNascimento;

    public function initialize() {

        parent::initialize();

        $this->setSchema('RM');
        $this->setConnectionService('rmDb');
        $this->setReadConnectionService('rmDb');

        $this->hasMany('ppCodigo', __NAMESPACE__ . '\Pfunc', 'pfCodPessoa', ['alias' => 'Pfunc',]);
    }

    public function getSource() {
        return 'PPESSOA';
    }

    public static function columnMap() {
        return [
            'CODIGO' => 'ppCodigo',
            'NOME' => 'ppNome',
            'ESTADOCIVIL' => 'ppEstadoCivil',
            'SEXO' => 'ppSexo',
            'CPF' => 'ppCpf',
            'EMAIL' => 'ppEmail',
            'DTNASCIMENTO' => 'ppDataNascimento',
        ];
    }

}
