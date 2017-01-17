<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Catraca\Models;

use Phalcon\Config as ObjectPhalcon;

class Firebird {

    private $connection;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        $hostname = 'localhost:/var/www/html/files/firebird/Henry.fdb';
        $username = 'sysdba';
        $password = 'masterkey';

        if (!($this->connection = ibase_connect($hostname, $username, $password))) {
            throw new \Exception('Erro ao conectar: ' . ibase_errmsg());
        }
    }

    public function getMovimento($dateFrom = '', $dateTo = '') {

        $search = '';

        if (!empty($dateFrom)) {
            $search .= "AND CAST(HE22_DT_REGISTRO AS DATE) >= CAST('{$dateFrom}' AS DATE)";
        }

        if (!empty($dateTo)) {
            $search .= "AND CAST(HE22_DT_REGISTRO AS DATE) <= CAST('{$dateTo}' AS DATE)";
        }

        $sql = "SELECT
                    HE22_ST_MATRICULA AS MATRICULA,
                    HE02_ST_NOME      AS NOME,
                    HE22_DT_REGISTRO  AS REGISTRO,
                    CASE HE22_BL_SAIDA
                        WHEN 1 THEN 'SAIDA'
                        ELSE 'ENTRADA'
                    END  MOVIMENTO
                FROM HE22
                LEFT JOIN HE02
                    ON HE22_ST_MATRICULA = HE02_ST_MATRICULA
                WHERE  HE22_BL_GIROU = 1
                   AND HE02_ST_NOME IS NOT NULL
                   {$search}
                ORDER BY 2, 3, 4";

        $query = ibase_query($this->connection, $sql);

        $return = [];
        $i = 0;

        while ($row = ibase_fetch_object($query)) {
            $return[$i]['id'] = $row->MATRICULA;
            $return[$i]['name'] = $row->NOME;
            $return[$i]['dataMovimento'] = $row->REGISTRO;
            $return[$i]['tipo'] = $row->MOVIMENTO;
            $i++;
        }
        return new ObjectPhalcon($return);
    }

    public function getColaboradores() {

        $sql = "SELECT * FROM HE02";

        $query = ibase_query($this->connection, $sql);

        $return = [];
        $i = 0;

        while ($row = ibase_fetch_object($query)) {
            $return[$i]['id'] = $row->HE02_ST_MATRICULA;
            $return[$i]['name'] = $row->HE02_ST_NOME;
            $i++;
        }
        return new ObjectPhalcon($return);
    }

}
