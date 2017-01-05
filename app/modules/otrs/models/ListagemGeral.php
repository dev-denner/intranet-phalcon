<?php

namespace Otrs\Models;

use SysPhalcon\Models\ModelBase;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;
use Nucleo\Models\Protheus\Protheus;

class ListagemGeral extends ModelBase
{

    public $id;
    public $chamado;
    public $assunto;
    public $fila;
    public $servico;
    public $dataAbertura;
    public $dataFechamento;
    public $status;
    public $chamadoTotvs;
    public $prioridade;
    public $diasAberto;
    public $periodoDiasAberto;
    public $cliente;
    public $deptoCliente;
    public $proprietario;
    public $responsavel;
    private $filaQuery;
    private $assuntoQuery;
    private $dataDeQuery;
    private $dataAteQuery;
    private $responsavelQuery;
    private $statusQuery;
    private $clienteQuery;
    private $proprietarioQuery;
    private $tabela = 1;
    private $search = '';

    /**
     *
     * @param type $filaQuery
     * @return $this
     */
    public function setFilaQuery($filaQuery)
    {
        $this->filaQuery = " AND Fila LIKE '{$filaQuery}%'";
        return $this;
    }

    /**
     *
     * @param type $assuntoQuery
     * @return $this
     */
    public function setAssuntoQuery($assuntoQuery)
    {
        $this->assuntoQuery = " AND UPPER(Assunto) LIKE UPPER('%{$assuntoQuery}%')";
        return $this;
    }

    /**
     *
     * @param type $dataDeQuery
     * @return $this
     */
    public function setDataDeQuery($dataDeQuery)
    {

        $field = 'Data_Fechamento';
        if ($this->tabela == 'Listagem_Geral') {
            $field = 'Data_Abertura';
        }
        $dataDeQuery = implode('-', array_reverse(explode('/', $dataDeQuery)));
        $this->dataDeQuery = " AND {$field} >= '{$dataDeQuery}' ";
        return $this;
    }

    /**
     *
     * @param type $dataAteQuery
     * @return $this
     */
    public function setDataAteQuery($dataAteQuery)
    {

        $field = 'Data_Fechamento';
        if ($this->tabela == 'Listagem_Geral') {
            $field = 'Data_Abertura';
        }

        $dataAteQuery = implode('-', array_reverse(explode('/', $dataAteQuery)));
        $this->dataAteQuery = " AND {$field} <= '{$dataAteQuery}' ";
        return $this;
    }

    /**
     *
     * @param type $responsavelQuery
     * @return $this
     */
    public function setResponsavelQuery($responsavelQuery)
    {
        $this->responsavelQuery = " AND Responsavel IN ('" . implode("', '", $responsavelQuery) . "')";
        return $this;
    }

    /**
     *
     * @param type $statusQuery
     * @return $this
     */
    public function setStatusQuery($statusQuery)
    {
        $this->statusQuery = " AND Status IN ('" . implode("', '", $statusQuery) . "')";
        return $this;
    }

    /**
     *
     * @param type $clienteQuery
     * @return $this
     */
    public function setClienteQuery($clienteQuery)
    {
        $this->clienteQuery = "  AND Cliente IN ('" . implode("', '", $clienteQuery) . "')";
        return $this;
    }

    /**
     *
     * @param type $proprietarioQuery
     * @return $this
     */
    public function setProprietarioQuery($proprietarioQuery)
    {
        $this->proprietarioQuery = "  AND Proprietario IN ('" . implode("', '", $proprietarioQuery) . "')";
        return $this;
    }

    /**
     *
     * @param type $tabela
     * @return $this
     */
    public function setTabela($tabela)
    {
        if ($tabela == 1) {
            $this->tabela = 'Listagem_Geral';
        } else {
            $this->tabela = 'Listagem_Geral_Encerrados';
        }

        return $this;
    }

    /**
     *
     * @param type $search
     * @return $this
     */
    private function setSearch($search)
    {
        $this->search .= $search;
        return $this;
    }

