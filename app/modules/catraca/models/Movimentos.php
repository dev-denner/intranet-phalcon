<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Catraca\Models;

use SysPhalcon\Models\ModelBase;
use Phalcon\Db\RawValue;
use Phalcon\Config as ObjectPhalcon;

class Movimentos extends ModelBase {

    protected $id;
    protected $name;
    protected $dataMovimento;
    protected $tipo;

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDataMovimento() {
        return $this->dataMovimento;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function setDataMovimento($dataMovimento) {
        $this->dataMovimento = new RawValue("TO_DATE('{$dataMovimento}', 'YYYY-MM-DD HH24:MI:SS')");
        return $this;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }

    public function initialize() {

        parent::initialize();

        $this->belongsTo('TRIM(name)', '\Nucleo\Models\Protheus\Colaboradores', 'TRIM(szhNome)', ['alias' => 'Colaboradores',]);
    }

    public function getSource() {
        return 'MOVIMENTO_CATRACA';
    }

    public static function columnMap() {
        return [
            'ID_MOVIMENTO_CATRACA' => 'id',
            'DS_NOME' => 'name',
            'DT_MOVIMENTO' => 'dataMovimento',
            'DS_TIPO' => 'tipo',
        ];
    }

    public function getReport($dateFrom = '', $dateTo = '', $pesquisa = '') {

        $busca = '';

        if (!empty($dateFrom)) {
            $busca .= " AND DT_MOVIMENTO >= TO_DATE('{$dateFrom}', 'YYYY-MM-DD')";
        }
        if (!empty($dateTo)) {
            $busca .= " AND DT_MOVIMENTO <= TO_DATE('{$dateTo}', 'YYYY-MM-DD')";
        }
        if (!empty($pesquisa)) {
            $busca .= " AND (UPPER(EMPRESA) LIKE UPPER('%$pesquisa%')
                          OR UPPER(NOME) LIKE UPPER('%$pesquisa%')
                          OR UPPER(CPF) LIKE UPPER('%$pesquisa%')
                          OR UPPER(CCEO) LIKE UPPER('%$pesquisa%')
                          OR UPPER(SECAO) LIKE UPPER('%$pesquisa%'))";
        }

        $connection = $this->customConnection('db');

        $szhColaboradores = new \Nucleo\Models\Protheus\Colaboradores();
        $empresas = $szhColaboradores->getNameEmpresas();
        $empresas = str_replace('szhEmpresa', 'ZH.ZH_EMPRESA', $empresas);

        $query = "SELECT EMPRESA, NOME, CPF, CCEO, SECAO, DATA, HORA, TIPO FROM(
                    SELECT {$empresas} EMPRESA,
                         TRIM(MO.DS_NOME) NOME,
                         TRIM(ZH.ZH_CPF) CPF,
                         TRIM(ZH.ZH_CCEO) CCEO,
                         TRIM(ZH.ZH_SECAO) SECAO,
                         TO_CHAR(MO.DT_MOVIMENTO, 'DD/MM/YYYY') DATA,
                         TO_CHAR(MO.DT_MOVIMENTO, 'HH24:MI:SS') HORA,
                         TRIM(MO.DS_TIPO) TIPO,
                         DT_MOVIMENTO
                    FROM MOVIMENTO_CATRACA MO
                    LEFT JOIN PRODUCAO_9ZGXI5.SZH010@PROTHEUSPROD ZH
                    ON TRIM(ZH.ZH_NOME) = TRIM(MO.DS_NOME)
                    ORDER BY 2, DT_MOVIMENTO, 8
                  )
                  WHERE 1 = 1 {$busca}";

        $result = $connection->select($query);
        $return = $connection->fetchAll($result);
        $connection->bye();

        return new ObjectPhalcon($return);
    }

    public function deleteByRange($dateFrom, $dateTo) {

        $connection = $this->customConnection('db');

        $result = $connection->delete('MOVIMENTO_CATRACA', "DT_MOVIMENTO BETWEEN TO_DATE('{$dateFrom}', 'YYYY-MM-DD') AND TO_DATE('{$dateTo}', 'YYYY-MM-DD')");

        $connection->bye();

        return $result;
    }

}
