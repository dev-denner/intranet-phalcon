<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models\Protheus;

use DevDenners\Models\ModelBase;

class CentroCustos extends ModelBase {

    protected $cttCusto;
    protected $cttClasse;
    protected $cttDesc;
    protected $cttXblmov;
    protected $cttCcsup;
    protected $cttOperac;
    protected $cttSdel;

    public function getCttCusto() {
        return $this->cttCusto;
    }

    public function getCttClasse() {
        return $this->cttClasse;
    }

    public function getCttDesc() {
        return $this->cttDesc;
    }

    public function getCttXblmov() {
        $myDateTime = \DateTime::createFromFormat('d/m/y', $this->cttXblmov);
        return $myDateTime->format('d/m/Y');
    }

    public function getCttCcsup() {
        return $this->cttCcsup;
    }

    public function getCttOperac() {
        return $this->cttOperac;
    }

    public function getCttSdel() {
        return $this->cttSdel;
    }

    public function setCttCusto($cttCusto) {
        $this->cttCusto = $cttCusto;
        return $this;
    }

    public function setCttClasse($cttClasse) {
        $this->cttClasse = $cttClasse;
        return $this;
    }

    public function setCttDesc($cttDesc) {
        $this->cttDesc = $cttDesc;
        return $this;
    }

    public function setCttXblmov($cttXblmov) {
        $this->cttXblmov = $cttXblmov;
        return $this;
    }

    public function setCttCcsup($cttCcsup) {
        $this->cttCcsup = $cttCcsup;
        return $this;
    }

    public function setCttOperac($cttOperac) {
        $this->cttOperac = $cttOperac;
        return $this;
    }

    public function setCttSdel($cttSdel) {
        $this->cttSdel = $cttSdel;
        return $this;
    }

    public function initialize() {

        parent::initialize();

        $this->setSchema('PRODUCAO_9ZGXI5');
        $this->setConnectionService('protheusDb');
        $this->setReadConnectionService('protheusDb');
    }

    public function getSource() {
        return 'CTT010';
    }

    public static function columnMap() {
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

}
