<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Telephony\Controllers;

use DevDenners\Controllers\ControllerBase;
use Telephony\Models\CellPhoneLine;
use Telephony\Models\AccessLine;
use Telephony\Models\Statement;

class IndexController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Telefonia');
        parent::initialize();
    }

    public function indexAction() {

        try {

            $this->view->pesquisa = '';

            if ($this->request->isPost()) {
                $linhas = $this->request->getPost('linhas', 'string');
                $mes = str_replace('20', '', $this->request->getPost('mes', 'string'));

                $this->view->extratos = Statement::find("operLd IS NOT NULL AND numAcs = '{$linhas}' AND mes = '{$mes}'");
                $this->view->totais = Statement::find("operLd IS NULL AND numAcs = '{$linhas}' AND mes = '{$mes}'");
                $this->view->total = $this->telefoniaDb->fetchAll("SELECT SUM(VALOR) valor FROM EXTRATO
                                                                   WHERE OPERLD IS NULL
                                                                   AND NUMACS = '{$linhas}' AND MESREF = '{$mes}'");
                $this->view->pesquisa = $linhas . ' | ' . $this->request->getPost('mes', 'string');
            }

            $cellPhoneLine = CellPhoneLine::findByCpf($auth_identity->cpf);
            $accessLine = AccessLine::findByCpf($auth_identity->cpf);

            $linhas = [];

            foreach ($cellPhoneLine as $value) {
                $linhas['Minhas Linhas'][$value->linha] = $value->linha;
            }
            foreach ($accessLine as $value) {
                $linhas['Linhas de Outros'][$value->linha] = $value->linha;
            }
            $this->view->linhas = $linhas;

            if (empty($linhas)) {
                throw new Exception('Não há linhas telefônicas cadastradas no seu CPF.');
            }
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function contaCelularAdminAction() {

        try {

            $this->view->pesquisa = '';

            if ($this->request->isPost()) {
                $linhas = $this->request->getPost('linhas', 'string');
                $mes = str_replace('20', '', $this->request->getPost('mes', 'string'));

                $this->view->extratos = Statement::find("operLd IS NOT NULL AND numAcs = '{$linhas}' AND mes = '{$mes}'");
                $this->view->totais = Statement::find("operLd IS NULL AND numAcs = '{$linhas}' AND mes = '{$mes}'");
                $this->view->total = $this->telefoniaDb->fetchAll("SELECT SUM(VALOR) valor FROM EXTRATO
                                                                   WHERE OPERLD IS NULL
                                                                   AND NUMACS = '{$linhas}' AND MESREF = '{$mes}'");
                $this->view->pesquisa = $linhas . ' | ' . $this->request->getPost('mes', 'string');
            }

            $cellPhoneLine = CellPhoneLine::find();

            $linhas = [];

            foreach ($cellPhoneLine as $value) {
                $linhas[$value->linha] = $value->linha;
            }

            $this->view->linhas = $linhas;
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function importTelephonyAction() {

        try {
            $this->view->linhasAlteradas = '';
            if ($this->request->isPost()) {
                $statement = new \Telephony\Models\Statement();
                $this->view->linhasAlteradas = $statement->importExternalTable();
            }
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

}
