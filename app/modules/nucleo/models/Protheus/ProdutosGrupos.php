<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models\Protheus;

use SysPhalcon\Models\ModelBase;

class ProdutosGrupos extends ModelBase {

    public $sbmGrupo;
    public $sbmDesc;
    public $sbmxFlag;
    public $sbmSdel;

    public function initialize() {

        parent::initialize();

        $this->setSchema('PRODUCAO_9ZGXI5');
        $this->setConnectionService('protheusDb');
        $this->setReadConnectionService('protheusDb');

        $this->hasMany('sbmGrupo', __NAMESPACE__ . '\ProdutosDescricao', 'sb1Grupo', ['alias' => 'ProdutosDescricao',]);
    }

    public function getSource() {
        return 'SBM010';
    }

    public static function columnMap() {
        return [
            'BM_GRUPO' => 'sbmGrupo',
            'BM_DESC' => 'sbmDesc',
            'BM_XFLAG' => 'sbmxFlag',
            'D_E_L_E_T_' => 'sbmSdel',
        ];
    }

}
