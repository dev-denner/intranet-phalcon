<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace App\Modules\Telephony\Models;

use App\Shared\Models\ModelBase;
use Phalcon\Config as ObjectPhalcon;

class Reports extends ModelBase
{

    public function getRateioDescFolha($comp)
    {

        $connection = $this->customSimpleQuery('telefoniaDb');

        if (!empty($comp)) {
            $comp = " AND EX.MESREF = '{$comp}' ";
        }

        $query = "
             SELECT ZH.EMPRESA, TRIM(ZH.NOME) NOME, EX.MESREF, EX.NUMACS, LC.CPF,
                CASE
                  WHEN LC.CCEO IS NULL THEN ZH.CCEO
                  ELSE LC.CCEO
                END ZH_CCEO,
                CASE LC.DESC_FOLHA
                    WHEN '0' THEN 'N'
                    ELSE LC.DESC_FOLHA
                END DESC_FOLHA,
                REPLACE(TO_CHAR(SUM(EX.VALOR)), '.', ',') VALOR
             FROM (SELECT MESREF, NUMACS, VALOR, OPERLD FROM EXTRATO
                    WHERE NUMACS IS NOT NULL) EX
             LEFT JOIN LINHA_CELULAR LC
                ON LC.LINHA = EX.NUMACS
             LEFT JOIN COLABORADOR_PROTHEUS ZH
                ON ZH.CPF = REPLACE(REPLACE(TRIM(LC.CPF), '.'), '-')
             WHERE 1 = 1 {$comp}
               AND EX.OPERLD IS NULL
             GROUP BY ZH.EMPRESA, ZH.NOME, EX.MESREF, EX.NUMACS,
                       LC.CPF, ZH.CCEO, LC.DESC_FOLHA, LC.CCEO
             ORDER BY ZH.EMPRESA, ZH.NOME";

        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

    public function getRateioNF($comp = NULL)
    {

        $connection = $this->customSimpleQuery('telefoniaDb');

        if (!is_null($comp)) {
            $comp = " AND EX.MESREF = '$comp' ";
        }

        $query = "SELECT EX.MESREF, LC.CCEO,
                    CASE
                    WHEN LENGTH(TRIM(LC.CCEO)) < 9 THEN 'EO'
                    ELSE 'CC'
                    END EOCC,
                    REPLACE(TO_CHAR(SUM(EX.VALOR)), '.', ',') VALOR
                  FROM (SELECT NUMACS, MESREF, VALOR FROM EXTRATO
                        WHERE NUMACS IS NOT NULL) EX
                  LEFT JOIN LINHA_CELULAR LC
                    ON LC.LINHA = EX.NUMACS
                  WHERE 1 = 1 $comp
                  GROUP BY EX.MESREF, LC.CCEO
                    ORDER BY 2";

        $return = $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);

        if (empty($return)) {
            throw new \Exception('Não dados a exibir.');
        }
        return new ObjectPhalcon($return);
    }

