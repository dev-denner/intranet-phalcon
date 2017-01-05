<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models\RM;

use SysPhalcon\Models\ModelBase;
use Phalcon\Config as ObjectPhalcon;

class Ferias extends ModelBase {

    public function initialize() {

        parent::initialize();

        $this->setSchema('RM');
        $this->setConnectionService('rmDb');
        $this->setReadConnectionService('rmDb');
    }

    public function getListaReciboFerias($coligada, $chapa) {

        if (empty($coligada) || empty($chapa)) {
            throw new \Exception('Erro em getListaReciboFerias: Variáveis vazias');
        }

        $connection = $this->customConnection('rmDb');

        $query = "SELECT EXTRACT(YEAR FROM INICIOPERAQUIS) ANO,
                         TO_CHAR(FIMPERAQUIS, 'DD-MM-YYYY') FIM_PERIODO_AQUISITIVO
                  FROM RM.PFUFERIAS
                  WHERE CODCOLIGADA = {$coligada}
                  AND CHAPA= '{$chapa}'
                  AND PERIODOABERTO = 0
                  AND EXTRACT(YEAR FROM INICIOPERAQUIS) >= 2013";

        $result = $connection->select($query);
        $return = $connection->fetchAll($result);
        $connection->bye();
        return new ObjectPhalcon($return);
    }

    public function getDadosColigada($coligada) {

        if (empty($coligada)) {
            throw new \Exception('Erro em getListaReciboFerias: Variável vazia');
        }

        $connection = $this->customConnection('rmDb');

        $query = 'SELECT NOME, CGC, RUA, BAIRRO, CIDADE FROM RM.GCOLIGADA WHERE CODCOLIGADA = ' . $coligada;

        $result = $connection->select($query);
        $return = $connection->fetchAll($result);
        $connection->bye();
        return new ObjectPhalcon($return);
    }

    public function getDadosColaborador($coligada, $chapa, $periodo) {

        if (empty($coligada) || empty($chapa) || empty($periodo)) {
            throw new \Exception('Erro em getListaReciboFerias: Variáveis vazias');
        }

        $connection = $this->customConnection('rmDb');

        $query = "SELECT DISTINCT PF.CHAPA,
                                  PF.NOME,
                                  FU.NOME FUNCAO,
                                  TO_CHAR(RF.FIMPERAQUIS, 'DD/MM/YYYY') VENCIMENTO_FERIAS,
                                  TO_CHAR(RF.SALARIO,'999990D00') SALARIO,
                                  TO_CHAR(PG.DATAINICIO, 'DD/MM/YYYY') || ' a ' || TO_CHAR(PG.DATAFIM , 'DD/MM/YYYY') PERIODO_GOZO,
                                  NVL(PG.NRODIASABONO, 0) ABONO,
                                  PP.CARTEIRATRAB CARTEIRA_TRABALHO,
                                  PP.SERIECARTTRAB SERIE_CART_TRAB,
                                  PF.CODSECAO,
                                  PS.DESCRICAO DESC_SECAO
                  FROM RM.PFUFERIASRECIBO RF
                  INNER JOIN RM.PFUFERIASPER PG
                        ON PG.CODCOLIGADA = RF.CODCOLIGADA
                        AND PG.CHAPA = RF.CHAPA
                        AND PG.FIMPERAQUIS = RF.FIMPERAQUIS
                  INNER JOIN RM.PFUNC PF
                        ON PF.CODCOLIGADA = RF.CODCOLIGADA
                        AND PF.CHAPA = RF.CHAPA
                  INNER JOIN RM.PPESSOA PP
                        ON PP.CODIGO = PF.CODPESSOA
                  INNER JOIN RM.PSECAO PS
                        ON PS.CODIGO = PF.CODSECAO
                  INNER JOIN RM.PFUNCAO FU
                        ON FU.CODCOLIGADA = PF.CODCOLIGADA
                        AND FU.CODIGO = PF.CODFUNCAO
                  WHERE RF.CODCOLIGADA = {$coligada}
                        AND RF.CHAPA = '{$chapa}'
                        AND RF.FIMPERAQUIS = TO_DATE('{$periodo}', 'DD-MM-YYYY')";

        $result = $connection->select($query);
        $return = $connection->fetchAll($result);
        $connection->bye();
        return new ObjectPhalcon($return);
    }

    public function getValores($coligada, $chapa, $periodo) {

        if (empty($coligada) || empty($chapa) || empty($periodo)) {
            throw new \Exception('Erro em getListaReciboFerias: Variáveis vazias');
        }

        $connection = $this->customConnection('rmDb');

        $query = "SELECT CODEVENTO,
                         REF,
                         DESCRICAO,
                         CASE PROVDESCBASE
                              WHEN 'P' THEN VALOR
                         END PROVENTOS,
                         CASE PROVDESCBASE
                              WHEN 'D' THEN VALOR
                         END DESCONTOS
                  FROM (SELECT FV.CODEVENTO,
                               TO_CHAR(FV.REF,'9990D00') REF,
                               PE.DESCRICAO,
                               TO_CHAR(FV.VALOR,'999990D00') VALOR,
                               PE.PROVDESCBASE
                        FROM RM.PFUFERIASVERBAS FV
                        INNER JOIN RM.PEVENTO PE
                          ON PE.CODCOLIGADA  = FV.CODCOLIGADA
                          AND PE.CODIGO      = FV.CODEVENTO
                        WHERE FV.CODCOLIGADA = {$coligada}
                          AND FV.CHAPA     = '{$chapa}'
                          AND FV.FIMPERAQUIS = TO_DATE('{$periodo}', 'DD-MM-YYYY')
                          AND PE.PROVDESCBASE IN('D', 'P')
                        ORDER BY PE.PROVDESCBASE DESC, FV.VALOR DESC
                        )";

        $result = $connection->select($query);
        $return = $connection->fetchAll($result);
        $connection->bye();
        return new ObjectPhalcon($return);
    }

    public function getTotalizadores($coligada, $chapa, $periodo) {

        if (empty($coligada) || empty($chapa) || empty($periodo)) {
            throw new \Exception('Erro em getListaReciboFerias: Variáveis vazias');
        }

        $connection = $this->customConnection('rmDb');

        $query = "SELECT SUM(PROVENTOS) TOTAL_PROVENTOS,
                         SUM(DESCONTOS) TOTAL_DESCONTOS,
                         SUM(PROVENTOS) - SUM(DESCONTOS) LIQUIDO
                  FROM (SELECT CASE PROVDESCBASE
                                    WHEN 'P' THEN VALOR
                               END PROVENTOS,
                               CASE PROVDESCBASE
                                    WHEN 'D' THEN VALOR
                               END DESCONTOS
                        FROM (SELECT TO_CHAR(FV.VALOR,'999990D00') VALOR,
                                     PE.PROVDESCBASE
                              FROM RM.PFUFERIASVERBAS FV
                              INNER JOIN RM.PEVENTO PE
                                    ON PE.CODCOLIGADA    = FV.CODCOLIGADA
                                    AND PE.CODIGO        = FV.CODEVENTO
                              WHERE FV.CODCOLIGADA = {$coligada}
                                AND FV.CHAPA         = '{$chapa}'
                                AND FV.FIMPERAQUIS   = TO_DATE('{$periodo}', 'DD-MM-YY')
                                AND PE.PROVDESCBASE IN('D', 'P')
                              )
                        )";

        $result = $connection->select($query);
        $return = $connection->fetchAll($result);
        $connection->bye();
        return new ObjectPhalcon($return);
    }

}
