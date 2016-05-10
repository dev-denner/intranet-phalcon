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

class ProdutosDescricao extends ModelBase {

    public $sb1Cod;
    public $sb1Desc;
    public $sb1Grupo;
    public $sb1Um;
    public $sb1Posipi;
    public $sb1Msblql;
    public $sb1Sdel;

    public function initialize() {

        parent::initialize();

        $this->setSchema('PRODUCAO_9ZGXI5');
        $this->setConnectionService('protheusDb');
        $this->setReadConnectionService('protheusDb');

        $this->belongsTo('sb1Cod', __NAMESPACE__ . '\ProdutosAdicionais', 'sb5Cod', ['alias' => 'ProdutosAdicionais',]);
        $this->belongsTo('sb1Grupo', __NAMESPACE__ . '\ProdutosGrupos', 'sbmGrupo', ['alias' => 'ProdutosGrupos',]);
    }

    public function getSource() {
        return 'SB1010';
    }

    public static function columnMap() {
        return [
            'B1_COD' => 'sb1Cod',
            'B1_DESC' => 'sb1Desc',
            'B1_GRUPO' => 'sb1Grupo',
            'B1_UM' => 'sb1Um',
            'B1_POSIPI' => 'sb1Posipi',
            'B1_MSBLQL' => 'sb1Msblql',
            'D_E_L_E_T_' => 'sb1Sdel',
        ];
    }

    /**
     *
     * @param type $search
     * @return ObjectPhalcon
     */
    public function getProdutos($search) {

        $connection = $this->customConnection();

        if (!empty($search)) {
            $search = "AND (UPPER(SB1010.B1_DESC) LIKE UPPER('%{$search}%')
                         OR UPPER(SBM010.BM_DESC) LIKE UPPER('%{$search}%')
                         OR UPPER(SB5010.B5_CEME) LIKE UPPER('%{$search}%')
                         OR UPPER(SB1010.B1_GRUPO) LIKE UPPER('%{$search}%')
                         OR UPPER(SB1010.B1_COD) LIKE UPPER('%{$search}%'))";
        }

        $query = "
            SELECT TRIM(SB1010.B1_COD) codigo,
                   TRIM(SB1010.B1_DESC) descricao,
                   TRIM(SB5010.B5_CEME) descricao_completa,
                   TRIM(SB1010.B1_GRUPO) grupo,
                   TRIM(SBM010.BM_DESC) descricao_grupo,
                   TRIM(SB1010.B1_UM) un,
                   TRIM(SB1010.B1_POSIPI) ncm
            FROM {$this->schema}.SB1010
            INNER JOIN {$this->schema}.SB5010
                    ON SB5010.B5_COD = SB1010.B1_COD
                    AND SB5010.D_E_L_E_T_ = ' '
            INNER JOIN {$this->schema}.SBM010
                    ON SBM010.BM_GRUPO = SB1010.B1_GRUPO
                    AND SBM010.D_E_L_E_T_ = ' '
            WHERE SB1010.D_E_L_E_T_ = ' '
               AND SB1010.B1_MSBLQL = '2'
               AND SB1010.B1_GRUPO NOT IN ('3701', '4201', '4202')
                {$search}
            ORDER BY SB1010.B1_COD";

        $result = $connection->select($query);
        $return = $connection->fetchAll($result);
        $connection->bye();
        return new ObjectPhalcon($return);
    }

    /**
     *
     * @param type $type
     * @return type
     */
    public function getQtdProdutos($type) {

        $produtos = $this->modelsManager->createBuilder()
                ->columns(['COUNT(sb1Cod) qtd'])
                ->from(__NAMESPACE__ . '\ProdutosDescricao')
                ->innerJoin(__NAMESPACE__ . '\ProdutosAdicionais', "sb5Cod = sb1Cod AND sb5Sdel = ' '")
                ->innerJoin(__NAMESPACE__ . '\ProdutosGrupos', "sbmGrupo = sb1Grupo AND sbmSdel = ' '")
                ->where("sb1Sdel = ' ' AND sb1Msblql = '2' AND sb1Grupo NOT IN('3701', '4201', '4202')")
                ->andWhere("sbmxFlag = '" . $type . "'")
                ->getQuery()
                ->execute();
        return $produtos->toArray(0)[0]['QTD'];
    }

}
