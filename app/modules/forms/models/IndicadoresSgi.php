<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace Forms\Models;

use SysPhalcon\Models\ModelBase;
use SysPhalcon\Models\beforeCreate;
use SysPhalcon\Models\beforeUpdate;
use Phalcon\Mvc\Model\Behavior\SoftDelete;
use Phalcon\Db\RawValue;

class IndicadoresSgi extends ModelBase {

    use beforeCreate;

use beforeUpdate;

    protected $id;
    protected $mesComp;
    protected $anoComp;
    protected $cpf;
    protected $cc;
    protected $nEmpregados;
    protected $nEmpregadosTerc;
    protected $hher;
    protected $hherTerc;
    protected $hherTotal;
    protected $hherTotalAno;
    protected $acidComAfast;
    protected $acidComAfastDiasPerd;
    protected $acidComAfastDiasDebit;
    protected $tfca;
    protected $tfcaMes;
    protected $txGravAcum;
    protected $txGravAcumMes;
    protected $nAcidSemAfast;
    protected $tfsa;
    protected $tfsaMes;
    protected $tor;
    protected $torMes;
    protected $nQuaseAcid;
    protected $nDesvio;
    protected $nAcidTrajSemAfast;
    protected $nAcidTrajComAfast;
    protected $nDiasPerdAcidTrajComAfast;
    protected $nCasosDoencasOcup;
    protected $nDiasPerdDoencas;
    protected $primeirosSocorros;
    protected $incendios;
    protected $totalHht;
    protected $percHhTrein;
    protected $campConscSms;
    protected $nAudComp;
    protected $metaEstabAvalSatisfCli;
    protected $unMetaEstabAvalSatisfCli;
    protected $resultAvalSatisfCli;
    protected $unResultAvalSatisfCli;
    protected $nReclamApresCli;
    protected $nReclamApresCliAtend;
    protected $nAcoesPrevent;
    protected $nAcoesCorret;
    protected $nNaoConform;
    protected $quantProfPertSesmt;
    protected $lampadas;
    protected $residOleo;
    protected $residuosEletroEletronico;
    protected $unResiduosEletroEletronico;
    protected $residuosEmergenciasAmbientais;
    protected $unResiduosEmergenciasAmbientais;
    protected $outResidPerig;
    protected $residContamOleoDerivados;
    protected $unResidContamOleoDerivados;
    protected $totalResidPapel;
    protected $unTotalResidPapel;
    protected $totalResidMadeira;
    protected $unTotalResidMadeira;
    protected $totalResidNaoRecicl;
    protected $unTotalResidNaoRecicl;
    protected $totalResidPlastico;
    protected $unTotalResidPlastico;
    protected $totalResidMetal;
    protected $unTotalResidMetal;
    protected $totalResidVidro;
    protected $unTotalResidVidro;
    protected $residConstrucaoCivil;
    protected $unResidConstrucaoCivil;
    protected $vazamGas;
    protected $unVazamGas;
    protected $vazamResidOleoso;
    protected $unVazamResidOleoso;
    protected $vazamLigInflamaveis;
    protected $unVazamLigInflamaveis;
    protected $obs;
    protected $membros;
    protected $sdel;
    protected $createBy;
    protected $createIn;
    protected $updateBy;
    protected $updateIn;

    public function getId() {
        return $this->id;
    }

    public function getMesComp() {
        return $this->mesComp;
    }

    public function getAnoComp() {
        return $this->anoComp;
    }

    public function getCpf() {
        return $this->cpf;
    }

    public function getCc() {
        return $this->cc;
    }

    public function getNEmpregados() {
        return $this->nEmpregados;
    }

    public function getNEmpregadosTerc() {
        return $this->nEmpregadosTerc;
    }

    public function getHher() {
        return number_format($this->hher, 2, ',', '.');
    }

    public function getHherTerc() {
        return number_format($this->hherTerc, 2, ',', '.');
    }

    public function getHherTotal() {
        return number_format($this->hherTotal, 2, ',', '.');
    }

    public function getHherTotalAno() {
        return number_format($this->hherTotalAno, 2, ',', '.');
    }

