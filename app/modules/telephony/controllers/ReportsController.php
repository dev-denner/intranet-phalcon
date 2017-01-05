<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Telephony\Controllers;

use SysPhalcon\Controllers\ControllerBase;
use SysPhalcon\Plugins\Tools;
use Telephony\Models\Reports;

class ReportsController extends ControllerBase
{

    public function initialize()
    {
        $this->tag->setTitle('Relatórios');
        parent::initialize();
    }

    public function indexAction()
    {

        try {
            $this->assets->collection('footerJs')->addJs('app/telephony/reports/index.js');

            if ($this->request->isPost()) {

                $relatorios = $this->request->getPost('relatorios', 'int');
                $competencia = str_replace('20', '', $this->request->getPost('mes', 'string'));

                if ($this->request->getPost('valor')) {
                    $valor = $this->filter->sanitize(str_replace(',', '.', str_replace('.', '', $this->request->getPost('valor'))), 'float');
                }

                $reports = new Reports();

                switch ($relatorios) {
                    case 1:
                        $dados = $reports->getRateioDescFolha($competencia);
                        $fileName = 'Rateio Celular Folha Pagto';
                        break;
                    case 2:
                        $dados = $reports->getRateioNF($competencia);
                        $fileName = 'Rateio Celular NF';
                        break;
                    case 3:
                        $competencia = implode('', array_reverse(explode('/', $this->request->getPost('mes', 'string'))));
                        $dados = $reports->getRateioTotvs($competencia, $valor);
                        $fileName = 'Rateio NF ERP';
                        break;
                    case 4:
                        $dados = $reports->getRateioEmails($competencia, $valor);
                        $fileName = 'Rateio NF E-mails';
                        break;
                    case 5:
                        $competencia = implode('', array_reverse(explode('/', $this->request->getPost('mes', 'string'))));
                        $dados = $reports->getRateioCorporativo($competencia, $valor);
                        $fileName = 'Rateio NF Matriz';
                        break;
                    default:
                        $dados = $reports->getRateioDescFolha($competencia);
                        $fileName = 'Rateio Celular Folha Pagto';
                        break;
                }

                $tools = new Tools();

                $options = [
                    'download' => true,
                    'fileName' => $fileName,
                ];

                return $tools->writeXLS($dados, $options);
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

}
