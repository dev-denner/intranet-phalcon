<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Telephony\Controllers;

use DevDenners\Controllers\ControllerBase;
use Telephony\Models\Statement;

class ReportsController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Relatórios');
        parent::initialize();
    }

    public function indexAction() {

        try {
            $this->assets->collection('footerJs')->addJs('app/telephony/reports/index.js');

            if ($this->request->isPost()) {

                $relatorios = $this->request->getPost('relatorios', 'int');
                $competencia = str_replace('20', '', $this->request->getPost('mes', 'string'));

                if ($this->request->getPost('valor')) {
                    $valor = str_replace(',', '.', str_replace('.', '', $this->request->getPost('valor', 'float')));
                }

                $statement = new \Telephony\Models\Statement();

                switch ($relatorios) {
                    case 1:
                        $dados = $statement->getRateioDescFolha($competencia);
                        break;
                    case 2:
                        $dados = $statement->getRateioNF($competencia);
                        break;
                    case 3:
                        $competencia = str_replace('/', '', $this->request->getPost('relatorios', 'int'));
                        $dados = $statement->getRateioTotvs($competencia, $valor);
                        break;
                    case 4:
                        $dados = $statement->getRateioEmails($competencia, $valor);
                        break;
                    case 5:
                        $competencia = str_replace('/', '', $this->request->getPost('relatorios', 'int'));
                        $dados = $statement->getRateioCorporativo($competencia, $valor);
                        break;
                    default:
                        $dados = $statement->getRateioDescFolha($competencia);
                        break;
                }

                foreach ($dados as $key => $value) {
                    dump($key);
                    dump($value);
                }
            }
        } catch (Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

}