    public function getAcidComAfast() {
        return $this->acidComAfast;
    }

    public function getAcidComAfastDiasPerd() {
        return $this->acidComAfastDiasPerd;
    }

    public function getAcidComAfastDiasDebit() {
        return $this->acidComAfastDiasDebit;
    }

    public function getTfca() {
        return number_format($this->tfca, 2, ',', '.');
    }

    public function getTfcaMes() {
        return number_format($this->tfcaMes, 2, ',', '.');
    }

    public function getTxGravAcum() {
        return $this->txGravAcum;
    }

    public function getTxGravAcumMes() {
        return $this->txGravAcumMes;
    }

    public function getNAcidSemAfast() {
        return $this->nAcidSemAfast;
    }

    public function getTfsa() {
        return number_format($this->tfsa, 2, ',', '.');
    }

    public function getTfsaMes() {
        return number_format($this->tfsaMes, 2, ',', '.');
    }

    public function getTor() {
        return number_format($this->tor, 2, ',', '.');
    }

    public function getTorMes() {
        return number_format($this->torMes, 2, ',', '.');
    }

    public function getNQuaseAcid() {
        return $this->nQuaseAcid;
    }

    public function getNDesvio() {
        return $this->nDesvio;
    }

    public function getNAcidTrajSemAfast() {
        return $this->nAcidTrajSemAfast;
    }

    public function getNAcidTrajComAfast() {
        return $this->nAcidTrajComAfast;
    }

    public function getNDiasPerdAcidTrajComAfast() {
        return $this->nDiasPerdAcidTrajComAfast;
    }

    public function getNCasosDoencasOcup() {
        return $this->nCasosDoencasOcup;
    }

    public function getNDiasPerdDoencas() {
        return $this->nDiasPerdDoencas;
    }

    public function getPrimeirosSocorros() {
        return $this->primeirosSocorros;
    }

    public function getIncendios() {
        return $this->incendios;
    }

    public function getTotalHht() {
        return $this->totalHht;
    }

    public function getPercHhTrein() {
        return number_format($this->percHhTrein, 2, ',', '.');
    }

    public function getCampConscSms() {
        return $this->campConscSms;
    }

    public function getNAudComp() {
        return $this->nAudComp;
    }

    public function getMetaEstabAvalSatisfCli() {
        return number_format($this->metaEstabAvalSatisfCli, 2, ',', '.');
    }

    public function getUnMetaEstabAvalSatisfCli() {
        return $this->unMetaEstabAvalSatisfCli;
    }

    public function getResultAvalSatisfCli() {
        return number_format($this->resultAvalSatisfCli, 2, ',', '.');
    }

    public function getUnResultAvalSatisfCli() {
        return $this->unResultAvalSatisfCli;
    }

    public function getNReclamApresCli() {
        return $this->nReclamApresCli;
    }

    public function getNReclamApresCliAtend() {
        return $this->nReclamApresCliAtend;
    }

    public function getNAcoesPrevent() {
        return $this->nAcoesPrevent;
    }

    public function getNAcoesCorret() {
        return $this->nAcoesCorret;
    }

    public function getNNaoConform() {
        return $this->nNaoConform;
    }

    public function getQuantProfPertSesmt() {
        return $this->quantProfPertSesmt;
    }

    public function getLampadas() {
        return $this->lampadas;
    }

    public function getResidOleo() {
        return number_format($this->residOleo, 2, ',', '.');
    }

    public function getResiduosEletroEletronico() {
        return number_format($this->residuosEletroEletronico, 2, ',', '.');
    }

    public function getUnResiduosEletroEletronico() {
        return $this->unResiduosEletroEletronico;
    }

    public function getResiduosEmergenciasAmbientais() {
        return number_format($this->residuosEmergenciasAmbientais, 2, ',', '.');
    }

    public function getUnResiduosEmergenciasAmbientais() {
        return $this->unResiduosEmergenciasAmbientais;
    }

    public function getOutResidPerig() {
        return $this->outResidPerig;
    }

    public function getResidContamOleoDerivados() {
        return number_format($this->residContamOleoDerivados, 2, ',', '.');
    }

