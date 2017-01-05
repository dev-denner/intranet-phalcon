<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Forms\Controllers;

use Forms\Models\IndicadoresSgi;
use Nucleo\Models\Protheus\CentroCustos;
use SysPhalcon\Controllers\ControllerBase;

class IndicadoresSgiController extends ControllerBase {

    /**
     * initialize
     */
    public function initialize() {
        $this->tag->setTitle('Formulário de Indicadores do SGI');
        parent::initialize();
    }

    /**
     * Index action
     */
    public function indexAction() {
        try {
            $cpf = $this->auth_identity->cpf;

            if ($this->request->isPost()) {
                $search = "cpf = '{$cpf}' ";
                $comp = $this->request->getPost('comp', 'string');
                if (!empty($comp)) {
                    $comp = explode('/', $comp);
                    $search .= "AND mesComp = '{$comp[0]}' AND anoComp = '{$comp[1]}'";
                }
                $this->view->indicadores_sgi = IndicadoresSgi::find($search);
                $this->view->pesquisa = $this->request->getPost('comp');
            } else {
                $this->view->indicadores_sgi = IndicadoresSgi::findByCpf($cpf);
                $this->view->pesquisa = '';
            }
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
        }
    }

    public function newAction() {
        $this->assets->collection('footerJs')->addJs('app/forms/indicadores_sgi/formulas.js');
    }

    public function editAction($id) {
        try {
            $this->assets->collection('footerJs')->addJs('app/forms/indicadores_sgi/formulas.js');

            if ($this->request->isPost()) {
                throw new \Exception('Acesso inválido a essa action!!!');
            }

            $indicadores_sgi = IndicadoresSgi::findFirstByid($id);
            if (!$indicadores_sgi) {
                throw new \Exception('Indicadores não encontrado!');
            }

            $this->view->id = $indicadores_sgi->id;
            $this->makeGetObject($indicadores_sgi);
            $comp = str_pad($indicadores_sgi->mesComp, 2, 0, STR_PAD_LEFT) . '/' . $indicadores_sgi->anoComp;
            $this->tag->setDefault('comp', $comp);
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('forms/indicadores_sgi');
        }
    }

