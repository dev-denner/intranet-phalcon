<?php

/**
 * @copyright   2015 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Forms\Controllers;

use App\Modules\Forms\Models\IndicadoresSgi;
use App\Modules\Forms\Models\GestaoAcesso;
use App\Modules\Nucleo\Models\Protheus\CentroCustos;
use App\Shared\Controllers\ControllerBase;
use App\Library\ExportFile\ExportExcel;

class IndicadoresSgiController extends ControllerBase
{

    /**
     * initialize
     */
    public function initialize()
    {
        $this->tag->setTitle('Formulário de Indicadores do SGI');
        parent::initialize();
    }

    /**
     * Index action
     */
    public function indexAction()
    {
        try {
            $userId = $this->auth_identity->userId;
            $gestaoAcesso = GestaoAcesso::find("nomeFormulario = 'Indicadores SGI' AND userId = {$userId}");
            $search = '';
            $all = false;
            foreach ($gestaoAcesso as $cc) {
                $search .= "'{$cc->amarracao}', ";
                if ($cc->amarracao == 'Todos') {
                    $all = true;
                }
            }
            $search = 'cc IN(' . substr($search, 0, -2) . ') ';
            if ($all) {
                $search = null;
            }
            $this->view->indicadores_sgi = IndicadoresSgi::find($search);
            $this->view->pesquisa = '';

            if ($this->request->isPost()) {
                $comp = $this->request->getPost('comp', 'string');
                if (!empty($comp)) {
                    $comp = explode('/', $comp);
                    $search .= "AND mesComp = '{$comp[0]}' AND anoComp = '{$comp[1]}'";
                }
                $this->view->indicadores_sgi = IndicadoresSgi::find($search);
                $this->view->pesquisa = $this->request->getPost('comp');
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function newAction()
    {
        $userId = $this->auth_identity->userId;
        $search = "nomeFormulario = 'Indicadores SGI' AND userId = '{$userId}'";
        $searchTodos = $search . " AND amarracao = 'Todos'";
        $gestaoAcesso = GestaoAcesso::findFirst($searchTodos);
        if ($gestaoAcesso !== false && $gestaoAcesso->amarracao == 'Todos') {
            $centroCusto = new CentroCustos();
            $centroCusto->getCentroCustoByParent();

            $gestaoAcesso = $centroCusto->getCentroCustoByParent();
            foreach ($gestaoAcesso as $key => $value) {
                $viewGestaoAcesso[$value->CODIGO . ' - ' . $value->DESCRICAO] = $value->CODIGO . ' - ' . $value->DESCRICAO;
            }
        } else {
            $gestaoAcesso = GestaoAcesso::find(['columns' => 'DISTINCT amarracao', 'conditions' => $search, 'order' => 'amarracao'])->toArray(0);
            foreach ($gestaoAcesso as $key => $value) {
                $viewGestaoAcesso[$value['AMARRACAO']] = $value['AMARRACAO'];
            }
        }

        $this->view->gestaoAcesso = $viewGestaoAcesso;
        $this->assets->collection('footerJs')->addJs('app/forms/indicadores_sgi/formulas.js');
    }

    public function editAction($id)
    {
        try {
            $this->assets->collection('footerJs')->addJs('app/forms/indicadores_sgi/formulas.js');

            if ($this->request->isPost()) {
                throw new \Exception('Acesso inválido a essa action!!!');
            }

            $indicadores_sgi = IndicadoresSgi::findFirstByid($id);
            if (!$indicadores_sgi) {
                throw new \Exception('Indicadores não encontrado!');
            }

            $this->view->gestaoAcesso = [$indicadores_sgi->cc => $indicadores_sgi->cc];

            $this->view->id = $indicadores_sgi->id;
            $this->makeGetObject($indicadores_sgi);
            $comp = str_pad($indicadores_sgi->mesComp, 2, 0, STR_PAD_LEFT) . '/' . $indicadores_sgi->anoComp;
            $this->tag->setDefault('comp', $comp);
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
            return $this->response->redirect('forms/indicadores_sgi');
        }
    }

    public function createAction()
    {

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
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
            return $this->response->redirect('forms/indicadores_sgi/new');
        }
        return $this->response->redirect('forms/indicadores_sgi');
    }

    public function saveAction()
    {
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
        } catch (\PDOException $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('forms/indicadores_sgi');
    }

    public function deleteAction()
    {

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
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
            return $this->response->redirect('forms/indicadores_sgi');
        }
    }

    public function relatorioAction()
    {

        $dados = [];

        if ($this->request->isPost()) {

            $IndicadoresSgi = new IndicadoresSgi();
            $dados = $IndicadoresSgi->getByComp($this->request->getPost('anoComp'), $this->request->getPost('cc'));
            $this->view->search = json_encode([
                'ano' => $this->request->getPost('anoComp'),
                'cc' => $this->request->getPost('cc'),
            ]);
        }

        $anoComps = IndicadoresSgi::find(['columns' => 'DISTINCT anoComp', 'order' => 'anoComp'])->toArray(0);
        foreach ($anoComps as $key => $value) {
            $anoComp[$value['ANOCOMP']] = $value['ANOCOMP'];
        }

        $ccs = IndicadoresSgi::find(['columns' => 'DISTINCT cc', 'order' => 'cc'])->toArray(0);
        foreach ($ccs as $key => $value) {
            $cc[$value['CC']] = $value['CC'];
        }

        $this->view->dados = $dados;
        $this->view->anoComp = $anoComp;
        $this->view->cc = $cc;
    }

    public function exportAction()
    {

        try {
            if (!$this->request->isPost()) {
                throw new \Exception('Acesso indevido a essa action');
            }

            $type = $this->request->getPost('type');
            $search = json_decode($this->request->getPost('search'), true);

            $IndicadoresSgi = new IndicadoresSgi();
            $dados = $IndicadoresSgi->getByComp($search['ano'], $search['cc']);

            $dados = $IndicadoresSgi->prepareDados($dados);
            $questions = $IndicadoresSgi->prepareQuestions($search);

            $options = [
                'creator' => 'Intranet - Grupo MPE',
                'title' => 'Indicadores SGI - Relatório: ' . $search['cc'] . ' - ' . $search['ano'],
                'category' => 'Relatórios',
            ];


            if ($type == 'excel') {
                $export = new ExportExcel;
                $objPhpExcel = $export->writeFileExcel($dados, $questions, $options);
            }
            exit;
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
            return $this->response->redirect('forms/indicadores_sgi/relatorio');
        }
    }

    public function formulasAjaxAction()
    {
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

    private function getSumHherTotalAnoAjax($mes, $ano, $cc)
    {

        $indicadores_sgi = new IndicadoresSgi();
        $result = $indicadores_sgi->getSumHherTotalAno($mes, $ano, $cc);
        return $result[0]['NU_HHER_TOTAL_ANO'];
    }

    private function getSumTfcaAjax($mes, $ano, $cc)
    {

        $indicadores_sgi = new IndicadoresSgi();
        $result = $indicadores_sgi->getSumTfca($mes, $ano, $cc);
        return $result[0]['NU_TFCA'];
    }

    private function getSumTxGravAcumAjax($mes, $ano, $cc)
    {

        $indicadores_sgi = new IndicadoresSgi();
        $result = $indicadores_sgi->getSumTxGravAcum($mes, $ano, $cc);
        return $result[0]['NU_TX_GRAV_ACUM'];
    }

    private function getSumTfsaAjax($mes, $ano, $cc)
    {

        $indicadores_sgi = new IndicadoresSgi();
        $result = $indicadores_sgi->getSumTfsa($mes, $ano, $cc);
        return $result[0]['NU_TFSA'];
    }

    private function getSumTorAjax($mes, $ano, $cc)
    {

        $indicadores_sgi = new IndicadoresSgi();
        $result = $indicadores_sgi->getSumTor($mes, $ano, $cc);
        return $result[0]['NU_TOR'];
    }

    private function styleSheet()
    {
        return [
            0 => [
                'A1:F1' => 'title',
                'A3' => 'bold',
                'A4:B5' => 'normal',
            ],
            1 => [
                'A1:N1' => 'title',
                'A2:N2' => 'header',
                'A3:N7' => 'normal',
                'A8:N8' => 'title',
                'A9:N9' => 'header',
                'A10:N22' => 'normal',
                'A23:N23' => 'title',
                'A24:N24' => 'header',
                'A25:N26' => 'normal',
                'A27:N27' => 'title',
                'A28:N28' => 'header',
                'A29:N30' => 'normal',
                'A31:N31' => 'title',
                'A32:N32' => 'header',
                'A33:N34' => 'normal',
            ],
            2 => [
                'A1:N1' => 'title',
                'A2:N2' => 'header',
                'A3:N6' => 'normal',
                'A7:N7' => 'title',
                'A8:N8' => 'header',
                'A9:N11' => 'normal',
            ]
        ];
    }

}
