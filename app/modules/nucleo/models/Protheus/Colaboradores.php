<?php

/**
 * @copyright   2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        https://github.com/denners777/API-Phalcon
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

namespace Nucleo\Models\Protheus;

use SysPhalcon\Models\ModelBase;

class Colaboradores extends ModelBase {

    protected $szhEmpresa;
    protected $szhNome;
    protected $szhPessoa;
    protected $szhCpf;
    protected $szhCnpj;
    protected $szhEmail;
    protected $szhDataAdmissao;
    protected $szhSituacao;
    protected $szhCCEO;
    protected $szhSecao;
    protected $szhDataDemissao;
    protected $szhMotivoDemissao;
    protected $szhRamal;
    protected $szhSdel;

    public function initialize() {

        parent::initialize();

        $this->setSchema('PRODUCAO_9ZGXI5');
        $this->setConnectionService('protheusDb');
        $this->setReadConnectionService('protheusDb');

        $this->belongsTo('szhEmail', __NAMESPACE__ . '\Zimbra', 'szgEmail', ['alias' => 'Zimbra',]);
    }

    public function getSource() {
        return 'SZH010';
    }

    public static function columnMap() {
        return [
            'ZH_EMPRESA' => 'szhEmpresa',
            'ZH_NOME' => 'szhNome',
            'ZH_PESSOA' => 'szhPessoa',
            'ZH_CPF' => 'szhCpf',
            'ZH_CNPJ' => 'szhCnpj',
            'ZH_EMAIL' => 'szhEmail',
            'ZH_DTADMIS' => 'szhDataAdmissao',
            'ZH_SITUACA' => 'szhSituacao',
            'ZH_CCEO' => 'szhCCEO',
            'ZH_SECAO' => 'szhSecao',
            'ZH_DTDEMIS' => 'szhDataDemissao',
            'ZH_MOTDEMI' => 'szhMotivoDemissao',
            'ZH_RAMAL' => 'szhRamal',
            'D_E_L_E_T_' => 'szhSdel',
        ];
    }

    public function getDadosFuncionario($cpf) {
        $empresas = $this->getNameEmpresas();
        $dadosFunc = $this->modelsManager->createBuilder()
                ->columns([$empresas . ' empresa,
                       TRIM(szhNome) nome,
                       szhPessoa pessoa,
                       TRIM(szhCpf) cpf,
                       TRIM(szhCnpj) cnpj,
                       TRIM(szhEmail) email,
                       TO_CHAR(TO_DATE(szhDataAdmissao, \'YYYYMMDD\'), \'DD/MM/YYYY\') dataAdmissao,
                       UPPER(szhSituacao) situacao,
                       TRIM(szhCCEO) cceo,
                       TRIM(szhSecao) codSecao,
                       TRIM(szhDataDemissao) dataDemissao,
                       TRIM(szhMotivoDemissao) motivoDemissao,
                       TRIM(szhRamal) ramal'])
                ->from(__NAMESPACE__ . '\Colaboradores')
                ->where("szhSdel = ' '")
                ->andWhere('TRIM(szhCpf) = :cpf:', ['cpf' => $cpf])
                ->getQuery()
                ->execute();

        return $dadosFunc->toArray(0)[0];
    }

    public function getEmpresas() {
        $empresas = $this->getNameEmpresas();
        $empresa = $this->modelsManager->createBuilder()
                ->columns(['DISTINCT TRIM(szhEmpresa) id, ' . $empresas . ' empresa'])
                ->from(__NAMESPACE__ . '\Colaboradores')
                ->where("szhSdel = ' '")
                ->orderBy(2)
                ->getQuery()
                ->execute();

        $return = [];

        foreach ($empresa->toArray(0) as $key => $value) {
            $return[$value['ID']] = $value['EMPRESA'];
        }

        return $return;
    }

    public function validaDadosFuncionario($cpf, $empresa, $dataAdmissao) {
        $empresas = $this->getNameEmpresas();
        $dadosFunc = $this->modelsManager->createBuilder()
                ->columns([$empresas . ' empresa,
                       TRIM(szhNome) nome,
                       szhPessoa pessoa,
                       TRIM(szhCpf) cpf,
                       TRIM(szhCnpj) cnpj,
                       TRIM(szhEmail) email,
                       TO_CHAR(TO_DATE(szhDataAdmissao, \'YYYYMMDD\'), \'DD/MM/YYYY\') dataAdmissao,
                       UPPER(szhSituacao) situacao,
                       TRIM(szhCCEO) cceo,
                       TRIM(szhSecao) codSecao,
                       TRIM(szhDataDemissao) dataDemissao,
                       TRIM(szhMotivoDemissao) motivoDemissao,
                       TRIM(szhRamal) ramal'])
                ->from(__NAMESPACE__ . '\Colaboradores')
                ->where("szhSdel = ' '")
                ->andWhere('TRIM(szhCpf) = :cpf:', ['cpf' => $cpf])
                ->andWhere('TRIM(szhEmpresa) = :empresa:', ['empresa' => $empresa])
                ->andWhere('TO_CHAR(TO_DATE(szhDataAdmissao, \'YYYYMMDD\'), \'DD/MM/YYYY\') = :dataAdmissao:', ['dataAdmissao' => $dataAdmissao])
                ->getQuery()
                ->execute();

        return $dadosFunc->toArray(0)[0];
    }

    private function getNameEmpresas() {
        return "CASE szhEmpresa
                  WHEN '01' THEN 'MPE MONTAGENS'
                  WHEN '02' THEN 'EBE'
                  WHEN '03' THEN 'MPE ENGENHARIA'
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
                  ELSE szhEmpresa
                END";
    }

}
