<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models\RM;

use SysPhalcon\Models\ModelBase;

class RM extends ModelBase {

    public function initialize() {

        parent::initialize();

        $this->setSchema('RM');
        $this->setConnectionService('rmDb');
        $this->setReadConnectionService('rmDb');
    }

    public static function columnMap() {
        return [];
    }

    public function getVerbas($verba = '') {

        $search = '';

        if (!empty($verba)) {
            $search .= " AND CODIGO = '{$verba}'";
        }

        $connection = $this->customSimpleQuery('rmDb');
        $query = "SELECT DISTINCT CODIGO \"code\", UPPER(DESCRICAO) \"name\"
                  FROM {$this->schema}.PEVENTO
                  WHERE UPPER(DESCRICAO) NOT LIKE '%N%O UTILIZAR%' {$search}
                  ORDER BY 2";
        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

}
