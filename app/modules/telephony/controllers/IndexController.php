<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Telephony\Controllers;

use SysPhalcon\Controllers\ControllerBase;
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
                $statement = new Statement();
                $this->view->totalLinha = $statement->getTotal($linhas, $mes);
                $this->view->pesquisa = $linhas . ' | ' . $this->request->getPost('mes', 'string');
                $this->view->export = true;
            }

            $cpf = $this->session->get('auth-identity')['userInfo']['cpf'];

            $cellPhoneLine = CellPhoneLine::findByCpf($cpf);
            $accessLine = AccessLine::findByCpf($cpf);

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
        } catch (\Exception $e) {
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
                $statement = new Statement();
                $this->view->totalLinha = $statement->getTotal($linhas, $mes);
                $this->view->pesquisa = $linhas . ' | ' . $this->request->getPost('mes', 'string');
                $this->view->export = true;
            }

            $cellPhoneLine = CellPhoneLine::find(['order' => 'linha']);

            $linhas = [];

            foreach ($cellPhoneLine as $value) {
                $linhas[$value->linha] = $value->linha;
            }

            $this->view->linhas = $linhas;
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function importTelephonyAction() {

        try {
            $this->view->linhasAlteradas = '';
            if ($this->request->isPost()) {
                $nameFile = implode('', array_reverse(explode('/', $this->request->getPost('mes', 'string'))));

                $statement = new \Telephony\Models\Statement();
                $this->view->linhasAlteradas = $statement->importExternalTable($nameFile);
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

}