    public function createAction() {

        try {

            if (!$this->request->isPost()) {
                throw new \Exception('Acesso não permitido a essa action.');
            }

            $request = $this->request->getPost();

            $aux = explode('/', $request['comp']);

            $mesComp = (int) $aux[0];
            $anoComp = (int) $aux[1];
            $cc = $request['cc'];

            $indicadores_sgi = IndicadoresSgi::findFirst("mesComp = {$mesComp} AND anoComp = {$anoComp} AND cc = '{$cc}'");

            if ($indicadores_sgi) {
                throw new \Exception('Já exite Indicadores desse Centro de Custo para essa competência!');
            }

            $request['mesComp'] = $mesComp;
            $request['anoComp'] = $anoComp;

            unset($request['comp']);
            unset($request['files']);

            $request = $this->hidrateRequest($request);

            $indicadores_sgi = new IndicadoresSgi();
            $this->makeSetObject($request, $indicadores_sgi);

            $indicadores_sgi->setId($indicadores_sgi->autoincrement());

            if (!$indicadores_sgi->create()) {
                $msg = '';
                foreach ($indicadores_sgi->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new \Exception($msg);
            }

            $this->flash->success('Indicadores gravados com sucesso!!!');
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('forms/indicadores_sgi/new');
        }
        return $this->response->redirect('forms/indicadores_sgi');
    }

    public function saveAction() {
        try {

            if (!$this->request->isPost()) {
                throw new \Exception('Acesso não permitido a essa action.');
            }

            $request = $this->request->getPost();

            $aux = explode('/', $request['comp']);

            $request['mesComp'] = (int) $aux[0];
            $request['anoComp'] = (int) $aux[1];

            unset($request['comp']);
            unset($request['files']);

            $request = $this->hidrateRequest($request);

            $indicadores_sgi = new IndicadoresSgi();
            $this->makeSetObject($request, $indicadores_sgi);

            if (!$indicadores_sgi->update()) {
                $msg = '';
                foreach ($indicadores_sgi->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new \Exception($msg);
            }

            $this->flash->success('Indicadores atualizados com sucesso!!!');
        } catch (\PDOException $exc) {
            $this->flash->error($exc->getMessage());
        }
        return $this->response->redirect('forms/indicadores_sgi');
    }

    public function deleteAction() {

        try {
            if (!$this->request->isPost()) {
                throw new \Exception('Acesso não permitido a essa action.');
            }

            if ($this->request->isAjax()) {
                $this->view->disable();
            }

            $id = $this->request->getPost('id');

            $indicadores_sgi = IndicadoresSgi::findFirstByid($id);
            if (!$indicadores_sgi) {
                throw new \Exception('Gestão de Acesso não encontrado!');
            }

            if (!$indicadores_sgi->delete()) {

                $msg = '';
                foreach ($indicadores_sgi->getMessages() as $message) {
                    $msg .= $message . '<br />';
                }
                throw new \Exception($msg);
            }
            echo 'ok';
        } catch (\Exception $exc) {
            $this->flash->error($exc->getMessage());
            return $this->response->redirect('forms/indicadores_sgi');
        }
    }

    public function formulasAjaxAction() {
        if ($this->request->isAjax()) {

            $comp = $this->request->getPost('comp', 'string');
            $comp = explode('/', $comp);
            $cc = $this->request->getPost('cc', 'string');
            $field = $this->request->getPost('field', 'string');
            $this->view->disable();

            switch ($field) {
                case 'hherTotalAno':
                    echo json_encode($this->getSumHherTotalAnoAjax((int) $comp[0], (int) $comp[1], $cc));
                    break;
                case 'tfca':
                    echo json_encode($this->getSumTfcaAjax((int) $comp[0], (int) $comp[1], $cc));
                    break;
                case 'txGravAcum':
                    echo json_encode($this->getSumTxGravAcumAjax((int) $comp[0], (int) $comp[1], $cc));
                    break;
                case 'tfsa':
                    echo json_encode($this->getSumTfsaAjax((int) $comp[0], (int) $comp[1], $cc));
                    break;
                case 'tor':
                    echo json_encode($this->getSumTorAjax((int) $comp[0], (int) $comp[1], $cc));
                    break;

                default:
                    break;
            }
        }
    }

    private function getSumHherTotalAnoAjax($mes, $ano, $cc) {

        $indicadores_sgi = new IndicadoresSgi();
        $result = $indicadores_sgi->getSumHherTotalAno($mes, $ano, $cc);
        return $result[0]['NU_HHER_TOTAL_ANO'];
    }

    private function getSumTfcaAjax($mes, $ano, $cc) {

        $indicadores_sgi = new IndicadoresSgi();
        $result = $indicadores_sgi->getSumTfca($mes, $ano, $cc);
        return $result[0]['NU_TFCA'];
    }

    private function getSumTxGravAcumAjax($mes, $ano, $cc) {

        $indicadores_sgi = new IndicadoresSgi();
        $result = $indicadores_sgi->getSumTxGravAcum($mes, $ano, $cc);
        return $result[0]['NU_TX_GRAV_ACUM'];
    }

    private function getSumTfsaAjax($mes, $ano, $cc) {

        $indicadores_sgi = new IndicadoresSgi();
        $result = $indicadores_sgi->getSumTfsa($mes, $ano, $cc);
        return $result[0]['NU_TFSA'];
    }

    private function getSumTorAjax($mes, $ano, $cc) {

        $indicadores_sgi = new IndicadoresSgi();
        $result = $indicadores_sgi->getSumTor($mes, $ano, $cc);
        return $result[0]['NU_TOR'];
    }

}
