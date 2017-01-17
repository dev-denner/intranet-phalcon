<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace App\Modules\Nucleo\Models\RM;

use App\Shared\Models\ModelBase;

class Perfil extends ModelBase {

    public function initialize() {

        parent::initialize();

        $this->setSchema('RM');
        $this->setConnectionService('rmDb');
        $this->setReadConnectionService('rmDb');
    }

    public function getSource() {
        return 'GPERFIL';
    }

    public static function columnMap() {
        return [];
    }

    public function getPerfil($search = '') {

        if (!empty($search)) {
            $search = "AND (UPPER(CODPERFIL) LIKE UPPER('%{$search}%')
                         OR UPPER(NOME) LIKE UPPER('%{$search}%'))";
        }

        $query = "SELECT UPPER(CODPERFIL) CODPERFIL,
                         UPPER(REPLACE(NOME, 'Corporativo ', '')) NOME
                  FROM RM.GPERFIL
                  WHERE CODSISTEMA = 'P'
                    AND STATUS = 1
                    AND CODPERFIL NOT IN('Admin', 'DP-AISP-NOVO', 'PortalRH-Envel')
                    {$search}
                  ORDER BY 2";

        $connection = $this->customSimpleQuery('rmDb');
        return $connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC);
    }

}
