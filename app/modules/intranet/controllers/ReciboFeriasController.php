<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Intranet\Controllers;

use App\Shared\Controllers\ControllerBase;
use App\Modules\Nucleo\Models\RM\Ferias;

class ReciboFeriasController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Recibo de Férias');
        parent::initialize();
    }

    public function indexAction() {

        $ferias = new Ferias();
        $this->view->recibo_ferias = $ferias->getListaReciboFerias((int) $this->auth_identity->coligada, $this->auth_identity->chapa);
    }

    public function viewAction($periodo) {

        $ferias = new Ferias();

        $coligada = (int) $this->auth_identity->coligada;
        $chapa = $this->auth_identity->chapa;

        $this->view->coligada = $ferias->getDadosColigada($coligada)[0];
        $this->view->colaborador = $ferias->getDadosColaborador($coligada, $chapa, $periodo)[0];
        $this->view->valores = $ferias->getValores($coligada, $chapa, $periodo);
        $this->view->totalizadores = $ferias->getTotalizadores($coligada, $chapa, $periodo)[0];

        $this->view->periodo = $periodo;
    }

}