    public function getUnResidContamOleoDerivados() {
        return $this->unResidContamOleoDerivados;
    }

    public function getTotalResidPapel() {
        return number_format($this->totalResidPapel, 2, ',', '.');
    }

    public function getUnTotalResidPapel() {
        return $this->unTotalResidPapel;
    }

    public function getTotalResidMadeira() {
        return number_format($this->totalResidMadeira, 2, ',', '.');
    }

    public function getUnTotalResidMadeira() {
        return $this->unTotalResidMadeira;
    }

    public function getTotalResidNaoRecicl() {
        return number_format($this->totalResidNaoRecicl, 2, ',', '.');
    }

    public function getUnTotalResidNaoRecicl() {
        return $this->unTotalResidNaoRecicl;
    }

    public function getTotalResidPlastico() {
        return number_format($this->totalResidPlastico, 2, ',', '.');
    }

    public function getUnTotalResidPlastico() {
        return $this->unTotalResidPlastico;
    }

    public function getTotalResidMetal() {
        return number_format($this->totalResidMetal, 2, ',', '.');
    }

    public function getUnTotalResidMetal() {
        return $this->unTotalResidMetal;
    }

    public function getTotalResidVidro() {
        return number_format($this->totalResidVidro, 2, ',', '.');
    }

    public function getUnTotalResidVidro() {
        return $this->unTotalResidVidro;
    }

    public function getResidConstrucaoCivil() {
        return number_format($this->residConstrucaoCivil, 2, ',', '.');
    }

    public function getUnResidConstrucaoCivil() {
        return $this->unResidConstrucaoCivil;
    }

    public function getVazamGas() {
        return number_format($this->vazamGas, 2, ',', '.');
    }

    public function getUnVazamGas() {
        return $this->unVazamGas;
    }

    public function getVazamResidOleoso() {
        return number_format($this->vazamResidOleoso, 2, ',', '.');
    }

    public function getUnVazamResidOleoso() {
        return $this->unVazamResidOleoso;
    }

    public function getVazamLigInflamaveis() {
        return number_format($this->vazamLigInflamaveis, 2, ',', '.');
    }

    public function getUnVazamLigInflamaveis() {
        return $this->unVazamLigInflamaveis;
    }

    public function getObs() {
        return $this->obs;
    }

    public function getMembros() {
        return $this->membros;
    }

    public function getSdel() {
        return $this->sdel;
    }

    public function getCreateBy() {
        return $this->createBy;
    }

    public function getCreateIn() {
        return $this->createIn;
    }

    public function getUpdateBy() {
        return $this->updateBy;
    }

    public function getUpdateIn() {
        return $this->updateIn;
    }

    //setters

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    public function setMesComp($mesComp) {
        $this->mesComp = $mesComp;
        return $this;
    }

    public function setAnoComp($anoComp) {
        $this->anoComp = $anoComp;
        return $this;
    }

    public function setCpf($cpf) {
        $this->cpf = $cpf;
        return $this;
    }

    public function setCc($cc) {
        $this->cc = $cc;
        return $this;
    }

    public function setNEmpregados($nEmpregados) {
        $this->nEmpregados = $nEmpregados;
        return $this;
    }

    public function setNEmpregadosTerc($nEmpregadosTerc) {
        $this->nEmpregadosTerc = $nEmpregadosTerc;
        return $this;
    }

    public function setHher($hher) {
        $this->hher = new RawValue("TO_NUMBER('{$hher}')");
        return $this;
    }

    public function setHherTerc($hherTerc) {
        $this->hherTerc = new RawValue("TO_NUMBER('{$hherTerc}')");
        return $this;
    }

    public function setHherTotal($hherTotal) {
        $this->hherTotal = new RawValue("TO_NUMBER('{$hherTotal}')");
        return $this;
    }

    public function setHherTotalAno($hherTotalAno) {
        $this->hherTotalAno = new RawValue("TO_NUMBER('{$hherTotalAno}')");
        return $this;
    }

    public function setAcidComAfast($acidComAfast) {
        $this->acidComAfast = $acidComAfast;
        return $this;
    }