    public function getRateioTotvs($comp = NULL, $valor = 0)
    {
        $connection = $this->customSimpleQuery('db');
        $query = "
            SELECT CC,
                   COUNT(1) QTD,
                   TRIM(CTT.CTT_DESC01) DESCRICAO_CC,
                   SZB.ZB_CODIGO GESTOR,
                   TRIM(SZB.ZB_NOME) NOME_GESTOR
            FROM (SELECT TRIM(SC7.C7_CC) CC
                  FROM PRODUCAO_9ZGXI5.V_BI_SC7@PROTHEUSPROD SC7
                  WHERE SC7.D_E_L_E_T_           = ' '
                    AND SUBSTR(SC7.C7_EMISSAO,1,6) = '$comp'
                    AND SC7.C7_CC IN
                      (SELECT CTT.CTT_CUSTO
                      FROM PRODUCAO_9ZGXI5.V_BI_CTT@PROTHEUSPROD CTT
                      WHERE CTT.D_E_L_E_T_          = ' '
                      AND (CTT.CTT_XBLMOV           = ' '
                      OR SUBSTR(CTT.CTT_XBLMOV,1,6) > '$comp'))
                        UNION ALL
                        SELECT TRIM(SE2.E2_CCD) CC
                        FROM PRODUCAO_9ZGXI5.V_BI_SE2@PROTHEUSPROD SE2
                        WHERE SE2.D_E_L_E_T_         = ' '
                        AND SUBSTR(SE2.E2_EMIS1,1,6) = '$comp'
                        AND SE2.E2_CCD              IN
                          (SELECT CTT.CTT_CUSTO
                          FROM PRODUCAO_9ZGXI5.V_BI_CTT@PROTHEUSPROD CTT
                          WHERE CTT.D_E_L_E_T_          = ' '
                          AND (CTT.CTT_XBLMOV           = ' '
                          OR SUBSTR(CTT.CTT_XBLMOV,1,6) > '$comp')
                          )
                        UNION ALL
                        SELECT TRIM(SC6.C6_XCC) CC
                        FROM PRODUCAO_9ZGXI5.V_BI_SC5@PROTHEUSPROD SC5
                        INNER JOIN PRODUCAO_9ZGXI5.V_BI_SC6@PROTHEUSPROD SC6
                        ON SC5.CD_EMPR                 = SC6.CD_EMPR
                        AND SC5.C5_FILIAL              = SC6.C6_FILIAL
                        AND SC5.C5_NUM                 = SC6.C6_NUM
                        AND SC5.C5_SERIE               = SC6.C6_SERIE
                        AND SC5.C5_CLIENTE             = SC6.C6_CLI
                        AND SC5.C5_LOJACLI             = SC6.C6_LOJA
                        WHERE SC6.D_E_L_E_T_           = ' '
                        AND SUBSTR(SC5.C5_EMISSAO,1,6) = '$comp'
                        AND SC6.C6_XCC                IN
                          (SELECT CTT.CTT_CUSTO
                          FROM PRODUCAO_9ZGXI5.V_BI_CTT@PROTHEUSPROD CTT
                          WHERE CTT.D_E_L_E_T_          = ' '
                          AND (CTT.CTT_XBLMOV           = ' '
                          OR SUBSTR(CTT.CTT_XBLMOV,1,6) > '$comp')
                          )
                        UNION ALL
                        SELECT TRIM(SE1.E1_CCC) CC
                        FROM PRODUCAO_9ZGXI5.V_BI_SE1@PROTHEUSPROD SE1
                        WHERE SE1.D_E_L_E_T_         = ' '
                        AND SUBSTR(SE1.E1_EMIS1,1,6) = '$comp'
                        AND SE1.E1_CCC              IN
                          (SELECT CTT.CTT_CUSTO
                          FROM PRODUCAO_9ZGXI5.V_BI_CTT@PROTHEUSPROD CTT
                          WHERE CTT.D_E_L_E_T_          = ' '
                          AND (CTT.CTT_XBLMOV           = ' '
                          OR SUBSTR(CTT.CTT_XBLMOV,1,6) > '$comp')
                          )
                        UNION ALL
                        SELECT TRIM(SE5.E5_CCD) CC
                        FROM PRODUCAO_9ZGXI5.V_BI_SE5@PROTHEUSPROD SE5
                        WHERE SE5.D_E_L_E_T_           = ' '
                        AND SUBSTR(SE5.E5_DTDIGIT,1,6) = '$comp'
                        AND SE5.E5_CCD                IN
                          (SELECT CTT.CTT_CUSTO
                          FROM PRODUCAO_9ZGXI5.V_BI_CTT@PROTHEUSPROD CTT
                          WHERE CTT.D_E_L_E_T_          = ' '
                          AND (CTT.CTT_XBLMOV           = ' '
                          OR SUBSTR(CTT.CTT_XBLMOV,1,6) > '$comp')
                          )
                        UNION ALL
                        SELECT TRIM(SE5.E5_CCC) CC
                        FROM PRODUCAO_9ZGXI5.V_BI_SE5@PROTHEUSPROD SE5
                        WHERE SE5.D_E_L_E_T_           = ' '
                        AND SUBSTR(SE5.E5_DTDIGIT,1,6) = '$comp'
                        AND SE5.E5_CCC                IN
                          (SELECT CTT.CTT_CUSTO
                          FROM PRODUCAO_9ZGXI5.V_BI_CTT@PROTHEUSPROD CTT
                          WHERE CTT.D_E_L_E_T_          = ' '
                          AND (CTT.CTT_XBLMOV           = ' '
                          OR SUBSTR(CTT.CTT_XBLMOV,1,6) > '$comp')
                          )
                        UNION ALL
                        SELECT REPLACE(A2.NROCENCUSTOCONT, '.') CC
                        FROM RM.PFUNC@RMPROD A1
                        INNER JOIN RM.PSECAO@RMPROD A2
                        ON A1.CODCOLIGADA                 = A2.CODCOLIGADA
                        AND A1.CODSECAO                   = A2.CODIGO
                        WHERE (A1.CODCOLIGADA, A1.CHAPA) IN
                          (SELECT SQA1.CODCOLIGADA,
                            SQA1.CHAPA
                          FROM RM.PFFINANC@RMPROD SQA1
                          INNER JOIN RM.PFUNC@RMPROD SQA2
                          ON SQA1.CODCOLIGADA = SQA2.CODCOLIGADA
                          AND SQA1.CHAPA      = SQA2.CHAPA
                          INNER JOIN RM.PSECAO@RMPROD SQA3
                          ON SQA2.CODCOLIGADA = SQA3.CODCOLIGADA
                          AND SQA2.CODSECAO   = SQA3.CODIGO
                          WHERE SQA1.ANOCOMP
                            || TRIM(TO_CHAR(SQA1.MESCOMP,'00'))           = '$comp'
                          AND TRIM(REPLACE(SQA3.NROCENCUSTOCONT,'.','')) IN
                            (SELECT TRIM(CTT.CTT_CUSTO)
                            FROM PRODUCAO_9ZGXI5.V_BI_CTT@PROTHEUSPROD CTT
                            WHERE CTT.D_E_L_E_T_          = ' '
                            AND (CTT.CTT_XBLMOV           = ' '
                            OR SUBSTR(CTT.CTT_XBLMOV,1,6) > '$comp')
                            )
                          )
                        ) TOTAL
                    INNER JOIN PRODUCAO_9ZGXI5.V_BI_CTT@PROTHEUSPROD CTT
                    ON TRIM(CTT.CTT_CUSTO) = TOTAL.CC
                    LEFT JOIN PRODUCAO_9ZGXI5.SZB010@PROTHEUSPROD SZB
                    ON SZB.ZB_CODIGO = CTT.CTT_XGEST
                  GROUP BY CC, CTT.CTT_DESC01,
                    SZB.ZB_CODIGO,
                    SZB.ZB_NOME
                  ORDER BY CC";


        $return = $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);

