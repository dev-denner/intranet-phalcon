<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Intranet\Controllers;

use DevDenners\Controllers\ControllerBase;
use Nucleo\Models\Protheus\ProdutosDescricao as Produtos;
use Nucleo\Models\Protheus\Fornecedores;
use Nucleo\Models\Protheus\CentroCustos;

class ConsultasController extends ControllerBase {

    public function initialize() {
        $this->tag->setTitle('Consultas');
        parent::initialize();
        $this->entity = new Produtos();
    }

    public function indexAction() {
        $this->view->idDepartment = 8;
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
                $this->view->produtos = $produtos->getProdutosForSearch($this->request->getPost('produto'));
                $this->view->pesquisa = $this->request->getPost('produto');
            }
        } catch (Exception $exc) {
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
                $this->view->fornecedores = $fornecedores->getFornecedoresForSearch($this->request->getPost('fornecedor'));
                $this->view->pesquisa = $this->request->getPost('fornecedor');
            }
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

    public function centroCustosAction() {

        try {

            $this->view->pesquisa = '';

            if ($this->request->isPost()) {
                $search = $this->request->getPost('centro_custo', 'string');
                $centro_custos = CentroCustos::find("cttSdel = ' ' AND (cttCusto LIKE '%{$search}%' OR UPPER(cttDesc) LIKE '%{$search}%')");
                $this->view->centro_custos = $centro_custos->toArray(0);
                $this->view->pesquisa = $search;
            }
        } catch (Exception $exc) {
            $this->flash->error($e->getMessage());
        }
    }

}
