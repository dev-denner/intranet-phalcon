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

    public $szhEmpresa;
    public $szhNome;
    public $szhChapa;
    public $szhPessoa;
    public $szhCpf;
    public $szhCnpj;
    public $szhEmail;
    public $szhDataAdmissao;
    public $szhSituacao;
    public $szhCCEO;
    public $szhSecao;
    public $szhDataDemissao;
    public $szhMotivoDemissao;
    public $szhRamal;
    public $szhSdel;

    public function initialize() {

        parent::initialize();

        $this->setSchema('PRODUCAO_9ZGXI5');
        $this->setConnectionService('protheusDb');
        $this->setReadConnectionService('protheusDb');

        $this->belongsTo('szhCpf', __NAMESPACE__ . '\Zimbra', 'szgCpf', ['alias' => 'Zimbra',]);
        $this->hasMany('SUBSTR(szhCpf, 1, 6)', '\Catraca\Models\Movimentos', 'SUBSTR(TRIM(id), 14, 6)', ['alias' => 'Colaboradores',]);
    }

    public function getSource() {
        return 'SZH010';
    }

    public static function columnMap() {
        return [
            'ZH_EMPRESA' => 'szhEmpresa',
            'ZH_NOME' => 'szhNome',
            'ZH_CHAPA' => 'szhChapa',
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

    public function getColaborador($search = '') {

        if (empty($search)) {
            throw new \Exception('Erro parametro vazio.');
        }

        $connection = $this->customSimpleQuery('db');

        $query = "SELECT * FROM VW_COLABORADOR_PROTHEUS WHERE CPF = ?";
        $protheus = $connection->fetchOne($query, \Phalcon\Db::FETCH_ASSOC, [$search]);

        $query = "SELECT * FROM VW_COLABORADOR_RM WHERE CPF = ? AND CHAPA = ?";
        $rm = $connection->fetchOne($query, \Phalcon\Db::FETCH_ASSOC, [$search, $protheus['CHAPA']]);
        return array_merge($protheus, $rm);
    }

    public function getColaboradorByCpf($cpf = '') {

        if (empty($cpf)) {
            throw new \Exception('Erro cpf vazio.');
        }

        $connection = $this->customSimpleQuery('db');

        $query = "SELECT TRIM(ZG.ZG_EMAIL) EMAIL, TRIM(ZH.ZH_CPF) CPF
                  FROM PRODUCAO_9ZGXI5.SZH010@PROTHEUSPROD ZH
                  LEFT JOIN PRODUCAO_9ZGXI5.SZG010@PROTHEUSPROD ZG
                        ON ZG.D_E_L_E_T_ = ' '
                       AND ZG.ZG_CPF = ZH.ZH_CPF
                       AND TRIM(ZG.ZG_STATUS) = 'ACTIVE'
                  WHERE ZH.D_E_L_E_T_ = ' '
                    AND TRIM(ZH.ZH_CPF) = ?";
        return $connection->fetchOne($query, \Phalcon\Db::FETCH_ASSOC, [$cpf]);
    }

    public function getColaboradorByEmail($search = '') {

        if (empty($search)) {
            throw new \Exception('Erro search vazio.');
        }

        $connection = $this->customSimpleQuery('db');

        $query = "SELECT * FROM VW_COLABORADOR_PROTHEUS WHERE EMAIL = ?";
        $protheus = $connection->fetchOne($query, \Phalcon\Db::FETCH_ASSOC, [$search]);

        if(!$protheus){
            return false;
        }
        
        $query = "SELECT * FROM VW_COLABORADOR_RM WHERE CPF = ? AND CHAPA = ?";
        $rm = $connection->fetchOne($query, \Phalcon\Db::FETCH_ASSOC, [$protheus['CPF'], $protheus['CHAPA']]);
        return array_merge($protheus, $rm);
    }

    public function getDadosFuncionario($cpf) {
        $empresas = $this->getNameEmpresas();
        $dadosFunc = $this->modelsManager->createBuilder()
                  ->columns([$empresas . ' empresa,
                       TRIM(szhEmpresa) codEmpresa,
                       TRIM(szhNome) nome,
                       TRIM(szhChapa) chapa,
                       TRIM(szhPessoa) pessoa,
                       TRIM(szhCpf) cpf,
                       TRIM(szhCnpj) cnpj,
                       TRIM(szgEmail) email,
                       TO_CHAR(TO_DATE(szhDataAdmissao, \'YYYYMMDD\'), \'DD/MM/YYYY\') dataAdmissao,
                       UPPER(szhSituacao) situacao,
                       TRIM(szhCCEO) cceo,
                       TRIM(szhSecao) codSecao,
                       TRIM(szhDataDemissao) dataDemissao,
                       TRIM(szhMotivoDemissao) motivoDemissao,
                       TRIM(szhRamal) ramal'])
                  ->from(__NAMESPACE__ . '\Colaboradores')
                  ->leftJoin(__NAMESPACE__ . '\Zimbra', "TRIM(szgCpf) = TRIM(szhCpf)")
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
                       TRIM(szhChapa) chapa,
                       TRIM(szhPessoa) pessoa,
                       TRIM(szgCpf) cpf,
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
                  ->leftJoin(__NAMESPACE__ . '\Zimbra', "TRIM(szgCpf) = TRIM(szhCpf)")
                  ->where("szhSdel = ' '")
                  ->andWhere('TRIM(szhCpf) = :cpf:', ['cpf' => $cpf])
                  ->andWhere('TRIM(szhEmpresa) = :empresa:', ['empresa' => $empresa])
                  ->andWhere('TO_CHAR(TO_DATE(szhDataAdmissao, \'YYYYMMDD\'), \'DD/MM/YYYY\') = :dataAdmissao:', ['dataAdmissao' => $dataAdmissao])
                  ->getQuery()
                  ->execute();

        return $dadosFunc->toArray(0)[0];
    }

    public function getNameEmpresas() {
        return "CASE szhEmpresa
                  WHEN '01' THEN 'MPE MONTAGENS'
                  WHEN '02' THEN 'EBE'
                  WHEN '03' THEN 'MPE ENGENHARIA'
                  WHEN '04' THEN 'GEMON'
                  WHEN '05' THEN 'VALENÇA'
                  WHEN '06' THEN 'AGROMOM'
                  WHEN '07' THEN 'AAT'
                  WHEN '08' THEN 'TEIA'
                  WHEN '09' THEN 'SOAHGRO'
                  WHEN '10' THEN 'MPE PAINEIS'
                  WHEN '11' THEN 'IRLA'
                  WHEN '12' THEN 'CANARI'
                  WHEN 'D8' THEN 'FW GEMON'
                  ELSE szhEmpresa
                END";
    }

}
