<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models\Protheus;

use DevDenners\Models\ModelBase;

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
     * @param type $prod
     * @return type
     */
    public function getProdutosForSearch($prod) {

        $produtos = $this->modelsManager->createBuilder()
                ->columns(['TRIM(sb1Cod) codigo,
                            TRIM(sb1Desc) descProd,
                            TRIM(sb5Ceme) descProdComp,
                            TRIM(sb1Grupo) grupo,
                            TRIM(sbmDesc) descGrupo,
                            TRIM(sb1Um) um,
                            TRIM(sb1Posipi) ncm'])
                ->from(__NAMESPACE__ . '\ProdutosDescricao')
                ->innerJoin(__NAMESPACE__ . '\ProdutosAdicionais', "sb5Cod = sb1Cod AND sb5Sdel = ' '")
                ->innerJoin(__NAMESPACE__ . '\ProdutosGrupos', "sbmGrupo = sb1Grupo AND sbmSdel = ' '")
                ->where("sb1Sdel = ' ' AND sb1Msblql = '2' AND sb1Grupo NOT IN('3701', '4201', '4202')")
                ->andWhere("UPPER(sb1Desc) LIKE UPPER('%" . $prod . "%')
                         OR UPPER(sbmDesc) LIKE UPPER('%" . $prod . "%')
                         OR UPPER(sb5Ceme) LIKE UPPER('%" . $prod . "%')
                         OR UPPER(sb1Grupo) LIKE UPPER('%" . $prod . "%')
                         OR UPPER(sb1Cod) LIKE UPPER('%" . $prod . "%')")
                ->orderBy('sb1Cod')
                ->getQuery()
                ->execute();
        return $produtos->toArray(0);
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
