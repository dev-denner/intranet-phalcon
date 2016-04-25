<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Telephony\Models;

use DevDenners\Models\ModelBase;
use Phalcon\Mvc\Model\Resultset\Simple as Resultset;

class Statement extends ModelBase {

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
    protected $mes;

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
    public function getMes() {
        return $this->mes;
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
     * @return \Telephony\Models\Statement
     */
    public function setNumNf($numNf) {
        $this->numNf = $numNf;
        return $this;
    }

    /**
     *
     * @param type $idCliente
     * @return \Telephony\Models\Statement
     */
    public function setIdCliente($idCliente) {
        $this->idCliente = $idCliente;
        return $this;
    }

    /**
     *
     * @param type $mes
     * @return \Telephony\Models\Statement
     */
    public function setMes($mes) {
        $this->mes = $mes;
        return $this;
    }

    /**
     *
     * @param type $numAcs
     * @return \Telephony\Models\Statement
     */
    public function setNumAcs($numAcs) {
        $this->numAcs = $numAcs;
        return $this;
    }

    /**
     *
     * @param type $plano
     * @return \Telephony\Models\Statement
     */
    public function setPlano($plano) {
        $this->plano = $plano;
        return $this;
    }

    /**
     *
     * @param type $nome
     * @return \Telephony\Models\Statement
     */
    public function setNome($nome) {
        $this->nome = $nome;
        return $this;
    }

    /**
     *
     * @param type $tpServ
     * @return \Telephony\Models\Statement
     */
    public function setTpServ($tpServ) {
        $this->tpServ = $tpServ;
        return $this;
    }

    /**
     *
     * @param type $data
     * @return \Telephony\Models\Statement
     */
    public function setData($data) {
        $this->data = $data;
        return $this;
    }

    /**
     *
     * @param type $hora
     * @return \Telephony\Models\Statement
     */
    public function setHora($hora) {
        $this->hora = $hora;
        return $this;
    }

    /**
     *
     * @param type $origem
     * @return \Telephony\Models\Statement
     */
    public function setOrigem($origem) {
        $this->origem = $origem;
        return $this;
    }

    /**
     *
     * @param type $destino
     * @return \Telephony\Models\Statement
     */
    public function setDestino($destino) {
        $this->destino = $destino;
        return $this;
    }

    /**
     *
     * @param type $numChamada
     * @return \Telephony\Models\Statement
     */
    public function setNumChamada($numChamada) {
        $this->numChamada = $numChamada;
        return $this;
    }

    /**
     *
     * @param type $tipo
     * @return \Telephony\Models\Statement
     */
    public function setTipo($tipo) {
        $this->tipo = $tipo;
        return $this;
    }

    /**
     *
     * @param type $duracao
     * @return \Telephony\Models\Statement
     */
    public function setDuracao($duracao) {
        $this->duracao = $duracao;
        return $this;
    }

    /**
     *
     * @param type $valor
     * @return \Telephony\Models\Statement
     */
    public function setValor($valor) {
        $this->valor = $valor;
        return $this;
    }

    /**
     *
     * @param type $operLd
     * @return \Telephony\Models\Statement
     */
    public function setOperLd($operLd) {
        $this->operLd = $operLd;
        return $this;
    }

    /**
     *
     * @param type $timid
     * @return \Telephony\Models\Statement
     */
    public function setTimid($timid) {
        $this->timid = $timid;
        return $this;
    }

    /**
     *
     * @param type $aliquota
     * @return \Telephony\Models\Statement
     */
    public function setAliquota($aliquota) {
        $this->aliquota = $aliquota;
        return $this;
    }

    /**
     *
     * @param type $codFebraban
     * @return \Telephony\Models\Statement
     */
    public function setCodFebraban($codFebraban) {
        $this->codFebraban = $codFebraban;
        return $this;
    }

    /**
     *
     * @param type $totalGeral
     * @return \Telephony\Models\Statement
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

        $this->setSchema('TELEFONIA');
        $this->setConnectionService('telefoniaDb');
    }

    /**
     *
     * @return string
     */
    public function getSource() {
        return 'EXTRATO';
    }

    /**
     *
     * @return type
     */
    public static function columnMap() {
        return [
            'NUMNF' => 'numNf',
            'NUMIDCLI' => 'idCliente',
            'MESREF' => 'mes',
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

    public function importExternalTable() {

        $statement = new \Telephony\Models\Statement();

        $sqlDelete = 'DELETE FROM EXTRATO WHERE MESREF IN (SELECT DISTINCT MESREF FROM SA_EXTRATO)';

        $delete = new Resultset(null, $statement, $statement->getReadConnection()->query($sqlDelete));

        if (!$delete) {
            throw new Exception('Erro ao deletar tabela EXTRATO.');
        }
        $sqlInsert = 'INSERT INTO EXTRATO (
      SELECT NUMNF, NUMIDCLI, MESREF, NUMACS, PLANO, NOME, TPSERV,  DATA, HORA, ORIGEM, DESTINO,
             NUMCHAM, TIPO, DURACAO,
             TO_NUMBER(REPLACE(REPLACE(VALOR, \'.\', \'\'), \',\', \'.\'), \'999999999999.99\'),
             OPERLD, TIMID, ALIQUOTA, CODFEBRABAN, TOTALGERAL
FROM SA_EXTRATO)';

        $insert = new Resultset(null, $statement, $statement->getReadConnection()->query($sqlInsert));

        if (!$insert) {
            throw new Exception('Erro ao inserir na tabela EXTRATO.');
        }

        $saStatement = new \Telephony\Models\SaStatement();

        $sqlCount = 'SELECT COUNT(1) M FROM SA_EXTRATO';

        $count = new Resultset(null, $saStatement, $saStatement->getReadConnection()->query($sqlCount));

        if (!$count) {
            throw new Exception('Erro ao contar número de alterações da tabela EXTRATO pela SA_EXTRATO.');
        }
        return $count->toArray(0)[0]['M'];
    }

    public function getRateioDescFolha($comp = NULL) {

        $query = "
             SELECT CASE ZH.ZH_EMPRESA
                        WHEN '01' THEN 'MPE'
                        WHEN '02' THEN 'EBE'
                        WHEN '03' THEN 'MPE SERVIÇOS'
                        WHEN '04' THEN 'GEMON'
                        WHEN 'D1' THEN 'AAT'
                        WHEN 'D2' THEN 'GEMON'
                        WHEN 'D3' THEN 'IRLA'
                        WHEN 'D4' THEN 'MPE PAINEIS'
                        WHEN 'D5' THEN 'SOAHGRO'
                        WHEN 'D6' THEN 'TEIA'
                        WHEN 'D7' THEN 'VALENÇA'
                        WHEN 'D8' THEN 'FW GEMON'
                        WHEN 'D9' THEN 'CANARI'
                        WHEN 'DA' THEN 'AGROMOM'
                        ELSE ZH.ZH_EMPRESA END || ' - ' || ZH.ZH_EMPRESA AS EMPRESA,
                    TRIM(ZH.ZH_NOME) NOME, EX.MESREF,EX.NUMACS,
                    LC.CPF AS CPF,
                    CASE
                      WHEN LC.CCEO IS NULL THEN ZH.ZH_CCEO
                      ELSE LC.CCEO
                    END AS ZH_CCEO,
                    CASE LC.DESC_FOLHA
                        WHEN '0' THEN 'N'
                        ELSE LC.DESC_FOLHA
                    END AS DESC_FOLHA,
                    REPLACE(TO_CHAR(SUM(EX.VALOR)), '.', ',') AS VALOR
             FROM (SELECT MESREF, NUMACS, VALOR
                   FROM EXTRATO
                   WHERE NUMACS IS NOT NULL) EX
             LEFT JOIN LINHA_CELULAR LC
                    ON LC.LINHA = EX.NUMACS
             LEFT JOIN PRODUCAO_9ZGXI5.SZH010@PROTHEUSPROD ZH
                    ON D_E_L_E_T_ = ' '
                   AND TRIM(ZH.ZH_CPF) = REPLACE(REPLACE(TRIM(LC.CPF), '.'), '-')
             WHERE 1 = 1 AND EX.MESREF = '$comp'
             GROUP BY ZH.ZH_EMPRESA, ZH.ZH_NOME, EX.MESREF, EX.NUMACS,
                      LC.CPF, ZH.ZH_CCEO, LC.DESC_FOLHA, LC.CCEO
             ORDER BY ZH.ZH_EMPRESA, ZH.ZH_NOME";


        $statement = new \Telephony\Models\Statement();

        $return = new Resultset(null, $statement, $statement->getReadConnection()->query($query));

        if ($return == true) {
            return $return;
        } else {
            throw new \Telephony\Controllers\Exception('Erro no relatório de Rateio para Desconto em Folha.');
        }
    }

}
