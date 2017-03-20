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

class Clientes extends ModelBase {

    protected $sa1Cod;
    protected $sa1Loja;
    protected $sa1Nome;
    protected $sa1Cgc;
    protected $sa1Est;
    protected $sa1Mun;
    protected $sa1Indret;
    protected $sa1Msblql;
    protected $sa1Sdel;

    public function initialize() {

        parent::initialize();

        $this->setSchema('PRODUCAO_9ZGXI5');
        $this->setConnectionService('protheusDb');
        $this->setReadConnectionService('protheusDb');
    }

    public function getSource() {
        return 'SA1010';
    }

    public static function columnMap() {
        return [
            'A1_COD' => 'sa1Cod',
            'A1_LOJA' => 'sa1Loja',
            'A1_NOME' => 'sa1Nome',
            'A1_CGC' => 'sa1Cgc',
            'A1_EST' => 'sa1Est',
            'A1_MUN' => 'sa1Mun',
            'A1_INDRET' => 'sa1Indret',
            'A1_MSBLQL' => 'sa1Msblql',
            'D_E_L_E_T_' => 'sa1Sdel',
        ];
    }

    public function getClientes($search) {

        $connection = $this->customSimpleQuery('protheusDb');

        if (!empty($search)) {
            $search = "AND (SA1.A1_COD LIKE '%{$search}%'
                OR SA1.A1_NOME LIKE '%{$search}%'
                OR SA1.A1_CGC LIKE '%{$search}%')";
        }

        $query = "
            SELECT SA1.A1_COD CODIGO,
                   SA1.A1_LOJA LOJA,
                   SA1.A1_NOME NOME,
                   SA1.A1_CGC CNPJ,
                   SA1.A1_EST UF,
                   SA1.A1_MUN MUNICIPIO,
                   SA1.A1_INDRET INDICADOR_RETENCAO,
                   DECODE(SA1.A1_MSBLQL,'1','SIM','2','NAO',' ','NAO') BLOQUEADO
            FROM {$this->schema}.SA1010 SA1
            WHERE SA1.D_E_L_E_T_ = ' '
            {$search}
            ORDER BY SA1.A1_COD, SA1.A1_LOJA";


        return new ObjectPhalcon($connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC));
    }

    public function getQtdClientes() {

        $fornecedores = $this->modelsManager->createBuilder()
                ->columns(['count(sa1Cod) qtd'])
                ->from(__NAMESPACE__ . '\Clientes')
                ->where("sa1Sdel = ' '")
                ->getQuery()
                ->execute();
        return $fornecedores->toArray(0)[0]['QTD'];
    }

}