    public function setAcidComAfastDiasPerd($acidComAfastDiasPerd) {
        $this->acidComAfastDiasPerd = $acidComAfastDiasPerd;
        return $this;
    }

    public function setAcidComAfastDiasDebit($acidComAfastDiasDebit) {
        $this->acidComAfastDiasDebit = $acidComAfastDiasDebit;
        return $this;
    }

    public function setTfca($tfca) {
        $this->tfca = new RawValue("TO_NUMBER('{$tfca}')");
        return $this;
    }

    public function setTfcaMes($tfcaMes) {
        $this->tfcaMes = new RawValue("TO_NUMBER('{$tfcaMes}')");
        return $this;
    }

    public function setTxGravAcum($txGravAcum) {
        $this->txGravAcum = $txGravAcum;
        return $this;
    }

    public function setTxGravAcumMes($txGravAcumMes) {
        $this->txGravAcumMes = $txGravAcumMes;
        return $this;
    }

    public function setNAcidSemAfast($nAcidSemAfast) {
        $this->nAcidSemAfast = $nAcidSemAfast;
        return $this;
    }

    public function setTfsa($tfsa) {
        $this->tfsa = new RawValue("TO_NUMBER('{$tfsa}')");
        return $this;
    }

    public function setTfsaMes($tfsaMes) {
        $this->tfsaMes = new RawValue("TO_NUMBER('{$tfsaMes}')");
        return $this;
    }

    public function setTor($tor) {
        $this->tor = new RawValue("TO_NUMBER('{$tor}')");
        return $this;
    }

    public function setTorMes($torMes) {
        $this->torMes = new RawValue("TO_NUMBER('{$torMes}')");
        return $this;
    }

    public function setNQuaseAcid($nQuaseAcid) {
        $this->nQuaseAcid = $nQuaseAcid;
        return $this;
    }

    public function setNDesvio($nDesvio) {
        $this->nDesvio = $nDesvio;
        return $this;
    }

    public function setNAcidTrajSemAfast($nAcidTrajSemAfast) {
        $this->nAcidTrajSemAfast = $nAcidTrajSemAfast;
        return $this;
    }

    public function setNAcidTrajComAfast($nAcidTrajComAfast) {
        $this->nAcidTrajComAfast = $nAcidTrajComAfast;
        return $this;
    }

    public function setNDiasPerdAcidTrajComAfast($nDiasPerdAcidTrajComAfast) {
        $this->nDiasPerdAcidTrajComAfast = $nDiasPerdAcidTrajComAfast;
        return $this;
    }

    public function setNCasosDoencasOcup($nCasosDoencasOcup) {
        $this->nCasosDoencasOcup = $nCasosDoencasOcup;
        return $this;
    }

    public function setNDiasPerdDoencas($nDiasPerdDoencas) {
        $this->nDiasPerdDoencas = $nDiasPerdDoencas;
        return $this;
    }

    public function setPrimeirosSocorros($primeirosSocorros) {
        $this->primeirosSocorros = $primeirosSocorros;
        return $this;
    }

    public function setIncendios($incendios) {
        $this->incendios = $incendios;
        return $this;
    }

    public function setTotalHht($totalHht) {
        $this->totalHht = $totalHht;
        return $this;
    }

    public function setPercHhTrein($percHhTrein) {
        $this->percHhTrein = new RawValue("TO_NUMBER('{$percHhTrein}')");
        return $this;
    }

    public function setCampConscSms($campConscSms) {
        $this->campConscSms = $campConscSms;
        return $this;
    }

    public function setNAudComp($nAudComp) {
        $this->nAudComp = $nAudComp;
        return $this;
    }

    public function setMetaEstabAvalSatisfCli($metaEstabAvalSatisfCli) {
        $this->metaEstabAvalSatisfCli = new RawValue("TO_NUMBER('{$metaEstabAvalSatisfCli}')");
        return $this;
    }

    public function setUnMetaEstabAvalSatisfCli($unMetaEstabAvalSatisfCli) {
        $this->unMetaEstabAvalSatisfCli = $unMetaEstabAvalSatisfCli;
        return $this;
    }

