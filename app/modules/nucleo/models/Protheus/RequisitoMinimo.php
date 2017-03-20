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

class RequisitoMinimo extends ModelBase {

    public function initialize() {

        parent::initialize();

        $this->setSchema('PRODUCAO_9ZGXI5');
        $this->setConnectionService('protheusDb');
        $this->setReadConnectionService('protheusDb');
    }

    public function getSource() {
        return 'SZ5010';
    }

    public static function columnMap() {
        return [];
    }

    public function getRequisitoMinimo($search = '') {

        $connection = $this->customSimpleQuery('protheusDb');

        if (!empty($search)) {
            $search = "AND (SZ5.Z5_CODIGO LIKE '%{$search}%'
                OR SZ5.Z5_DESC LIKE '%{$search}%'
                OR SZ4.Z4_CODIGO LIKE '%{$search}%'
                OR SZ4.Z4_DESC LIKE '%{$search}%')";
        }

        $query = "
            SELECT TRIM(SZ5.Z5_CODIGO) CODIGO_REQMIN,
                   TRIM(SZ5.Z5_DESC) DESCRICAO_REQMIN,
                   TRIM(SZ4.Z4_CODIGO) CODIGO_GRUPO,
                   TRIM(SZ4.Z4_DESC) DESCRICAO_GRUPO
            FROM {$this->schema}.SZ5010 SZ5
            LEFT JOIN {$this->schema}.SZ4010 SZ4
            ON SZ4.D_E_L_E_T_ = ' '
            AND SZ4.Z4_CODIGO = SZ5.Z5_GRUPO
            WHERE SZ5.D_E_L_E_T_ = ' '
            {$search}
            ORDER BY SZ5.Z5_CODIGO";

        return new ObjectPhalcon(@$connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC));
    }

}