        if (count($return) > 0) {

            $total_qtd = 0;
            foreach ($return as $key => $value) {
                $total_qtd += $value['QTD'];
            }

            $dados_novos = [];
            $dados_cc = [];
            $cc = '';
            $qtd = 0;
            $valor_rateio = 0;
            $percentual = 0;

            foreach ($return as $key => $value) {
                if (substr($value['CC'], 0, 1) == '0' ||
                          (substr($value['CC'], 0, 1) == '1' && substr($value['CC'], 4, 1) == '1') ||
                          substr($value['CC'], 1, 3) == '999') {
                    $dados_novos[] = [
                        'CC' => $value['CC'],
                        'DESCRICAO_CC' => $value['DESCRICAO_CC'],
                        'GESTOR' => $value['GESTOR'],
                        'NOME_GESTOR' => $value['NOME_GESTOR'],
                        'QTD' => $value['QTD'],
                        'VALOR RATEIO' => number_format(round((($valor * $value['QTD']) / $total_qtd), 4), 4, ',', ''),
                        'PERCENTUAL' => number_format(round(((100 * $value['QTD']) / $total_qtd), 4), 4, ',', ' '),
                    ];
                } else {
                    if ($cc != substr($value['CC'], 0, 4)) {
                        $cc = substr($value['CC'], 0, 4);
                        $qtd = 0;
                        $valor_rateio = 0;
                        $percentual = 0;
                    }
                    $qtd += (int) $value['QTD'];
                    $valor_rateio += (double) round((($valor * $value['QTD']) / $total_qtd), 4);
                    $percentual += (double) round(((100 * $value['QTD']) / $total_qtd), 4);
                    $dados_cc[$cc] = [
                        'CC' => $cc,
                        'CCCOMPLETO' => $value['CC'],
                        'DESCRICAO_CC' => $value['DESCRICAO_CC'],
                        'GESTOR' => $value['GESTOR'],
                        'NOME_GESTOR' => $value['NOME_GESTOR'],
                        'QTD' => $qtd,
                        'VALOR RATEIO' => $valor_rateio,
                        'PERCENTUAL' => $percentual,
                    ];
                }
            }

            foreach ($dados_cc as $key => $value) {
                $query = "SELECT CTT.CTT_CUSTO CC, TRIM(CTT.CTT_DESC01) DESCRICAO
                          FROM PRODUCAO_9ZGXI5.CTT010@PROTHEUSPROD CTT
                          WHERE CTT.D_E_L_E_T_ = ' '
                          AND CTT.CTT_XDEPTO = '20'
                          AND SUBSTR(CTT.CTT_CUSTO, 1, 4) = '{$key}'
                          ";

                $cc = $connection->fetchOne($query, \Phalcon\Db::FETCH_ASSOC);

                if (!$cc) {
                    $centroCusto = $value['CCCOMPLETO'];
                    $centroCustoDesc = $value['DESCRICAO_CC'];
                } else {
                    $centroCusto = $cc['CC'];
                    $centroCustoDesc = $cc['DESCRICAO'];
                }

                $dados_novos[] = [
                    'CC' => $centroCusto,
                    'DESCRICAO_CC' => $centroCustoDesc,
                    'GESTOR' => $value['GESTOR'],
                    'NOME_GESTOR' => $value['NOME_GESTOR'],
                    'QTD' => $value['QTD'],
                    'VALOR RATEIO' => number_format($value['VALOR RATEIO'], 4, ',', ''),
                    'PERCENTUAL' => number_format($value['PERCENTUAL'], 4, ',', ' '),
                ];
            }
            //dump($dados_novos); exit;

            return new ObjectPhalcon($dados_novos);
        } else {
            throw new \Exception('Não dados a exibir.');
        }
    }

    public function getRateioEmails($comp = NULL, $valor = 0)
    {
        $connection = $this->customSimpleQuery('telefoniaDb');

        $query = "
      SELECT TRIM(CC) CC, QTD,
        REPLACE(TO_CHAR(ROUND(((QTD * $valor) / TOT_QTD), 4)), '.', ',') \"VALOR RATEIO\",
        REPLACE(TO_CHAR(ROUND(((QTD * 100) / TOT_QTD), 4)), '.', ',') PERCENTUAL
      FROM
        (SELECT TRIM(CC) CC, QTD,
          (SELECT COUNT(1) QTD
          FROM PRODUCAO_9ZGXI5.SZH010@PROTHEUSPROD SZH
          INNER JOIN PRODUCAO_9ZGXI5.SZG010@PROTHEUSPROD SZG
          ON SZG.D_E_L_E_T_ = ' '
          AND SZG.ZG_CPF = SZH.ZH_CPF
          WHERE SZH.D_E_L_E_T_ = ' '
          AND SZH.ZH_EMPRESA BETWEEN '01' AND '99'
          AND SZH.ZH_CCEO IN
            (SELECT CTT.CTT_CUSTO
            FROM PRODUCAO_9ZGXI5.V_BI_CTT@PROTHEUSPROD CTT
            WHERE CTT.D_E_L_E_T_ = ' '
            AND (CTT.CTT_XBLMOV = ' '
            OR SUBSTR(CTT.CTT_XBLMOV,1,6) > '$comp'))
          AND TRIM(SZG.ZG_STATUS) <> 'CLOSED'
          ) TOT_QTD
        FROM
          (SELECT TRIM(SZH.ZH_CCEO) CC, COUNT(1) QTD
          FROM PRODUCAO_9ZGXI5.SZH010@PROTHEUSPROD SZH
          INNER JOIN PRODUCAO_9ZGXI5.SZG010@PROTHEUSPROD SZG
          ON SZG.D_E_L_E_T_ = ' '
          AND SZG.ZG_CPF = SZH.ZH_CPF
          WHERE SZH.D_E_L_E_T_ = ' '
          AND SZH.ZH_EMPRESA BETWEEN '01' AND '99'
          AND SZH.ZH_CCEO IN
            (SELECT CTT.CTT_CUSTO
            FROM PRODUCAO_9ZGXI5.V_BI_CTT@PROTHEUSPROD CTT
            WHERE CTT.D_E_L_E_T_ = ' '
            AND (CTT.CTT_XBLMOV = ' '
            OR SUBSTR(CTT.CTT_XBLMOV,1,6) > '$comp'))
          AND TRIM(SZG.ZG_STATUS) <> 'CLOSED'
          GROUP BY TRIM(SZH.ZH_CCEO)
          ) A1
        GROUP BY TRIM(CC), QTD
        ) A3
      ORDER BY 1";

        $return = $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);

        if (empty($return)) {
            throw new \Exception('Não dados a exibir.');
        }
        return new ObjectPhalcon($return);
    }

    public function getRateioCorporativo($comp = NULL, $valor = 0)
    {

        $connection = $this->customSimpleQuery('telefoniaDb');

        $query = "
      SELECT TRIM(CC) CC, QTD,
        REPLACE(TO_CHAR(ROUND(((QTD * $valor) / TOT_QTD), 4)), '.', ',') \"VALOR RATEIO\",
        REPLACE(TO_CHAR(ROUND(((QTD * 100) / TOT_QTD), 4)), '.', ',') PERCENTUAL
      FROM
        (SELECT TRIM(CC) CC, QTD,
          (SELECT COUNT(1) QTD
            FROM PRODUCAO_9ZGXI5.V_BI_CTT@PROTHEUSPROD CTT
            WHERE CTT.D_E_L_E_T_ = ' '
              AND CTT.CTT_CLASSE = '2'
              AND SUBSTR(CTT.CTT_CUSTO,1,1) = '0'
              AND (CTT.CTT_XBLMOV = ' '
              OR SUBSTR(CTT.CTT_XBLMOV,1,6) > '$comp')
          ) TOT_QTD
        FROM
          (SELECT TRIM(CTT.CTT_CUSTO) CC, COUNT(1) QTD
          FROM PRODUCAO_9ZGXI5.V_BI_CTT@PROTHEUSPROD CTT
            WHERE CTT.D_E_L_E_T_ = ' '
              AND CTT.CTT_CLASSE = '2'
              AND SUBSTR(CTT.CTT_CUSTO,1,1) = '0'
              AND (CTT.CTT_XBLMOV = ' '
              OR SUBSTR(CTT.CTT_XBLMOV,1,6) > '$comp')
          GROUP BY TRIM(CTT.CTT_CUSTO)
          ) A1
        GROUP BY TRIM(CC), QTD
        ) A3
      ORDER BY 1";

        $return = $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);

        if (empty($return)) {
            throw new \Exception('Não dados a exibir.');
        }
        return new ObjectPhalcon($return);
    }

}