    /**
     *
     * @param type $search
     * @return $this
     */
    private function makeSearch($search = [])
    {
        $this->search = '';
        if (empty($search)) {
            return $this;
        }

        foreach ($search as $key => $value) {
            if (empty($value) || is_null($value) || $value == 'null' || $value == '[""]') {
                continue;
            }
            $set = 'set' . ucfirst($key) . 'Query';
            if (!method_exists($this, $set)) {
                continue;
            }
            $this->$set($value);
            $element = $key . 'Query';

            $this->setSearch($this->$element);
        }

        return $this;
    }

    /**
     *
     */
    public function initialize()
    {
        parent::initialize();
        $this->setConnectionService('otrsDb');
        $this->setReadConnectionService('otrsDb');
    }

    /**
     *
     * @return type
     */
    public static function columnMap()
    {
        return [
            'Id' => 'id',
            'Chamado' => 'chamado',
            'Assunto' => 'assunto',
            'Fila' => 'fila',
            'Servico' => 'servico',
            'Data_Abertura' => 'dataAbertura',
            'Data_Fechamento' => 'dataFechamento',
            'Status' => 'status',
            'Chamado_TOTVS' => 'chamadoTotvs',
            'Prioridade' => 'prioridade',
            'Dias_Aberto' => 'diasAberto',
            'Periodo_Dias_Aberto' => 'periodoDiasAberto',
            'Cliente' => 'cliente',
            'Depto_Cliente' => 'deptoCliente',
            'Proprietario' => 'proprietario',
            'Responsavel' => 'responsavel',
        ];
    }

    /**
     *
     * @param type $table
     * @return Resultset
     */
    public function getFila($table = 1)
    {

        $this->setTabela($table);

        $sql = "SELECT DISTINCT CASE
                                    WHEN INSTR(Fila, '::') <> 0 THEN SUBSTRING(Fila, 1, INSTR(Fila, '::') -1)
                                    ELSE IFNULL(Fila, 'Não se aplica')
                                END fila
                FROM {$this->tabela}
                ORDER BY Fila";
        $listagemGeral = new ListagemGeral();
        return new Resultset(null, $listagemGeral, $listagemGeral->getReadConnection()->query($sql));
    }

    /**
     *
     * @param type $table
     * @param type $search
     * @return type
     */
    public function getGestores($table = 1, $search = '')
    {
        $cliente = $this->getClienteToProtheus($table, $search);
        $gestores = [];

        foreach ($cliente as $key => $value) {
            $gestores[$value['COD_GESTOR']] = $value['GESTOR'];
        }
        asort($gestores);
        return $gestores;
    }

    /**
     *
     * @param type $table
     * @param type $search
     * @return type
     */
    public function getCentroCusto($table = 1, $search = '')
    {
        $cliente = $this->getClienteToProtheus($table, $search);
        $protheus = new Protheus();
        $centroCustos = [];
        $centroCusto = [];
        $centro = [];
        $aux = '';

        foreach ($cliente as $key => $value) {
            $cc = substr($value['CCEO'], 0, 4);
            $centroCustos[] = $cc;
        }

        foreach ($centroCustos as $ccs) {
            $aux .= "'" . $ccs . "', ";
        }

        $aux = substr($aux, 0, strlen($aux) - 2);
        $centroCusto = $protheus->getCentroCustoBase(['code' => $aux]);

        foreach ($centroCusto as $key => $value) {
            $centro[$value['code']] = $value['name'];
        }

        return $centro;
    }

    /**
     *
     * @param type $table
     * @param type $search
     * @return type
     */
    private function getClienteToProtheus($table = 1, $search = '')
    {
        $this->setTabela($table);
        $this->makeSearch($search);

        $sql = "SELECT DISTINCT REPLACE(REPLACE(REPLACE(Cliente, '\"', ''), '<', ''), '>', '') cliente
                FROM {$this->tabela}
                WHERE 1 = 1 {$this->search}
                ORDER BY Cliente";

        $listagemGeral = new ListagemGeral();
        $clientes = new Resultset(null, $listagemGeral, $listagemGeral->getReadConnection()->query($sql));
        return $this->getProtheus($clientes->toArray());
    }

