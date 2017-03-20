<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace App\Modules\Nucleo\Models\Protheus;

use App\Shared\Models\ModelBase;
use Phalcon\Config as ObjectPhalcon;

class Fornecedores extends ModelBase
{

    protected $sa2Cod;
    protected $sa2Loja;
    protected $sa2Nome;
    protected $sa2Cgc;
    protected $sa2Uf;
    protected $sa2Municipio;
    protected $sa2Msblql;
    protected $sa2Sdel;

    public function initialize()
    {

        parent::initialize();

        $this->setSchema('PRODUCAO_9ZGXI5');
        $this->setConnectionService('protheusDb');
        $this->setReadConnectionService('protheusDb');
    }

    public function getSource()
    {
        return 'SA2010';
    }

    public static function columnMap()
    {
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
    public function getFornecedores($search)
    {

        $connection = $this->customSimpleQuery('protheusDb');

        if (!empty($search)) {
            $search = "AND (SA2.A2_NOME LIKE UPPER('%{$search}%')
                         OR SA2.A2_COD LIKE UPPER('%{$search}%')
                         OR SA2.A2_LOJA LIKE UPPER('%{$search}%')
                         OR SA2.A2_CGC LIKE UPPER('%{$search}%')
                         OR SA2.A2_EST LIKE UPPER('%{$search}%')
                         OR SA2.A2_MUN LIKE UPPER('%{$search}%'))";
        }

        $query = "
            SELECT TRIM(SA2.A2_COD) codigo,
                   TRIM(SA2.A2_LOJA) loja,
                   TRIM(SA2.A2_NOME) nome,
                   TRIM(SA2.A2_CGC) cnpj,
                   TRIM(SA2.A2_EST) uf,
                   TRIM(SA2.A2_MUN) municipio,
                   CASE SA2.A2_MSBLQL
                        WHEN '1' THEN 'Sim'
                        ELSE ''
                   END blq
            FROM {$this->schema}.SA2010 SA2
            WHERE SA2.D_E_L_E_T_ = ' '
              AND SA2.A2_COD LIKE 'F%'
              {$search}
            ORDER BY SA2.A2_COD";

        return new ObjectPhalcon(@$connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC));
    }

    public function getQtdFornecedores()
    {

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
