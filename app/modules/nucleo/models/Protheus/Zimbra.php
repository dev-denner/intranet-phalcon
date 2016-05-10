<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models\Protheus;

use SysPhalcon\Models\ModelBase;

class Zimbra extends ModelBase {

    protected $szgEmail;
    protected $szgNome;
    protected $szgStatus;
    protected $szgObs;
    protected $szgSdel;

    public function initialize() {

        parent::initialize();

        $this->setSchema('PRODUCAO_9ZGXI5');
        $this->setConnectionService('protheusDb');
        $this->setReadConnectionService('protheusDb');

        $this->hasMany('szgEmail', __NAMESPACE__ . '\Colaboradores', 'szhEmail', ['alias' => 'Colaboradores',]);
    }

    public function getSource() {
        return 'SZG010';
    }

    public static function columnMap() {
        return [
            'ZG_EMAIL' => 'szgEmail',
            'ZG_NOME' => 'szgNome',
            'ZG_STATUS' => 'szgStatus',
            'ZG_OBS' => 'szgObs',
            'D_E_L_E_T_' => 'szgSdel',
        ];
    }

}
