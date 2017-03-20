<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace App\Modules\Nucleo\Models\RM;

use App\Shared\Models\ModelBase;
use Phalcon\Config as ObjectPhalcon;

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

    public function getSecao($search) {

        $connection = $this->customSimpleQuery('rmDb');

        if (!empty($search)) {
            $search = "AND (UPPER(GC.NOMEFANTASIA) LIKE UPPER('%{$search}%')
                OR UPPER(GF.NOMEFANTASIA) LIKE UPPER('%{$search}%')
                OR TO_CHAR(PS.CODCOLIGADA, '00') LIKE '%{$search}%'
                OR TO_CHAR(PS.CODFILIAL, '00') LIKE '%{$search}%'
                OR PS.CODIGO LIKE '%{$search}%'
                OR UPPER(PS.DESCRICAO) LIKE UPPER('%{$search}%'))";
        }

        $query = "
            SELECT TO_CHAR(PS.CODCOLIGADA, '00') || ' - ' || GC.NOMEFANTASIA EMPRESA,
                   TO_CHAR(PS.CODFILIAL, '00') || ' - ' || GF.NOMEFANTASIA FILIAL,
                   PS.CODIGO,
                   PS.DESCRICAO
            FROM {$this->schema}.PSECAO PS
            INNER JOIN {$this->schema}.GCOLIGADA GC
              ON GC.CODCOLIGADA = PS.CODCOLIGADA
            INNER JOIN {$this->schema}.GFILIAL GF
              ON GF.CODCOLIGADA = PS.CODCOLIGADA
              AND GF.CODFILIAL = PS.CODFILIAL
            WHERE 1 = 1 {$search}
            ORDER BY PS.CODIGO, PS.CODCOLIGADA";

        return new ObjectPhalcon($connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC));
    }

}