    /**
     *
     * @param type $object
     * @return array
     */
    private function getProtheus($object)
    {
        $cliente = [];
        $protheus = new Protheus();
        $gestores = [];
        $gestor = [];
        $aux = '';
        $i = 0;

        foreach ($object as $ob) {

            $aux = explode('@', $ob['cliente']);

            if (empty($aux[0])) {
                continue;
            }

            if (isset($aux[1]) && ($aux[1] == 'grupompe.com.br' || $aux[1] == 'mpengsa.com.br' )) {
                $cliente[] = $ob['cliente'];
            } else {
                $cliente[] = $aux[0] . '@grupompe.com.br';
            }
        }

        $aux = '';

        foreach ($cliente as $cli) {
            $i++;
            $aux .= "'" . $cli . "', ";

            if ($i >= 500) {
                $aux = substr($aux, 0, strlen($aux) - 2);
                $gestores[] = $protheus->getColaboradoresByEmail($aux);
                $i = 0;
                $aux = '';
            }
        }

        $aux = substr($aux, 0, strlen($aux) - 2);
        $gestores[] = $protheus->getColaboradoresByEmail($aux);

        foreach ($gestores as $gest) {
            foreach ($gest as $g) {
                $gestor[] = $g;
            }
        }
        return $gestor;
    }

    /**
     *
     * @param type $table
     * @param type $search
     * @return Resultset
     */
    public function getResponsavel($table = 1, $search = '')
    {

        $this->setTabela($table);
        $this->makeSearch($search);

        $sql = "SELECT DISTINCT Responsavel responsavel
                FROM {$this->tabela}
                WHERE 1 = 1 {$this->search}
                ORDER BY Responsavel";

        $listagemGeral = new ListagemGeral();
        return new Resultset(null, $listagemGeral, $listagemGeral->getReadConnection()->query($sql));
    }

    /**
     *
     * @param type $table
     * @param type $search
     * @return Resultset
     */
    public function getProprietario($table = 1, $search = '')
    {
        $this->setTabela($table);
        $this->makeSearch($search);

        $sql = "SELECT DISTINCT Proprietario proprietario
                FROM {$this->tabela}
                WHERE 1 = 1 {$this->search}
                ORDER BY Proprietario";
        $listagemGeral = new ListagemGeral();
        return new Resultset(null, $listagemGeral, $listagemGeral->getReadConnection()->query($sql));
    }

    /**
     *
     * @param type $table
     * @param type $search
     * @return Resultset
     */
    public function getStatus($table = 1, $search = '')
    {
        $this->setTabela($table);
        $this->makeSearch($search);

        $sql = "SELECT DISTINCT Status status
                FROM {$this->tabela}
                WHERE 1 = 1 {$this->search}
                ORDER BY Status";
        $listagemGeral = new ListagemGeral();
        return new Resultset(null, $listagemGeral, $listagemGeral->getReadConnection()->query($sql));
    }

    /**
     *
     * @param type $table
     * @param type $search
     * @return Resultset
     */
    public function getClientes($table = 1, $search = '')
    {
        $this->setTabela($table);
        $this->makeSearch($search);

        $sql = "SELECT DISTINCT REPLACE(REPLACE(REPLACE(Cliente, '\"', ''), '<', ''), '>', '') cliente
                FROM {$this->tabela}
                WHERE 1 = 1 {$this->search}
                ORDER BY Cliente";
        $listagemGeral = new ListagemGeral();
        return new Resultset(null, $listagemGeral, $listagemGeral->getReadConnection()->query($sql));
    }

    /**
     *
     * @param type $table
     * @param type $search
     * @return Resultset
     */
    public function getChamados($table = 1, $search = '')
    {

        $this->setTabela($table);
        $this->makeSearch($search);

        $sql = "SELECT * FROM {$this->tabela}
                WHERE 1 = 1 {$this->search}";

        $listagemGeral = new ListagemGeral();
        return new Resultset(null, $listagemGeral, $listagemGeral->getReadConnection()->query($sql));
    }

}