    public function setResultAvalSatisfCli($resultAvalSatisfCli) {
        $this->resultAvalSatisfCli = new RawValue("TO_NUMBER('{$resultAvalSatisfCli}')");
        return $this;
    }

    public function setUnResultAvalSatisfCli($unResultAvalSatisfCli) {
        $this->unResultAvalSatisfCli = $unResultAvalSatisfCli;
        return $this;
    }

    public function setNReclamApresCli($nReclamApresCli) {
        $this->nReclamApresCli = $nReclamApresCli;
        return $this;
    }

    public function setNReclamApresCliAtend($nReclamApresCliAtend) {
        $this->nReclamApresCliAtend = $nReclamApresCliAtend;
        return $this;
    }

    public function setNAcoesPrevent($nAcoesPrevent) {
        $this->nAcoesPrevent = $nAcoesPrevent;
        return $this;
    }

    public function setNAcoesCorret($nAcoesCorret) {
        $this->nAcoesCorret = $nAcoesCorret;
        return $this;
    }

    public function setNNaoConform($nNaoConform) {
        $this->nNaoConform = $nNaoConform;
        return $this;
    }

    public function setQuantProfPertSesmt($quantProfPertSesmt) {
        $this->quantProfPertSesmt = $quantProfPertSesmt;
        return $this;
    }

    public function setLampadas($lampadas) {
        $this->lampadas = $lampadas;
        return $this;
    }

    public function setResidOleo($residOleo) {
        $this->residOleo = new RawValue("TO_NUMBER('{$residOleo}')");
        return $this;
    }

    public function setResiduosEletroEletronico($residuosEletroEletronico) {
        $this->residuosEletroEletronico = new RawValue("TO_NUMBER('{$residuosEletroEletronico}')");
        return $this;
    }

    public function setUnResiduosEletroEletronico($unResiduosEletroEletronico) {
        $this->unResiduosEletroEletronico = $unResiduosEletroEletronico;
        return $this;
    }

    public function setResiduosEmergenciasAmbientais($residuosEmergenciasAmbientais) {
        $this->residuosEmergenciasAmbientais = new RawValue("TO_NUMBER('{$residuosEmergenciasAmbientais}')");
        return $this;
    }

    public function setUnResiduosEmergenciasAmbientais($unResiduosEmergenciasAmbientais) {
        $this->unResiduosEmergenciasAmbientais = $unResiduosEmergenciasAmbientais;
        return $this;
    }

    public function setOutResidPerig($outResidPerig) {
        $this->outResidPerig = $outResidPerig;
        return $this;
    }

    public function setResidContamOleoDerivados($residContamOleoDerivados) {
        $this->residContamOleoDerivados = new RawValue("TO_NUMBER('{$residContamOleoDerivados}')");
        return $this;
    }

    public function setUnResidContamOleoDerivados($unResidContamOleoDerivados) {
        $this->unResidContamOleoDerivados = $unResidContamOleoDerivados;
        return $this;
    }

    public function setTotalResidPapel($totalResidPapel) {
        $this->totalResidPapel = new RawValue("TO_NUMBER('{$totalResidPapel}')");
        return $this;
    }

    public function setUnTotalResidPapel($unTotalResidPapel) {
        $this->unTotalResidPapel = $unTotalResidPapel;
        return $this;
    }

    public function setTotalResidMadeira($totalResidMadeira) {
        $this->totalResidMadeira = new RawValue("TO_NUMBER('{$totalResidMadeira}')");
        return $this;
    }

    public function setUnTotalResidMadeira($unTotalResidMadeira) {
        $this->unTotalResidMadeira = $unTotalResidMadeira;
        return $this;
    }

    public function setTotalResidNaoRecicl($totalResidNaoRecicl) {
        $this->totalResidNaoRecicl = new RawValue("TO_NUMBER('{$totalResidNaoRecicl}')");
        return $this;
    }

    public function setUnTotalResidNaoRecicl($unTotalResidNaoRecicl) {
        $this->unTotalResidNaoRecicl = $unTotalResidNaoRecicl;
        return $this;
    }

