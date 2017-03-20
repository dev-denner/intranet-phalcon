<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Otrs\Controllers;

use App\Shared\Controllers\ControllerBase;
use App\Modules\Otrs\Models\Chamados;

/**
 * Class AtendimentoController
 * @package Otrs\Controllers
 */
class AtendimentoController extends ControllerBase
{

    public function initialize()
    {
        $this->tag->setTitle('Atendimento');
        parent::initialize();
    }

    public function indexAction()
    {
        try {

            if ($this->request->isAjax()) {
                $this->view->disable();
                $return = $this->getEntityByAjax($this->request->getPost());
                echo json_encode($return);
                return true;
            }

            $this->verifyListagem();

            $this->view->pesquisa = '';
            $this->view->search = '';
            $this->view->export = false;

            if ($this->request->isPost()) {
                $search = $this->makeSearch($this->request->getPost());
                $this->view->chamados = Chamados::find(['conditions' => $search, 'order' => 'id']);
                $this->view->pesquisa = $this->makeSearchView($this->request->getPost());
                $this->view->search = json_encode($search, true);
                $this->view->export = true;
                $this->view->fields = Chamados::exportMap();
                $this->view->questions = json_encode($this->makeSearchExport($this->request->getPost()));
            }

            $tipo = isset($this->request->getPost()['tipo']) ? $this->request->getPost()['tipo'] : 'Abertos';

            $this->view->selTipo = $tipo;
            $this->view->tipo = $this->prepareFind(['columns' => 'DISTINCT tipo', 'order' => 'tipo'], 'TIPO');
            $this->view->fila = $this->prepareFind(['columns' => 'DISTINCT filaMaster fila', 'conditions' => "tipo = '$tipo'", 'order' => 'filaMaster'], 'FILA');
            $this->view->gestores = $this->prepareFind(['columns' => 'DISTINCT codGestor code, gestor', 'conditions' => "tipo = '$tipo'", 'order' => 'codGestor'], ['CODE', 'GESTOR'], 2);
            $this->view->ccs = $this->prepareFind(['columns' => 'DISTINCT masterCc cc, descCc', 'conditions' => "tipo = '$tipo'", 'order' => 'masterCc'], ['CC', 'DESCCC'], 2);
            $this->view->departamentos = $this->prepareFind(['columns' => 'DISTINCT codDepto code, depto', 'conditions' => "tipo = '$tipo'", 'order' => 'codDepto'], ['CODE', 'DEPTO'], 2);
            $this->view->cliente = $this->prepareFind(['columns' => 'DISTINCT cliente', 'conditions' => "tipo = '$tipo'", 'order' => 'cliente'], 'CLIENTE');
            $this->view->responsavel = $this->prepareFind(['columns' => 'DISTINCT responsavel', 'conditions' => "tipo = '$tipo'", 'order' => 'responsavel'], 'RESPONSAVEL');
            $this->view->proprietario = $this->prepareFind(['columns' => 'DISTINCT proprietario', 'conditions' => "tipo = '$tipo'", 'order' => 'proprietario'], 'PROPRIETARIO');
            $this->view->status = $this->prepareFind(['columns' => 'DISTINCT status', 'conditions' => "tipo = '$tipo'", 'order' => 'status'], 'STATUS');

            $this->assets->collection('footerJs')->addJs('app/otrs/atendimento/index.js');
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        } catch (\PDOException $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function relatorioAction()
    {
        try {

            if ($this->request->isPost()) {
                if (empty($this->request->getPost('fields'))) {
                    throw new \Exception('Erro: Nenhum campo foi escolhido. Tente novamente.');
                }
                $chamados = new Chamados();
                $chamados->report($this->request->getPost());
                return true;
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        } catch (\PDOException $e) {
            $this->flash->error($e->getMessage());
        }
        return $this->response->redirect('otrs/atendimento');
    }

    private function verifyListagem()
    {
        $chamados = new Chamados();
        return $chamados->compareChamados();
    }

    private static function prepareFind($conditions, $field, $type = 0)
    {
        $return = [];

        $dados = Chamados::find($conditions)->toArray(0);

        switch ($type) {
            case 1:
                foreach ($dados as $value) {
                    if ($value[$field[0]] != null) {
                        $return[$value[$field[0]]] = $value[$field[1]];
                    }
                }
                break;
            case 2:
                foreach ($dados as $value) {
                    if ($value[$field[0]] != null) {
                        $return[$value[$field[0]]] = $value[$field[0]] . ' - ' . $value[$field[1]];
                    }
                }
                break;
            case 3:
                foreach ($dados as $value) {
                    if ($value[$field[0]] != null) {
                        $return[$value[$field[0]] . ' - ' . $value[$field[1]]] = $value[$field[0]] . ' - ' . $value[$field[1]];
                    }
                }
                break;
            default:
                foreach ($dados as $value) {
                    if ($value[$field] != null) {
                        $return[$value[$field]] = $value[$field];
                    }
                }
                break;
        }
        return $return;
    }

    private function makeSearch($post)
    {

        $tipo = isset($post['tipo']) ? $post['tipo'] : 'Abertos';

        $return = '1 = 1';

        $return .= isset($post['tipo']) && !empty($post['tipo']) ? " AND tipo = '{$post['tipo']}'" : '';
        $return .= isset($post['assunto']) && !empty($post['assunto']) ? " AND assunto LIKE '%{$post['assunto']}%'" : '';
        $return .= isset($post['fila']) && !empty($post['fila']) ? " AND fila LIKE '{$post['fila']}%'" : '';
        if ($tipo == 'Abertos') {
            $return .= isset($post['dataDe']) && !empty($post['dataDe']) ? " AND dataAbertura >= " . $this->formateDateForAdapter($post['dataDe']) : '';
            $return .= isset($post['dataAte']) && !empty($post['dataAte']) ? " AND dataAbertura <= " . $this->formateDateForAdapter($post['dataAte']) : '';
        } else {
            $return .= isset($post['dataDe']) && !empty($post['dataDe']) ? " AND dataFechamento >= " . $this->formateDateForAdapter($post['dataDe']) : '';
            $return .= isset($post['dataAte']) && !empty($post['dataAte']) ? " AND dataFechamento <= " . $this->formateDateForAdapter($post['dataAte']) : '';
        }
        $return .= isset($post['gestor']) && !empty($post['gestor']) ? ' AND codGestor IN ' . $this->implodeQuery($post['gestor']) : '';
        $return .= isset($post['centrocusto']) && !empty($post['centrocusto']) ? ' AND masterCc IN ' . $this->implodeQuery($post['centrocusto']) : '';

        $return .= isset($post['departamento']) && !empty($post['departamento']) ? ' AND codDepto IN ' . $this->implodeQuery($post['departamento']) : '';
        $return .= isset($post['cliente']) && !empty($post['cliente']) ? ' AND cliente IN ' . $this->implodeQuery($post['cliente']) : '';
        $return .= isset($post['responsavel']) && !empty($post['responsavel']) ? ' AND responsavel IN ' . $this->implodeQuery($post['responsavel']) : '';
        $return .= isset($post['proprietario']) && !empty($post['proprietario']) ? ' AND proprietario IN ' . $this->implodeQuery($post['proprietario']) : '';
        $return .= isset($post['status']) && !empty($post['status']) ? ' AND status IN ' . $this->implodeQuery($post['status']) : '';
        return $return;
    }

    private function formateDateForAdapter($date, $adapter = 'oracle')
    {
        if ($adapter == 'mysql') {
            return "'" . implode('-', array_reverse(explode('/', $date))) . "'";
        }

        if ($adapter == 'oracle') {
            return "TO_DATE('" . $date . "', 'DD/MM/YYYY')";
        }
    }

    private function makeSearchView($search)
    {

        $return = '';

        if (!empty($search['tipo'])) {
            $return .= '<b>Tipo de Chamados:</b> ' . $search['tipo'];
        }
        if (!empty($search['assunto'])) {
            $return .= ' | <b>Título do Chamado:</b> ' . $search['assunto'];
        }
        if (!empty($search['fila'])) {
            $return .= ' | <b>Fila:</b> ' . $search['fila'];
        }
        if (!empty($search['dataDe'])) {
            $return .= ' | <b>Data de:</b> ' . $search['dataDe'];
        }
        if (!empty($search['dataAte'])) {
            $return .= ' | <b>Data até:</b> ' . $search['dataAte'];
        }
        if (isset($search['gestor'])) {
            $return .= $this->makeSearchHidratate($search['gestor'], 'Gestor');
        }
        if (isset($search['centrocusto'])) {
            $return .= $this->makeSearchHidratate($search['centrocusto'], 'Centro de Custo');
        }
        if (isset($search['departamento'])) {
            $return .= $this->makeSearchHidratate($search['departamento'], 'Departamento');
        }
        if (isset($search['cliente'])) {
            $return .= $this->makeSearchHidratate($search['cliente'], 'Cliente');
        }
        if (isset($search['responsavel'])) {
            $return .= $this->makeSearchHidratate($search['responsavel'], 'Responsável');
        }
        if (isset($search['proprietario'])) {
            $return .= $this->makeSearchHidratate($search['proprietario'], 'Proprietário');
        }
        if (isset($search['status'])) {
            $return .= $this->makeSearchHidratate($search['status'], 'Status');
        }
        return $return;
    }

    private function makeSearchExport($search)
    {
        $return = [];

        if (isset($search['gestor'])) {
            $gestor = Chamados::find(['columns' => 'DISTINCT codGestor code, gestor description', 'conditions' => "tipo = '{$search['tipo']}' AND codGestor IN {$this->implodeQuery($search['gestor'])}", 'order' => 'codGestor']);
            $search['gestor'] = $this->hidrateForExport($gestor);
        }
        if (isset($search['centrocusto'])) {
            $centrocusto = Chamados::find(['columns' => 'DISTINCT masterCc code, descCc description', 'conditions' => "tipo = '{$search['tipo']}' AND masterCc IN {$this->implodeQuery($search['centrocusto'])}", 'order' => 'masterCc']);
            $search['centrocusto'] = $this->hidrateForExport($centrocusto);
        }
        if (isset($search['departamento'])) {
            $departamento = Chamados::find(['columns' => 'DISTINCT codDepto code, depto description', 'conditions' => "tipo = '{$search['tipo']}' AND codDepto IN {$this->implodeQuery($search['departamento'])}", 'order' => 'codDepto']);
            $search['departamento'] = $this->hidrateForExport($departamento);
        }
        if (isset($search['cliente'])) {
            $search['cliente'] = $this->hidrateForExport($search['cliente'], false);
        }
        if (isset($search['responsavel'])) {
            $search['responsavel'] = $this->hidrateForExport($search['responsavel'], false);
        }
        if (isset($search['proprietario'])) {
            $search['proprietario'] = $this->hidrateForExport($search['proprietario'], false);
        }
        if (isset($search['status'])) {
            $search['status'] = $this->hidrateForExport($search['status'], false);
        }

        $map = Chamados::exportMap();

        foreach ($search as $key => $value) {
            $return[$map['questions'][$key]] = $value;
        }

        return $return;
    }

    private function hidrateForExport($dados, $query = true)
    {
        $return = '';
        if ($query) {
            foreach ($dados->toArray(0) as $value) {
                $return .= $value['CODE'] . ' - ' . $value['DESCRIPTION'] . ', ';
            }
        } else {
            foreach ($dados as $value) {
                $return .= $value . ', ';
            }
        }
        return substr($return, 0, -2);
    }

    private function makeSearchHidratate($dados, $title)
    {
        $return = '';
        if ($dados != null && !empty($dados)) {
            $return .= " | <b>{$title}:</b> " . implode(', ', $dados);
        }

        return $return;
    }

    private function getEntityByAjax($post)
    {

        $entity = $post['fields']['entity'];

        $search = $this->makeSearch($post['fields']);

        switch ($entity) {
            case 'fila':
                return $this->prepareFind(['columns' => "DISTINCT filaMaster fila", 'conditions' => $search, 'order' => 'filaMaster'], 'FILA');
            case 'gestor':
                return $this->prepareFind(['columns' => "DISTINCT codGestor, gestor", 'conditions' => $search, 'order' => 'codGestor'], ['CODGESTOR', 'GESTOR'], 2);
            case 'centrocusto':
                return $this->prepareFind(['columns' => "DISTINCT masterCc cc, descCc", 'conditions' => $search, 'order' => 'masterCc'], ['CC', 'DESCCC'], 2);
            case 'departamento':
                return $this->prepareFind(['columns' => "DISTINCT codDepto code, depto", 'conditions' => $search, 'order' => 'codDepto'], ['CODE', 'DEPTO'], 2);
            case 'cliente':
                return $this->prepareFind(['columns' => "DISTINCT cliente", 'conditions' => $search, 'order' => 'cliente'], 'CLIENTE');
            case 'responsavel':
                return $this->prepareFind(['columns' => "DISTINCT responsavel", 'conditions' => $search, 'order' => 'responsavel'], 'RESPONSAVEL');
            case 'proprietario':
                return $this->prepareFind(['columns' => "DISTINCT proprietario", 'conditions' => $search, 'order' => 'proprietario'], 'PROPRIETARIO');
            case 'status':
                return $this->prepareFind(['columns' => "DISTINCT status", 'conditions' => $search, 'order' => 'status'], 'STATUS');
        }
    }

    private function implodeQuery($dados)
    {
        return "('" . implode("', '", $dados) . "')";
    }

}
