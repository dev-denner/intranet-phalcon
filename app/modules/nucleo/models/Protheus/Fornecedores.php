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

    /**
     *
     * @param type $search
     * @return ObjectPhalcon
     */
    public function getFornecedores($search) {

        $connection = $this->customConnection();

        if (!empty($search)) {
            $search = "AND (SA2010.A2_NOME LIKE UPPER('%{$search}%')
                         OR SA2010.A2_COD LIKE UPPER('%{$search}%')
                         OR SA2010.A2_LOJA LIKE UPPER('%{$search}%')
                         OR SA2010.A2_CGC LIKE UPPER('%{$search}%')
                         OR SA2010.A2_EST LIKE UPPER('%{$search}%')
                         OR SA2010.A2_MUN LIKE UPPER('%{$search}%'))";
        }

        $query = "
            SELECT TRIM(SA2010.A2_COD) AS codigo,
                   TRIM(SA2010.A2_LOJA) AS loja,
                   TRIM(SA2010.A2_NOME) AS nome,
                   TRIM(SA2010.A2_CGC) AS cnpj,
                   TRIM(SA2010.A2_EST) AS uf,
                   TRIM(SA2010.A2_MUN) AS municipio,
                   CASE SA2010.A2_MSBLQL
                        WHEN '1' THEN 'Sim'
                        ELSE ''
                   END AS blq
            FROM {$this->schema}.SA2010
            WHERE SA2010.D_E_L_E_T_ = ' '
              AND SA2010.A2_COD LIKE 'F%'
              {$search}
            ORDER BY SA2010.A2_COD";

        $result = $connection->select($query);
        $return = $connection->fetchAll($result);
        $connection->bye();
        return new ObjectPhalcon($return);
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
