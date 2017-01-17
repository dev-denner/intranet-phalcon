<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace App\Modules\Nucleo\Models\Protheus;

use App\Shared\Models\ModelBase;

class Protheus extends ModelBase
{

    public function initialize()
    {

        parent::initialize();

        $this->setSchema('PRODUCAO_9ZGXI5');
        $this->setConnectionService('protheusDb');
        $this->setReadConnectionService('protheusDb');
    }

    public static function columnMap()
    {
        return [];
    }

    public function getEmpresasProtheus($empresa = '')
    {

        $search = '';

        if (!empty($empresa)) {
            $search .= " AND TRIM(Z9_CODIGO) = '{$empresa}'";
        }

        $connection = $this->customSimpleQuery();
        $query = "SELECT DISTINCT TRIM(Z9_CODIGO) \"code\",
                                  TRIM(Z9_NOMECOM) \"name\"
                  FROM {$this->schema}.SZ9010
                  WHERE D_E_L_E_T_ = ' ' {$search}
                  ORDER BY 2";
        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

    public function getEmpresasGrupo($empresa = '')
    {

        $search = '';

        if (!empty($empresa)) {
            $search .= " AND EMPRESA = '{$empresa}'";
        }

        $connection = $this->customSimpleQuery();
        $query = "SELECT CODIGO \"code\", EMPRESA \"name\"
                  FROM (
                        SELECT ZH_EMPRESA CODIGO,
                               CASE ZH_EMPRESA
                                  WHEN '01' THEN 'MPE MONTAGENS'
                                  WHEN '02' THEN 'EBE'
                                  WHEN '03' THEN 'MPE ENGENHARIA'
                                  WHEN '04' THEN 'GEMON'
                                  WHEN '05' THEN 'VALENÇA'
                                  WHEN '06' THEN 'AGROMOM'
                                  WHEN '07' THEN 'AAT'
                                  WHEN '08' THEN 'TEIA'
                                  WHEN '09' THEN 'SOAHGRO'
                                  WHEN '10' THEN 'MPE PAINEIS'
                                  WHEN '11' THEN 'IRLA'
                                  WHEN '12' THEN 'CANARI'
                                  WHEN 'D8' THEN 'FW GEMON'
                                  ELSE ZH_EMPRESA
                               END EMPRESA
                        FROM {$this->schema}.SZH010
                        WHERE D_E_L_E_T_ = ' '
                        )
                  WHERE 1 = 1 {$search}
                  ORDER BY 2";
        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

    public function getFiliais($empresa = '', $filial = '')
    {

        $search = '';

        if (!empty($empresa)) {
            $search .= " AND TRIM(Z9_CODIGO) = '{$empresa}'";
        }
        if (!empty($filial)) {
            $search .= " AND TRIM(Z9_CODFIL) = '{$filial}'";
        }

        $connection = $this->customSimpleQuery();
        $query = "SELECT DISTINCT TRIM(Z9_CODIGO) \"codEmpresa\",
                                  TRIM(Z9_NOMECOM) \"nameEmpresa\",
                                  TRIM(Z9_CODFIL) \"code\",
                                  TRIM(Z9_NOME) \"name\"
                  FROM {$this->schema}.SZ9010
                  WHERE D_E_L_E_T_ = ' ' {$search}
                  ORDER BY 1, 2";

        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

    public function getClientes($cliente = '')
    {

        $search = '';

        if (!empty($cliente)) {
            $search .= " AND TRIM(A1_CGC) = '{$cliente}'";
        }

        $connection = $this->customSimpleQuery();
        $query = "SELECT DISTINCT TRIM(A1_CGC) \"cnpj\",
                                  TRIM(A1_NOME) \"razao\",
                                  TRIM(A1_NREDUZ) \"name\",
                                  TRIM(A1_COD) \"code\",
                                  TRIM(A1_LOJA) \"loja\"
                  FROM {$this->schema}.SA1010
                  WHERE D_E_L_E_T_ = ' ' {$search}
                  ORDER BY 1, 2";
        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

    public function getGestores($gestor = '')
    {

        $search = '';

        if (!empty($gestor)) {
            $search .= " AND TRIM(ZB_CODIGO) IN '('" . implode("', '", json_decode($gestor)) . "')'";
        }

        $connection = $this->customSimpleQuery();
        $query = "SELECT DISTINCT TRIM(ZB_CODIGO) \"code\",
                                  TRIM(ZB_NOME) \"name\"
                  FROM {$this->schema}.SZB010
                  WHERE D_E_L_E_T_ = ' ' {$search}
                  ORDER BY 2";
        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

    public function getItensContabeis($itemContabil = '')
    {

        $search = '';

        if (!empty($itemContabil)) {
            $search .= " AND TRIM(CTD_ITEM) = '{$itemContabil}'";
        }

        $connection = $this->customSimpleQuery();
        $query = "SELECT DISTINCT TRIM(CTD_ITEM) \"code\",
                                  TRIM(CTD_DESC01) \"name\"
                  FROM {$this->schema}.CTD010
                  WHERE D_E_L_E_T_ = ' ' {$search}
                  ORDER BY 2";
        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

    public function getClassesValores($classeValor = '')
    {

        $search = '';

        if (!empty($classeValor)) {
            $search .= " AND TRIM(CTH_CLVL) = '{$classeValor}'";
        }

        $connection = $this->customSimpleQuery();
        $query = "SELECT DISTINCT TRIM(CTH_CLVL) \"code\",
                                  TRIM(CTH_DESC01) \"name\"
                  FROM {$this->schema}.CTH010
                  WHERE D_E_L_E_T_ = ' ' {$search}
                  ORDER BY 2";
        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

    public function getColaboradores($colaborador = '')
    {

        $search = '';

        if (!empty($colaborador)) {
            $search .= " AND CPF = '{$colaborador}'";
        }

        $connection = $this->customSimpleQuery('db');

        $query = "SELECT * FROM VW_COLABORADOR_PROTHEUS WHERE 1 = 1 {$search}";

        return $connection->fetchOne($query, \Phalcon\Db::FETCH_ASSOC);
    }

    public function getColaboradoresByEmail($email = '')
    {

        $search = '';

        if (!empty($email)) {
            $search .= " AND EMAIL IN ('{$email}')";
        }

        $connection = $this->customSimpleQuery('db');

        $query = "SELECT * FROM VW_COLABORADOR_PROTHEUS WHERE 1 = 1 {$search}";

        return $connection->fetchOne($query, \Phalcon\Db::FETCH_ASSOC);
    }

    public function getDepartamento($departamento = '')
    {

        $search = '';

        if (!empty($departamento)) {
            $search .= " AND TRIM(ZC_CODIGO) = '{$departamento}'";
        }

        $connection = $this->customSimpleQuery();
        $query = "SELECT DISTINCT TRIM(ZC_CODIGO) code,
                                  TRIM(ZC_DESCR) name
                  FROM {$this->schema}.SZC010
                  WHERE D_E_L_E_T_ = ' ' {$search}
                  ORDER BY 2";
        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

    public function getCentroCustoBase($cc = [])
    {

        $search = '';

        if (!empty($cc)) {
            if (isset($cc['code']) && !empty($cc['code'])) {

                $search .= " AND TRIM(CTT_CUSTO) IN ({$cc['code']})";
            }

            if (isset($cc['gestor']) && !empty($cc['gestor'])) {
                $search .= " AND TRIM(CTT_XGEST) IN ({$cc['gestor']})";
            }
        }

        $connection = $this->customSimpleQuery();
        $query = "SELECT TRIM(CTT_CUSTO) \"code\",
                         TRIM(CTT_DESC01) \"name\"
                  FROM {$this->schema}.CTT010
                  WHERE D_E_L_E_T_ = ' ' {$search}
                    AND LENGTH(TRIM(CTT_CUSTO)) = 4
                    AND TRIM(CTT_XBLMOV) IS NULL
                  ORDER BY 1";

        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

    public function getColaboradoresKeyEmail()
    {
        $connection = $this->customSimpleQuery('db');
        $query = "SELECT * FROM VW_COLABORADOR_PROTHEUS WHERE TRIM(EMAIL) IS NOT NULL";
        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

}
