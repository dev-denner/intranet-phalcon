<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models\RM;

use SysPhalcon\Models\ModelBase;

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

    public function getColigada($search = '') {

        if (!empty($search)) {
            $search = "AND (UPPER(NOMEFANTASIA) LIKE UPPER('%{$search}%')
                         OR UPPER(CGC) LIKE UPPER('%{$search}%'))";
        }

        $query = "SELECT CODCOLIGADA,
                         NOME,
                         CGC
                  FROM RM.GCOLIGADA
                  WHERE CODCOLIGADA <> 0
                    {$search}
                  ORDER BY 1";

        $connection = $this->customSimpleQuery('rmDb');
        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

}
