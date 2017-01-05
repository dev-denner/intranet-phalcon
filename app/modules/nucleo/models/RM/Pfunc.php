<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models\RM;

use SysPhalcon\Models\ModelBase;

class Pfunc extends ModelBase {

    protected $pfCodColigada;
    protected $pfCodFilial;
    protected $pfChapa;
    protected $pfNome;
    protected $pfDataAdmissao;
    protected $pfCodPessoa;
    protected $pfCodSecao;
    protected $pfCodFuncao;
    protected $pfCodSituacao;
    protected $pfCodTipo;

    public function initialize() {

        parent::initialize();

        $this->setSchema('RM');
        $this->setConnectionService('rmDb');
        $this->setReadConnectionService('rmDb');

        $this->belongsTo('pfCodColigada', __NAMESPACE__ . '\Gcoligada', 'clCodColigada', ['alias' => 'Gcoligada']);
        $this->belongsTo('pfCodPessoa', __NAMESPACE__ . '\Ppessoa', 'ppCodigo', ['alias' => 'Ppessoa']);
        $this->belongsTo('pfCodTipo', __NAMESPACE__ . '\Ptpfunc', 'tiCodCliente', ['alias' => 'Ptpfunc']);
        $this->belongsTo(['pfCodColigada', 'pfCodFuncao'], __NAMESPACE__ . '\Pfuncao', ['fuCodColigada', 'fuCodigo'], ['alias' => 'Pfuncao']);
        $this->belongsTo('pfCodSituacao', __NAMESPACE__ . '\Pcodsituacao', 'siCodCliente', ['alias' => 'Pcodsituacao']);
        $this->belongsTo(['pfCodColigada', 'pfCodSecao'], __NAMESPACE__ . '\Psecao', ['psCodColigada', 'psCodigo'], ['alias' => 'Psecao']);
        $this->belongsTo(['pfCodColigada', 'pfCodFilial'], __NAMESPACE__ . '\Gfilial', ['fiCodColigada', 'fiCodFilial'], ['alias' => 'Gfilial']);
    }

    public function getSource() {
        return 'PFUNC';
    }

    public static function columnMap() {
        return [
            'CODCOLIGADA' => 'pfCodColigada',
            'CODFILIAL' => 'pfCodFilial',
            'CHAPA' => 'pfChapa',
            'NOME' => 'pfNome',
            'DATAADMISSAO' => 'pfDataAdmissao',
            'CODPESSOA' => 'pfCodPessoa',
            'CODSECAO' => 'pfCodSecao',
            'CODFUNCAO' => 'pfCodFuncao',
            'CODSITUACAO' => 'pfCodSituacao',
            'CODTIPO' => 'pfCodTipo',
        ];
    }

    public function getDadosFuncionario($cpf, $chapa) {

        $dadosFunc = $this->modelsManager->createBuilder()
                ->columns(['pfCodColigada coligada,
                                pfChapa chapa,
                                pfNome nome,
                                ppCpf cpf,
                                ppEmail emailPessoal,
                                TO_CHAR(pfDataAdmissao, \'DD/MM/YYYY\') dataAdmissao,
                                fuNome funcao,
                                psDescricao secao,
                                pfCodSecao codSecao,
                                UPPER(siDescricao) descSituacao,
                                pfCodTipo codTipoFunc,
                                TO_CHAR(ppDataNascimento, \'DD/MM/YYYY\') dataNascimento,
                                ppSexo sexo,
                                UPPER(tiDescricao) tipoFunc'])
                ->from(__NAMESPACE__ . '\Pfunc')
                ->innerJoin(__NAMESPACE__ . '\Ppessoa', 'ppCodigo = pfCodPessoa')
                ->innerJoin(__NAMESPACE__ . '\Ptpfunc', 'tiCodCliente = pfCodTipo')
                ->innerJoin(__NAMESPACE__ . '\Pcodsituacao', 'siCodCliente = pfCodSituacao')
                ->innerJoin(__NAMESPACE__ . '\Psecao', 'psCodColigada = pfCodColigada AND psCodigo = pfCodSecao')
                ->innerJoin(__NAMESPACE__ . '\Pfuncao', 'fuCodColigada = pfCodColigada AND fuCodigo = pfCodFuncao')
                ->where('ppCpf = :cpf: AND pfChapa = :chapa:', ['cpf' => $cpf, 'chapa' => $chapa])
                ->getQuery()
                ->execute();

        return $dadosFunc->toArray(0)[0];
    }

}