    public function setTotalResidPlastico($totalResidPlastico) {
        $this->totalResidPlastico = new RawValue("TO_NUMBER('{$totalResidPlastico}')");
        return $this;
    }

    public function setUnTotalResidPlastico($unTotalResidPlastico) {
        $this->unTotalResidPlastico = $unTotalResidPlastico;
        return $this;
    }

    public function setTotalResidMetal($totalResidMetal) {
        $this->totalResidMetal = new RawValue("TO_NUMBER('{$totalResidMetal}')");
        return $this;
    }

    public function setUnTotalResidMetal($unTotalResidMetal) {
        $this->unTotalResidMetal = $unTotalResidMetal;
        return $this;
    }

    public function setTotalResidVidro($totalResidVidro) {
        $this->totalResidVidro = new RawValue("TO_NUMBER('{$totalResidVidro}')");
        return $this;
    }

    public function setUnTotalResidVidro($unTotalResidVidro) {
        $this->unTotalResidVidro = $unTotalResidVidro;
        return $this;
    }

    public function setResidConstrucaoCivil($residConstrucaoCivil) {
        $this->residConstrucaoCivil = new RawValue("TO_NUMBER('{$residConstrucaoCivil}')");
        return $this;
    }

    public function setUnResidConstrucaoCivil($unResidConstrucaoCivil) {
        $this->unResidConstrucaoCivil = $unResidConstrucaoCivil;
        return $this;
    }

    public function setVazamGas($vazamGas) {
        $this->vazamGas = new RawValue("TO_NUMBER('{$vazamGas}')");
        return $this;
    }

    public function setUnVazamGas($unVazamGas) {
        $this->unVazamGas = $unVazamGas;
        return $this;
    }

    public function setVazamResidOleoso($vazamResidOleoso) {
        $this->vazamResidOleoso = new RawValue("TO_NUMBER('{$vazamResidOleoso}')");
        return $this;
    }

    public function setUnVazamResidOleoso($unVazamResidOleoso) {
        $this->unVazamResidOleoso = $unVazamResidOleoso;
        return $this;
    }

    public function setVazamLigInflamaveis($vazamLigInflamaveis) {
        $this->vazamLigInflamaveis = new RawValue("TO_NUMBER('{$vazamLigInflamaveis}')");
        return $this;
    }

    public function setUnVazamLigInflamaveis($unVazamLigInflamaveis) {
        $this->unVazamLigInflamaveis = $unVazamLigInflamaveis;
        return $this;
    }

    public function setObs($obs) {
        $this->obs = $obs;
        return $this;
    }

    public function setMembros($membros) {
        $this->membros = $membros;
        return $this;
    }

    public function setSdel($sdel) {
        $this->sdel = $sdel;
        return $this;
    }

    public function setCreateBy($createBy) {
        $this->createBy = $createBy;
        return $this;
    }

    public function setCreateIn($createIn) {
        $this->createIn = $createIn;
        return $this;
    }

    public function setUpdateBy($updateBy) {
        $this->updateBy = $updateBy;
        return $this;
    }

    public function setUpdateIn($updateIn) {
        $this->updateIn = $updateIn;
        return $this;
    }

