<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace App\Modules\Nucleo\Models\Protheus;

use App\Shared\Models\ModelBase;

class Filiais extends ModelBase {

    public function initialize() {

        parent::initialize();

        $this->setSchema('PRODUCAO_9ZGXI5');
        $this->setConnectionService('protheusDb');
        $this->setReadConnectionService('protheusDb');
    }

    public function getSource() {
        return 'SZ9010';
    }

    public static function columnMap() {
        return [];
    }

    public function getEmpresas($empresa = '') {

        $connection = $this->customSimpleQuery();
        $search = '';

        if (!empty($empresa)) {
            $search = " AND TRIM(Z9_CODIGO) = {$empresa}";
        }

        $query = "SELECT DISTINCT TRIM(Z9_CODIGO) CODEMPRESA,
                                  TRIM(Z9_NOMECOM) EMPRESA
                  FROM PRODUCAO_9ZGXI5.SZ9010
                  WHERE D_E_L_E_T_ = ' ' {$search}
                  ORDER BY 1";
        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

    public function getFiliais($empresa = '', $filial = '') {

        $connection = $this->customSimpleQuery();
        $search = '';

        if (!empty($empresa)) {
            $search .= " AND TRIM(Z9_CODIGO) = {$empresa}";
        }
        if (!empty($filial)) {
            $search .= " AND TRIM(Z9_CODFIL) = {$filial}";
        }

        $query = "SELECT DISTINCT TRIM(Z9_CODIGO) CODEMPRESA,
                                  TRIM(Z9_NOMECOM) EMPRESA,
                                  TRIM(Z9_CODFIL) CODFILIAL,
                                  TRIM(Z9_NOME) FILIAL
                  FROM PRODUCAO_9ZGXI5.SZ9010
                  WHERE D_E_L_E_T_ = ' ' {$search}
                  ORDER BY 3"
        ;

        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

}
