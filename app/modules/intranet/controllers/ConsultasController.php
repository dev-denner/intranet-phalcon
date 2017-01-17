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
use App\Modules\Intranet\Models\Processos;

class ConsultasController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Consultas');
        parent::initialize();
    }

    public function indexAction() {
        return $this->response->redirect('documents');
    }

    public function produtosServicosAction() {

        try {
            $this->assets->collection('footerJs')->addJs('app/intranet/consultas/produtosServicos.js');

            $produtos = new Produtos();

            if ($this->request->isAjax()) {
                echo json_encode([
                    'produtos' => $produtos->getQtdProdutos('N'),
                    'servicos' => $produtos->getQtdProdutos('S')
                ]);
                return $this->view->disable();
            }

            $this->view->pesquisa = '';

            if ($this->request->isPost()) {
                $search = $this->request->getPost('produto', 'string');
                $this->view->produtos = $produtos->getProdutos($search);
                $this->view->pesquisa = $search;
                $this->view->export = true;
            }
        } catch (\Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

    public function fornecedoresAction() {

        try {
            $this->assets->collection('footerJs')->addJs('app/intranet/consultas/fornecedores.js');
            $fornecedores = new Fornecedores();
            if ($this->request->isAjax()) {
                echo json_encode([
                    'fornecedores' => $fornecedores->getQtdFornecedores()
                ]);
                return $this->view->disable();
            }

            $this->view->pesquisa = '';

            if ($this->request->isPost()) {
                $search = $this->request->getPost('fornecedor', 'string');
                $this->view->fornecedores = $fornecedores->getFornecedores($search);
                $this->view->pesquisa = $search;
                $this->view->export = true;
            }
        } catch (\Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

    public function centroCustosAction() {

        try {

            $this->view->pesquisa = '';

            if ($this->request->isPost()) {
                $search = strtoupper($this->request->getPost('centro_custo', 'string'));
                $centro_custos = new CentroCustos();
                $this->view->centro_custos = $centro_custos->getCentroCusto($search);
                $this->view->pesquisa = $search;
                $this->view->export = true;
            }
        } catch (\Exception $e) {
            $this->flash->error($e->getMessage());
        } catch (\PDOException $e) {
            $this->flash->error($e->getMessage());
        }
    }

    public function naturezaFinanceiraAction() {

        try {

            $this->view->pesquisa = '';

            if ($this->request->isPost()) {
                $search = strtoupper($this->request->getPost('natureza_financeira', 'string'));
                $natureza_financeiras = new NaturezaFinanceira();
                $this->view->natureza_financeiras = $natureza_financeiras->getNaturezaFinanceira($search);
                $this->view->pesquisa = $search;
                $this->view->export = true;
            }
        } catch (\Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

    public function tesAction() {

        try {

            $this->view->pesquisa = '';

            if ($this->request->isPost()) {
                $search = strtoupper($this->request->getPost('tes', 'string'));
                $tes = new Tes();
                $this->view->tess = $tes->getTes($search);
                $this->view->pesquisa = $search;
                $this->view->export = true;
            }
        } catch (\Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

    public function requisitoMinimoAction() {

        try {

            $this->view->pesquisa = '';

            if ($this->request->isPost()) {
                $search = strtoupper($this->request->getPost('requisito_minimo', 'string'));
                $requisito_minimo = new RequisitoMinimo();
                $this->view->requisito_minimos = $requisito_minimo->getRequisitoMinimo($search);
                $this->view->pesquisa = $search;
                $this->view->export = true;
            }
        } catch (\Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

    public function secaoAction() {

        try {

            $this->view->pesquisa = '';

            if ($this->request->isPost()) {
                $search = strtoupper($this->request->getPost('secao', 'string'));
                $secao = new Psecao();
                $this->view->secoes = $secao->getSecao($search);
                $this->view->pesquisa = $search;
                $this->view->export = true;
            }
        } catch (\Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

    public function clientesAction() {

        try {

            $this->assets->collection('footerJs')->addJs('app/intranet/consultas/clientes.js');
            $cliente = new Clientes();
            if ($this->request->isAjax()) {
                echo json_encode([
                    'clientes' => $cliente->getQtdClientes()
                ]);
                return $this->view->disable();
            }

            $this->view->pesquisa = '';

            if ($this->request->isPost()) {
                $search = strtoupper($this->request->getPost('cliente', 'string'));
                $this->view->clientes = $cliente->getClientes($search);
                $this->view->pesquisa = $search;
                $this->view->export = true;
            }
        } catch (\Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

    public function processosAction() {

        try {
            $this->view->processos = Processos::find();
            $this->view->pesquisa = '';
            $this->view->export = true;
            if ($this->request->isPost()) {
                $search = "(UPPER(code) LIKE UPPER('%" . $this->request->getPost('processos', 'string') . "%') OR UPPER(description) LIKE UPPER('%" . $this->request->getPost('processos', 'string') . "%'))";
                $this->view->processos = Processos::find($search);
                $this->view->pesquisa = $this->request->getPost('processos');
            }
        } catch (\Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

}
