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

class Tes extends ModelBase {

    public function initialize() {

        parent::initialize();

        $this->setSchema('PRODUCAO_9ZGXI5');
        $this->setConnectionService('protheusDb');
        $this->setReadConnectionService('protheusDb');
    }

    public function getSource() {
        return 'SF4010';
    }

    public static function columnMap() {
        return [];
    }

    public function getTes($search) {

        $connection = $this->customConnection();

        if (!empty($search)) {
            $search = "AND (SF4.F4_CODIGO LIKE '%{$search}%'
                OR SF4.F4_CF LIKE '%{$search}%'
                OR SF4.F4_TEXTO LIKE '%{$search}%'
                OR SF4.F4_FINALID LIKE '%{$search}%')";
        }

        $query = "
            SELECT TRIM(SF4.F4_CODIGO) CODIGO,
                   DECODE(SF4.F4_TIPO,'E','ENTRADA','S','SAIDA') TIPO,
                   TRIM(SF4.F4_CF) CODIGO_FISCAL,
                   TRIM(SF4.F4_OPEMOV) OPERACAO_MOVIMENTO,
                   TRIM(SF4.F4_TEXTO) TEXTO_PADRAO,
                   TRIM(SF4.F4_FINALID) FINALIDADE,
                   DECODE(SF4.F4_DUPLIC,'S','SIM','N','NAO') GERA_DUPLICADA,
                   DECODE(SF4.F4_ESTOQUE,'S','SIM','N','NAO') ATUALIZA_ESTOQUE,
                   DECODE(SF4.F4_ICM,'S','SIM','N','NAO') CALCULA_ICMS,
                   DECODE(SF4.F4_CREDICM,'S','SIM','N','NAO') CREDITA_ICMS,
                   DECODE(SF4.F4_IPI,'S','SIM','N','NAO') CALCULA_IPI,
                   DECODE(SF4.F4_CREDIPI,'S','SIM','N','NAO') CREDITA_IPI,
                   DECODE(SF4.F4_LFICM,'T','TRIBUTADO','I','ISENTO','O','OUTROS','N','NAO','Z','ICMS ZERADO','B','OBSERVACAO') LIVRO_FISCAL_ICMS,
                   DECODE(SF4.F4_LFIPI,'T','TRIBUTADO','I','ISENTO','O','OUTROS','N','NAO','Z','IPI ZERADO','P','VL.IPI OUTR.ICM') LIVRO_FISCAL_IPI,
                   DECODE(SF4.F4_MSBLQL,'1','SIM','2','NAO',' ','NAO') BLOQUEADO
            FROM {$this->schema}.SF4010 SF4
            WHERE SF4.D_E_L_E_T_ = ' '
            {$search}
            ORDER BY SF4.F4_CODIGO";

        $result = $connection->select($query);
        $return = $connection->fetchAll($result);
        $connection->bye();
        return new ObjectPhalcon($return);
    }

}