    /**
     * Initialize method for model.
     */
    public function initialize() {

        parent::initialize();

        $this->addBehavior(new SoftDelete([
            'field' => 'sdel',
            'value' => '*'
        ]));
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource() {
        return 'FRM_INDICADORES_SGI';
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public static function columnMap() {
        return [
            'ID_FRM_INDICADORES_SGI' => 'id',
            'NO_MESCOMP' => 'mesComp',
            'NO_ANOCOMP' => 'anoComp',
            'DS_CPF' => 'cpf',
            'DS_CC' => 'cc',
            'NO_N_EMPREGADOS' => 'nEmpregados',
            'NO_N_EMPREGADOS_TERC' => 'nEmpregadosTerc',
            'VR_HHER' => 'hher',
            'VR_HHER_TERC' => 'hherTerc',
            'VR_HHER_TOTAL' => 'hherTotal',
            'VR_HHER_TOTAL_ANO' => 'hherTotalAno',
            'NO_N_ACID_C_AFAST' => 'acidComAfast',
            'NO_N_ACID_C_AFAST_D_PERD' => 'acidComAfastDiasPerd',
            'NO_N_ACID_C_AFAST_D_DEBIT' => 'acidComAfastDiasDebit',
            'VR_TFCA' => 'tfca',
            'VR_TFCA_MES' => 'tfcaMes',
            'VR_TX_GRAV_ACUM' => 'txGravAcum',
            'VR_TX_GRAV_ACUM_MES' => 'txGravAcumMes',
            'NO_N_ACID_S_AFAST' => 'nAcidSemAfast',
            'VR_TFSA' => 'tfsa',
            'VR_TFSA_MES' => 'tfsaMes',
            'VR_TOR' => 'tor',
            'VR_TOR_MES' => 'torMes',
            'NO_N_QUASE_ACID' => 'nQuaseAcid',
            'NO_N_DESVIO' => 'nDesvio',
            'NO_N_ACID_TRAJ_S_AFAST' => 'nAcidTrajSemAfast',
            'NO_N_ACID_TRAJ_C_AFAST' => 'nAcidTrajComAfast',
            'NO_N_D_PERD_ACID_TRAJ_C_AFAST' => 'nDiasPerdAcidTrajComAfast',
            'NO_N_CASOS_DOENCAS_OCUP' => 'nCasosDoencasOcup',
            'NO_N_D_PERD_DOENCAS' => 'nDiasPerdDoencas',
            'NO_PRIMEIROS_SOCORROS' => 'primeirosSocorros',
            'NO_INCENDIOS' => 'incendios',
            'NO_TOTAL_HHT' => 'totalHht',
            'VR_PERC_HH_TREIN' => 'percHhTrein',
            'NO_CAMP_CONSC_SMS' => 'campConscSms',
            'NO_N_AUD_COMP' => 'nAudComp',
            'VR_META_ESTAB_AVAL_SATISF_CLI' => 'metaEstabAvalSatisfCli',
            'DS_M_EST_AVAL_SAT_CLI_UN' => 'unMetaEstabAvalSatisfCli',
            'VR_RESULT_AVAL_SATISF_CLI' => 'resultAvalSatisfCli',
            'DS_RES_AVAL_SAT_CLI_UN' => 'unResultAvalSatisfCli',
            'NO_N_RECLAM_APRES_CLI' => 'nReclamApresCli',
            'NO_N_RECLAM_APRES_CLI_ATEND' => 'nReclamApresCliAtend',
            'NO_N_ACOES_PREVENT' => 'nAcoesPrevent',
            'NO_N_ACOES_CORRET' => 'nAcoesCorret',
            'NO_N_NAO_CONFORM' => 'nNaoConform',
            'NO_QUANT_PROF_PERTENC_SESMT' => 'quantProfPertSesmt',
            'NO_LAMPADAS' => 'lampadas',
            'VR_RESID_OLEO' => 'residOleo',
            'VR_RESID_ELET_ELETRON' => 'residuosEletroEletronico',
            'DS_RESID_ELET_ELETRON_UN' => 'unResiduosEletroEletronico',
            'VR_RESID_EMERG_AMBIENTAL' => 'residuosEmergenciasAmbientais',
            'DS_RESID_EMERG_AMBIENTAL_UN' => 'unResiduosEmergenciasAmbientais',
            'DS_OUT_RESID_PERIG' => 'outResidPerig',
            'VR_RESID_CONTAM_OLEO_DERIVADOS' => 'residContamOleoDerivados',
            'DS_RESID_CONTAM_OLEO_DER_UN' => 'unResidContamOleoDerivados',
            'VR_TOTAL_RESID_PAPEL' => 'totalResidPapel',
            'DS_TOTAL_RESID_PAPEL_UN' => 'unTotalResidPapel',
            'VR_TOTAL_RESID_MADEIRA' => 'totalResidMadeira',
            'DS_TOTAL_RESID_MADEIRA_UN' => 'unTotalResidMadeira',
            'VR_TOTAL_RESID_NAO_RECICL' => 'totalResidNaoRecicl',
            'DS_TOTAL_RESID_NAO_RECICL_UN' => 'unTotalResidNaoRecicl',
            'VR_TOTAL_RESID_PLASTICO' => 'totalResidPlastico',
            'DS_TOTAL_RESID_PLASTICO_UN' => 'unTotalResidPlastico',
            'VR_TOTAL_RESID_METAL' => 'totalResidMetal',
            'DS_TOTAL_RESID_METAL_UN' => 'unTotalResidMetal',
            'VR_TOTAL_RESID_VIDRO' => 'totalResidVidro',
            'DS_TOTAL_RESID_VIDRO_UN' => 'unTotalResidVidro',
            'VR_RESID_CONSTRUCAO_CIVIL' => 'residConstrucaoCivil',
            'DS_RESID_CONSTRUCAO_CIVIL_UN' => 'unResidConstrucaoCivil',
            'VR_VAZAM_GAS' => 'vazamGas',
            'VR_VAZAM_GAS_UN' => 'unVazamGas',
            'VR_VAZAM_RESID_OLEOSO' => 'vazamResidOleoso',
            'DS_VAZAM_RESID_OLEOSO_UN' => 'unVazamResidOleoso',
            'VR_VAZAM_LIQ_INFLAMAVEIS' => 'vazamLigInflamaveis',
            'DS_VAZAM_LIQ_INFLAMAVEIS_UN' => 'unVazamLigInflamaveis',
            'DS_OBS' => 'obs',
            'DS_MEMBROS' => 'membros',
            'SDEL' => 'sdel',
            'CREATEBY' => 'createBy',
            'CREATEIN' => 'createIn',
            'UPDATEBY' => 'updateBy',
            'UPDATEIN' => 'updateIn',
        ];
    }

    public static function getDeleted() {
        return 'sdel';
    }

    public function getSumHherTotalAno($mes, $ano, $cc) {

        return $this->modelsManager->createBuilder()
                            ->from(__NAMESPACE__ . '\IndicadoresSgi')
                            ->columns('SUM(hherTotal) NU_HHER_TOTAL_ANO')
                            ->where("mesComp < {$mes} AND anoComp = {$ano} AND cc = '{$cc}'")
                            ->getQuery()
                            ->execute()
                            ->toArray();
    }

    public function getSumTfca($mes, $ano, $cc) {

        return $this->modelsManager->createBuilder()
                            ->from(__NAMESPACE__ . '\IndicadoresSgi')
                            ->columns('SUM(acidComAfast) NU_TFCA')
                            ->where("mesComp < {$mes} AND anoComp = {$ano} AND cc = '{$cc}'")
                            ->getQuery()
                            ->execute()
                            ->toArray();
    }

    public function getSumTxGravAcum($mes, $ano, $cc) {

        return $this->modelsManager->createBuilder()
                            ->from(__NAMESPACE__ . '\IndicadoresSgi')
                            ->columns('SUM(acidComAfastDiasPerd) + SUM(acidComAfastDiasDebit) NU_TX_GRAV_ACUM')
                            ->where("mesComp < {$mes} AND anoComp = {$ano} AND cc = '{$cc}'")
                            ->getQuery()
                            ->execute()
                            ->toArray();
    }

    public function getSumTfsa($mes, $ano, $cc) {

        return $this->modelsManager->createBuilder()
                            ->from(__NAMESPACE__ . '\IndicadoresSgi')
                            ->columns('SUM(nAcidSemAfast) NU_TFSA')
                            ->where("mesComp < {$mes} AND anoComp = {$ano} AND cc = '{$cc}'")
                            ->getQuery()
                            ->execute()
                            ->toArray();
    }

    public function getSumTor($mes, $ano, $cc) {

        return $this->modelsManager->createBuilder()
                            ->from(__NAMESPACE__ . '\IndicadoresSgi')
                            ->columns('SUM(acidComAfast) + SUM(nAcidSemAfast) NU_TOR')
                            ->where("mesComp < {$mes} AND anoComp = {$ano} AND cc = '{$cc}'")
                            ->getQuery()
                            ->execute()
                            ->toArray();
    }

}
