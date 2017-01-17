<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace App\Modules\Nucleo\Models\Protheus;

use App\Shared\Models\ModelBase;

class ProdutosAdicionais extends ModelBase {

    public $sb5Cod;
    public $sb5Ceme;
    public $sb5Sdel;

    public function initialize() {

        parent::initialize();

        $this->setSchema('PRODUCAO_9ZGXI5');
        $this->setConnectionService('protheusDb');
        $this->setReadConnectionService('protheusDb');

        $this->hasMany('sb5Cod', __NAMESPACE__ . '\ProdutosDescricao', 'sb1Cod', ['alias' => 'ProdutosDescricao',]);
    }

    public function getSource() {
        return 'SB5010';
    }

    public static function columnMap() {
        return [
            'B5_COD' => 'sb5Cod',
            'B5_CEME' => 'sb5Ceme',
            'D_E_L_E_T_' => 'sb5Sdel',
        ];
    }

}
