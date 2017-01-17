<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace App\Modules\Telephony\Models;

use App\Shared\Models\ModelBase;

class SaStatement extends ModelBase {

    /**
     *
     * @var type
     */
    protected $numNf;

    /**
     *
     * @var type
     */
    protected $idCliente;

    /**
     *
     * @var type
     */
    protected $saMes;

    /**
     *
     * @var type
     */
    protected $numAcs;

    /**
     *
     * @var type
     */
    protected $plano;

    /**
     *
     * @var type
     */
    protected $nome;

    /**
     *
     * @var type
     */
    protected $tpServ;

    /**
     *
     * @var type
     */
    protected $data;

    /**
     *
     * @var type
     */
    protected $hora;

    /**
     *
     * @var type
     */
    protected $origem;

    /**
     *
     * @var type
     */
    protected $destino;

    /**
     *
     * @var type
     */
    protected $numChamada;

    /**
     *
     * @var type
     */
    protected $tipo;

    /**
     *
     * @var type
     */
    protected $duracao;

    /**
     *
     * @var type
     */
    protected $valor;

    /**
     *
     * @var type
     */
    protected $operLd;

    /**
     *
     * @var type
     */
    protected $timid;

    /**
     *
     * @var type
     */
    protected $aliquota;

    /**
     *
     * @var type
     */
    protected $codFebraban;

    /**
     *
     * @var type
     */
    protected $totalGeral;

    /**
     *
     * @return type
     */
    public function getNumNf() {
        return $this->numNf;
    }

    /**
     *
     * @return type
     */
    public function getIdCliente() {
        return $this->idCliente;
    }

    /**
     *
     * @return type
     */
    public function getSaMes() {
        return $this->saMes;
    }

    /**
     *
     * @return type
     */
    public function getNumAcs() {
        return $this->numAcs;
    }

    /**
     *
     * @return type
     */
    public function getPlano() {
        return $this->plano;
    }

    /**
     *
     * @return type
     */
    public function getNome() {
        return $this->nome;
    }

    /**
     *
     * @return type
     */
    public function getTpServ() {
        return $this->tpServ;
    }

    /**
     *
     * @return type
     */
    public function getData() {
        return $this->data;
    }

    /**
     *
     * @return type
     */
    public function getHora() {
        return $this->hora;
    }

    /**
     *
     * @return type
     */
    public function getOrigem() {
        return $this->origem;
    }

    /**
     *
     * @return type
     */
    public function getDestino() {
        return $this->destino;
    }

    /**
     *
     * @return type
     */
    public function getNumChamada() {
        return $this->numChamada;
    }

    /**
     *
     * @return type
     */
    public function getTipo() {
        return $this->tipo;
    }

    /**
     *
     * @return type
     */
    public function getDuracao() {
        return $this->duracao;
    }

    /**
     *
     * @return type
     */
    public function getValor() {
        return $this->valor;
    }

    /**
     *
     * @return type
     */
    public function getOperLd() {
        return $this->operLd;
    }

    /**
     *
     * @return type
     */
    public function getTimid() {
        return $this->timid;
    }

    /**
     *
     * @return type
     */
    public function getAliquota() {
        return $this->aliquota;
    }

    /**
     *
     * @return type
     */
    public function getCodFebraban() {
        return $this->codFebraban;
    }

    /**
     *
     * @return type
     */
    public function getTotalGeral() {
        return $this->totalGeral;
    }

    /**
     *
     * @param type $numNf
     * @return \Telephony\Models\SaStatement
     */
    public function setNumNf($numNf) {
        $this->numNf = $numNf;
        return $this;
    }

