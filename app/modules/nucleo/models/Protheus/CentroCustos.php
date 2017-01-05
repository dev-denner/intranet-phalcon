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

class CentroCustos extends ModelBase
{

    protected $cttCusto;
    protected $cttClasse;
    protected $cttDesc;
    protected $cttXblmov;
    protected $cttCcsup;
    protected $cttOperac;
    protected $cttSdel;

    public function getCttCusto()
    {
        return $this->cttCusto;
    }

    public function getCttClasse()
    {
        return $this->cttClasse;
    }

    public function getCttDesc()
    {
        return $this->cttDesc;
    }

    public function getCttXblmov()
    {
        $myDateTime = \DateTime::createFromFormat('d/m/y', $this->cttXblmov);
        return $myDateTime->format('d/m/Y');
    }

    public function getCttCcsup()
    {
        return $this->cttCcsup;
    }

    public function getCttOperac()
    {
        return $this->cttOperac;
    }

    public function getCttSdel()
    {
        return $this->cttSdel;
    }

    public function setCttCusto($cttCusto)
    {
        $this->cttCusto = $cttCusto;
        return $this;
    }

    public function setCttClasse($cttClasse)
    {
        $this->cttClasse = $cttClasse;
        return $this;
    }

    public function setCttDesc($cttDesc)
    {
        $this->cttDesc = $cttDesc;
        return $this;
    }

    public function setCttXblmov($cttXblmov)
    {
        $this->cttXblmov = $cttXblmov;
        return $this;
    }

    public function setCttCcsup($cttCcsup)
    {
        $this->cttCcsup = $cttCcsup;
        return $this;
    }

    public function setCttOperac($cttOperac)
    {
        $this->cttOperac = $cttOperac;
        return $this;
    }

    public function setCttSdel($cttSdel)
    {
        $this->cttSdel = $cttSdel;
        return $this;
    }

    public function initialize()
    {

        parent::initialize();

        $this->setSchema('PRODUCAO_9ZGXI5');
        $this->setConnectionService('protheusDb');
        $this->setReadConnectionService('protheusDb');
        $this->hasMany('cttCusto', 'Forms\Models\GestaoAcesso', 'amarracao', ['alias' => 'GestaoAcesso',]);
    }

    public function getSource()
    {
        return 'CTT010';
    }

    public static function columnMap()
    {
        return [
            'CTT_CUSTO' => 'cttCusto',
            'CTT_CLASSE' => 'cttClasse',
            'CTT_DESC01' => 'cttDesc',
            'CTT_XBLMOV' => 'cttXblmov',
            'CTT_CCSUP' => 'cttCcsup',
            'CTT_OPERAC' => 'cttOperac',
            'D_E_L_E_T_' => 'cttSdel',
        ];
    }

    public function getCentroCusto($search)
    {

        $connection = $this->customSimpleQuery();

        if (!empty($search)) {
            $search = "AND (UPPER(CTT.CTT_CUSTO) LIKE '%{$search}%'
                OR UPPER(CTT.CTT_DESC01) LIKE '%{$search}%'
                OR UPPER(SZ9.Z9_CODIGO) LIKE '%{$search}%'
                OR UPPER(SZ9.Z9_NOMECOM) LIKE '%{$search}%'
                OR UPPER(SZB.ZB_CODIGO) LIKE '%{$search}%'
                OR UPPER(SZB.ZB_NOME) LIKE '%{$search}%'
                OR UPPER(TSZ.TSZ_CODSER) LIKE '%{$search}%'
                OR UPPER(TSZ.TSZ_DESSER) LIKE '%{$search}%')";
        }

