<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Intranet\Controllers;

use App\Shared\Controllers\ControllerBase;
use App\Modules\Nucleo\Models\Protheus\ProdutosDescricao as Produtos;
use App\Modules\Nucleo\Models\Protheus\Fornecedores;
use App\Modules\Nucleo\Models\Protheus\CentroCustos;
use App\Modules\Nucleo\Models\Protheus\NaturezaFinanceira;
use App\Modules\Nucleo\Models\Protheus\Tes;
use App\Modules\Nucleo\Models\Protheus\RequisitoMinimo;
use App\Modules\Nucleo\Models\Protheus\Clientes;
use App\Modules\Nucleo\Models\RM\Psecao;
use App\Modules\Telephony\Models\Statement;
use App\Modules\Catraca\Models\Movimentos;
use App\Modules\Intranet\Models\Processos;
use App\Modules\Otrs\Models\Chamados;
use App\Plugins\Tools;

class ExportController extends ControllerBase
{

    public function initialize()
    {
        $this->tag->setTitle('Exportar Arquivos');
        parent::initialize();
    }

    public function indexAction()
    {
        try {

            $tools = new Tools();
            $search = $this->request->get('search', 'string');

            switch ($this->request->get('obj')) {
                case 'produtos':
                    $object = new Produtos();
                    $dados = $object->getProdutos($search);
                    $options['fileName'] = 'Produtos e Serviços';
                    break;
                case 'fornecedores':
                    $object = new Fornecedores();
                    $dados = $object->getFornecedores($search);
                    $options['fileName'] = 'Fornecedores';
                    break;
                case 'centro_custo':
                    $object = new CentroCustos();
                    $dados = $object->getCentroCusto($search);
                    $options['fileName'] = 'Centros de Custos';
                    break;
                case 'natureza_financeria':
                    $object = new NaturezaFinanceira();
                    $dados = $object->getNaturezaFinanceira($search);
                    $options['fileName'] = 'Natureza Financeira';
                    break;
                case 'requisitos_minimos':
                    $object = new RequisitoMinimo();
                    $dados = $object->getRequisitoMinimo($search);
                    $options['fileName'] = 'Requisitos Mínimos';
                    break;
                case 'secao':
                    $object = new Psecao();
                    $dados = $object->getSecao($search);
                    $options['fileName'] = 'Seções';
                    break;
                case 'tes':
                    $object = new Tes();
                    $dados = $object->getTes($search);
                    $options['fileName'] = 'TES (Tipos de Entrada e Saída)';
                    break;
                case 'telefonia':
                    $aux = explode(' | ', $search);
                    $linhas = $aux[0];
                    $mes = str_replace('20', '', $aux[1]);
                    $object = new Statement();
                    $dados = $object->getReportByLine($linhas, $mes);
                    $options['fileName'] = 'Extrato de Conta Celular';
                    break;
                case 'clientes':
                    $object = new Clientes();
                    $dados = $object->getClientes($search);
                    $options['fileName'] = 'Clientes';
                    break;
                case 'catraca':
                    $aux = explode('|', $search);
                    $object = new Movimentos();
                    $dados = $object->getReport($aux[0], $aux[1], $aux[2]);
                    $options['fileName'] = 'Relatório Catraca';
                    break;
                case 'processos':
                    $object = new Processos();
                    $aux = explode('|', $search);
                    $dados = $object->getReport($aux[0], $aux[1]);
                    $options['fileName'] = 'Processos';
                    break;
                case 'atendimento':
                    $search = str_replace('&#39;', "'", str_replace('&#34;', '"', $search));
                    $search = json_decode($search, true);
                    $dados = Chamados::find(['conditions' => $search, 'order' => 'id']);
                    $dados = $dados->toArray();

                    $options['fileName'] = 'Relatório de Chamados';
                    $options['toArray'] = false;
                    break;
                default:
                    throw new \Exception('Erro ao exportar: Objeto não definido.');
            }

            $options['download'] = true;

            switch ($this->request->get('type')) {
                case 'excel':
                    return $tools->writeXLS($dados, $options);
                    break;

                case 'pdf':
                    return $tools->writePdf($dados, $options);
                    break;

                default:
                    throw new Exception('Erro ao exportar: Tipo não definido.');
                    break;
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        }
    }

}
