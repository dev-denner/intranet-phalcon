<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models\Protheus;

use SysPhalcon\Models\ModelBase;
use Phalcon\Config as ObjectPhalcon;

class NaturezaFinanceira extends ModelBase {

    public function initialize() {

        parent::initialize();

        $this->setSchema('PRODUCAO_9ZGXI5');
        $this->setConnectionService('protheusDb');
        $this->setReadConnectionService('protheusDb');
    }

    public function getSource() {
        return 'SED010';
    }

    public static function columnMap() {
        return [];
    }

    public function getNaturezaFinanceira($search) {

        $connection = $this->customConnection();

        if (!empty($search)) {
            $search = "AND (CODIGO LIKE '%{$search}%'
                       OR DESCRICAO LIKE '%{$search}%'
                       OR TIPO LIKE '%{$search}%'
                       OR USO LIKE '%{$search}%')";
        }

        $query = "
            SELECT * FROM(
            SELECT TRIM(SED.ED_CODIGO) CODIGO,
                   TRIM(SED.ED_DESCRIC) DESCRICAO,
                   DECODE(TRIM(SED.ED_TIPO), '1', 'SINTETICO', '2', 'ANALITICO', NULL, SED.ED_TIPO) TIPO,
                   DECODE(TRIM(SED.ED_USO), '0', 'LIVRE', '1', 'CONTAS A RECEBER', '2','CONTAS A PAGAR', '3', 'MOV. BANCARIO', NULL, SED.ED_USO) USO,
                   DECODE(SED.ED_CALCIRF, 'S', 'SIM', 'N', 'NAO') CALCULA_IRRF,
                   DECODE(SED.ED_CALCISS, 'S', 'SIM', 'N', 'NAO') CALCULA_ISS,
                   DECODE(SED.ED_CALCINS, 'S', 'SIM', 'N', 'NAO') CALCULA_INSS,
                   DECODE(SED.ED_CALCCSL, 'S', 'SIM', 'N', 'NAO') CALCULA_CSLL,
                   DECODE(SED.ED_CALCPIS, 'S', 'SIM', 'N', 'NAO') CALCULA_PIS,
                   DECODE(SED.ED_CALCCOF, 'S', 'SIM', 'N', 'NAO') CALCULA_COFINS,
                   DECODE(SED.ED_MSBLQL, '1', 'SIM', '2', 'NAO', ' ', 'NAO') BLOQUEADO
            FROM {$this->schema}.SED010 SED
            WHERE SED.D_E_L_E_T_ = ' '
            ) WHERE 1 = 1
            {$search}
            ORDER BY CODIGO
";

        $result = $connection->select($query);
        $return = $connection->fetchAll($result);
        $connection->bye();
        return new ObjectPhalcon($return);
    }

}