        $query = "
            SELECT TRIM(CTT.CTT_CUSTO) CODIGO_CC,
                   TRIM(CTT.CTT_DESC01) DESCRICAO_CC,
                   TRIM(SZ9.Z9_CODIGO) CODIGO_EMPRESA,
                   UPPER(TRIM(SZ9.Z9_NOMECOM)) NOME_EMPRESA,
                   TRIM(SZB.ZB_CODIGO) CODIGO_GESTOR,
                   TRIM(SZB.ZB_NOME) NOME_GESTOR,
                   TRIM(TSZ.TSZ_CODSER) CODIGO_OPERACAO,
                   TRIM(TSZ.TSZ_DESSER) DESCRICAO_OPERACAO,
                   CASE
                        WHEN TRIM(CTT.CTT_XBLMOV) IS NOT NULL
                        THEN TO_CHAR(TO_DATE(CTT.CTT_XBLMOV, 'YYYYMMDD'), 'DD/MM/YYYY')
                        ELSE NULL
                    END DATA_BLOQUEIO,
                    TRIM(CTT.CTT_XPARA) NOVO_CODIGO_CC
            FROM {$this->schema}.CTT010 CTT
            LEFT JOIN (
                SELECT DISTINCT SQSZ9.Z9_CODIGO, SQSZ9.Z9_NOMECOM
                FROM {$this->schema}.SZ9010 SQSZ9
                WHERE SQSZ9.D_E_L_E_T_ = ' '
                  AND SQSZ9.Z9_CODFIL = '01'
                ) SZ9
            ON SZ9.Z9_CODIGO = CTT.CTT_MAT
            LEFT JOIN {$this->schema}.SZB010 SZB
            ON SZB.D_E_L_E_T_ = ' '
            AND SZB.ZB_CODIGO = CTT.CTT_XGEST
            LEFT JOIN {$this->schema}.TSZ010 TSZ
            ON TSZ.D_E_L_E_T_ = ' '
            AND TSZ.TSZ_CODSER = CTT.CTT_OPERAC
            WHERE CTT.D_E_L_E_T_ = ' '
            {$search}
            ORDER BY CTT.CTT_CUSTO";

            //echo $query, exit;

          return new ObjectPhalcon($connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC));

    }

    public function getCentroCustoByParent($search)
    {

        $connection = $this->customConnection();

        if (!empty($search)) {
            $search = "AND TRIM(CTT_CUSTO) LIKE '{$search}%'";
        }

        $query = "
            SELECT TRIM(CTT_CUSTO) CODIGO, TRIM(CTT_DESC01) DESCRICAO
            FROM PRODUCAO_9ZGXI5.CTT010
            WHERE D_E_L_E_T_ = ' '
                AND LENGTH(TRIM(CTT_CUSTO)) = 4
                AND SUBSTR(TRIM(CTT_CUSTO), 1, 1) <> '1'
                AND TRIM(CTT_XBLMOV) IS NULL
                {$search}
            UNION ALL
            SELECT TRIM(CTT_CUSTO), TRIM(CTT_DESC01)
            FROM {$this->schema}.CTT010
            WHERE D_E_L_E_T_ = ' '
                AND LENGTH(TRIM(CTT_CUSTO)) = 7
                AND SUBSTR(TRIM(CTT_CUSTO), 1, 1) = '1'
                AND TRIM(CTT_XBLMOV) IS NULL
                {$search}
            ORDER BY 1";

        $result = $connection->select($query);
        $return = $connection->fetchAll($result);
        $connection->bye();
        return new ObjectPhalcon($return);
    }

    public function getDepartamento($cc = '')
    {

        $connection = $this->customSimpleQuery('protheusDb');

        $query = "SELECT SX.X5_DESCRI departamento
                  FROM {$this->schema}.CTT010 CT
                  LEFT JOIN {$this->schema}.SX5010 SX
                      ON SX.X5_TABELA       = 'ZV'
                     AND TRIM(SX.X5_CHAVE) = TRIM(CT.CTT_XDEPTO)
                  WHERE CT.D_E_L_E_T_ = ' '
                    AND TRIM(CTT_XBLMOV) IS NULL
                    AND TRIM(CT.CTT_CUSTO) = ?";

        return $connection->fetchOne($query, \Phalcon\Db::FETCH_ASSOC, [$cc]);
    }

}
