<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Intranet\Controllers;

use SysPhalcon\Controllers\ControllerBase;
use Nucleo\Models\Protheus\ProdutosDescricao as Produtos;
use Nucleo\Models\Protheus\Fornecedores;
use Nucleo\Models\Protheus\CentroCustos;
use Nucleo\Models\Protheus\NaturezaFinanceira;
use Nucleo\Models\Protheus\Tes;
use Nucleo\Models\Protheus\RequisitoMinimo;
use Nucleo\Models\Protheus\Clientes;
use Nucleo\Models\RM\Psecao;
use Telephony\Models\Statement;
use SysPhalcon\Plugins\Tools;

class ExportController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Exportar Arquivos');
        parent::initialize();
    }

    public function indexAction() {
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
                default:
                    throw new Exception('Erro ao exportar: Objeto não definido.');
                    break;
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