    /**
     *
     * @param type $idCliente
     * @return \Telephony\Models\SaStatement
     */
    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
        return $this;
    }

    /**
     *
     * @param type $saMes
     * @return \Telephony\Models\SaStatement
     */
    public function setSaMes($saMes) {
        $this->saMes = $saMes;
        return $this;
    }

    /**
     *
     * @param type $numAcs
     * @return \Telephony\Models\SaStatement
     */
    public function setNumAcs($numAcs) {
        $this->numAcs = $numAcs;
        return $this;
    }

    /**
     *
     * @param type $plano
     * @return \Telephony\Models\SaStatement
     */
    public function setPlano($plano) {
        $this->plano = $plano;
        return $this;
    }

    /**
     *
     * @param type $nome
     * @return \Telephony\Models\SaStatement
     */
    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    /**
     *
     * @param type $tpServ
     * @return \Telephony\Models\SaStatement
     */
    public function setTpServ($tpServ) {
        $this->tpServ = $tpServ;
        return $this;
    }

    /**
     *
     * @param type $data
     * @return \Telephony\Models\SaStatement
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    /**
     *
     * @param type $hora
     * @return \Telephony\Models\SaStatement
     */
    public function setHora($hora) {
        $this->hora = $hora;
        return $this;
    }

    /**
     *
     * @param type $origem
     * @return \Telephony\Models\SaStatement
     */
    public function setOrigem($origem) {
        $this->origem = $origem;
        return $this;
    }

    /**
     *
     * @param type $destino
     * @return \Telephony\Models\SaStatement
     */
    public function setDestino($destino) {
        $this->destino = $destino;
        return $this;
    }

    /**
     *
     * @param type $numChamada
     * @return \Telephony\Models\SaStatement
     */
    public function setNumChamada($numChamada) {
        $this->numChamada = $numChamada;
        return $this;
    }

    /**
     *
     * @param type $tipo
     * @return \Telephony\Models\SaStatement
     */
    public function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     *
     * @param type $duracao
     * @return \Telephony\Models\SaStatement
     */
    public function setDuracao($duracao) {
        $this->duracao = $duracao;
        return $this;
    }

    /**
     *
     * @param type $valor
     * @return \Telephony\Models\SaStatement
     */
    public function setValor($valor) {
        $this->valor = $valor;
        return $this;
    }

    /**
     *
     * @param type $operLd
     * @return \Telephony\Models\SaStatement
     */
    public function setOperLd($operLd) {
        $this->operLd = $operLd;
        return $this;
    }

    /**
     *
     * @param type $timid
     * @return \Telephony\Models\SaStatement
     */
    public function setTimid($timid) {
        $this->timid = $timid;
        return $this;
    }

    /**
     *
     * @param type $aliquota
     * @return \Telephony\Models\SaStatement
     */
    public function setAliquota($aliquota) {
        $this->aliquota = $aliquota;
        return $this;
    }

    /**
     *
     * @param type $codFebraban
     * @return \Telephony\Models\SaStatement
     */
    public function setCodFebraban($codFebraban) {
        $this->codFebraban = $codFebraban;
        return $this;
    }

    /**
     *
     * @param type $totalGeral
     * @return \Telephony\Models\SaStatement
     */
    public function setTotalGeral($totalGeral) {
        $this->totalGeral = $totalGeral;
        return $this;
    }

    /**
     *
     */
    public function initialize() {

        parent::initialize();

        $this->setConnectionService('telefoniaDb');
    }

    /**
     *
     * @return string
     */
    public function getSource() {
        return 'SA_EXTRATO';
    }

    /**
     *
     * @return type
     */
    public static function columnMap() {
        return [
            'NUMNF' => 'numNf',
            'NUMIDCLI' => 'idCliente',
            'MESREF' => 'saMes',
            'NUMACS' => 'numAcs',
            'PLANO' => 'plano',
            'NOME' => 'nome',
            'TPSERV' => 'tpServ',
            'DATA' => 'data',
            'HORA' => 'hora',
            'ORIGEM' => 'origem',
            'DESTINO' => 'destino',
            'NUMCHAM' => 'numChamada',
            'TIPO' => 'tipo',
            'DURACAO' => 'duracao',
            'VALOR' => 'valor',
            'OPERLD' => 'operLd',
            'TIMID' => 'timid',
            'ALIQUOTA' => 'aliquota',
            'CODFEBRABAN' => 'codFebraban',
            'TOTALGERAL' => 'totalGeral',
        ];
    }

}
