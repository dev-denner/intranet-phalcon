<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models\Protheus;

use DevDenners\Models\ModelBase;

class Fornecedores extends ModelBase {

    protected $sa2Cod;
    protected $sa2Loja;
    protected $sa2Nome;
    protected $sa2Cgc;
    protected $sa2Uf;
    protected $sa2Municipio;
    protected $sa2Msblql;
    protected $sa2Sdel;

    public function initialize() {

        parent::initialize();

        $this->setSchema('PRODUCAO_9ZGXI5');
        $this->setConnectionService('protheusDb');
        $this->setReadConnectionService('protheusDb');
    }

    public function getSource() {
        return 'SA2010';
    }

    public static function columnMap() {
        return [
            'A2_COD' => 'sa2Cod',
            'A2_LOJA' => 'sa2Loja',
            'A2_NOME' => 'sa2Nome',
            'A2_CGC' => 'sa2Cgc',
            'A2_EST' => 'sa2Uf',
            'A2_MUN' => 'sa2Municipio',
            'A2_MSBLQL' => 'sa2Msblql',
            'D_E_L_E_T_' => 'sa2Sdel',
        ];
    }

    public function getFornecedoresForSearch($fornecedor) {
        $fornecedor = strtoupper($fornecedor);

        $blq = "CASE sa2Msblql WHEN '1' THEN 'Sim' ELSE '' END";

        $fornecedores = $this->modelsManager->createBuilder()
                ->columns(['TRIM(sa2Cod) codigo,
                       TRIM(sa2Loja) loja,
                       TRIM(sa2Nome) nome,
                       TRIM(sa2Cgc) cgc,
                       TRIM(sa2Uf) uf,
                       TRIM(sa2Municipio) municipio,
                       ' . $blq . ' blq'])
                ->from(__NAMESPACE__ . '\Fornecedores')
                ->where("sa2Sdel = ' '")
                ->andwhere("sa2Cod LIKE 'F%'")
                ->andWhere("(sa2Nome LIKE '%" . $fornecedor . "%'
                          OR sa2Cod LIKE '%" . $fornecedor . "%'
                          OR sa2Loja LIKE '%" . $fornecedor . "%'
                          OR sa2Cgc LIKE '%" . $fornecedor . "%'
                          OR sa2Uf LIKE '%" . $fornecedor . "%'
                          OR sa2Municipio LIKE '%" . $fornecedor . "%')")
                ->getQuery()
                ->execute();
        return $fornecedores->toArray(0);
    }

    public function getQtdFornecedores() {

        $fornecedores = $this->modelsManager->createBuilder()
                ->columns(['count(sa2Cod) qtd'])
                ->from(__NAMESPACE__ . '\Fornecedores')
                ->where("sa2Sdel = ' '")
                ->andwhere("sa2Cod LIKE 'F%'")
                ->getQuery()
                ->execute();
        return $fornecedores->toArray(0)[0]['QTD'];
    }

}
