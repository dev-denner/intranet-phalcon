<?php

/**
 * @copyright   2015 - 2015 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
**/
        

namespace Nucleo\Models;

use Phalcon\Mvc\Model;
use \Phalcon\Mvc\Model\Validator\Email;

/**
 * Class Funcionarios
 * @package Nucleo\Models
 */
class Funcionarios extends Model
{

    /**
     * @var integer
     */
    protected $id;

    /**
     * @var string
     */
    protected $chapa;

    /**
     * @var string
     */
    protected $nome;

    /**
     * @var string
     */
    protected $cpf;

    /**
     * @var integer
     */
    protected $empresa;

    /**
     * @var string
     */
    protected $situacao;

    /**
     * @var string
     */
    protected $tipo;

    /**
     * @var string
     */
    protected $dataadmissao;

    /**
     * @var string
     */
    protected $cargo;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $centrocusto;

    /**
     * @var integer
     */
    protected $banco;

    /**
     * @var integer
     */
    protected $numagencia;

    /**
     * @var string
     */
    protected $digagencia;

    /**
     * @var integer
     */
    protected $numconta;

    /**
     * @var string
     */
    protected $digconta;

    /**
     * @var integer
     */
    protected $periodopagto;

    /**
     * @var string
     */
    protected $sdel;

    /**
     * @var string
     */
    protected $usercreate;

    /**
     * @var string
     */
    protected $datacreate;

    /**
     * @var string
     */
    protected $userupdate;

    /**
     * @var string
     */
    protected $dataupdate;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field chapa
     *
     * @param string $chapa
     * @return $this
     */
    public function setChapa($chapa)
    {
        $this->chapa = $chapa;

        return $this;
    }

    /**
     * Method to set the value of field nome
     *
     * @param string $nome
     * @return $this
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Method to set the value of field cpf
     *
     * @param string $cpf
     * @return $this
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    /**
     * Method to set the value of field empresa
     *
     * @param integer $empresa
     * @return $this
     */
    public function setEmpresa($empresa)
    {
        $this->empresa = $empresa;

        return $this;
    }

    /**
     * Method to set the value of field situacao
     *
     * @param string $situacao
     * @return $this
     */
    public function setSituacao($situacao)
    {
        $this->situacao = $situacao;

        return $this;
    }

    /**
     * Method to set the value of field tipo
     *
     * @param string $tipo
     * @return $this
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;

        return $this;
    }

    /**
     * Method to set the value of field dataadmissao
     *
     * @param string $dataadmissao
     * @return $this
     */
    public function setDataadmissao($dataadmissao)
    {
        $this->dataadmissao = $dataadmissao;

        return $this;
    }

    /**
     * Method to set the value of field cargo
     *
     * @param string $cargo
     * @return $this
     */
    public function setCargo($cargo)
    {
        $this->cargo = $cargo;

        return $this;
    }

    /**
     * Method to set the value of field email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Method to set the value of field centrocusto
     *
     * @param string $centrocusto
     * @return $this
     */
    public function setCentrocusto($centrocusto)
    {
        $this->centrocusto = $centrocusto;

        return $this;
    }

    /**
     * Method to set the value of field banco
     *
     * @param integer $banco
     * @return $this
     */
    public function setBanco($banco)
    {
        $this->banco = $banco;

        return $this;
    }

    /**
     * Method to set the value of field numagencia
     *
     * @param integer $numagencia
     * @return $this
     */
    public function setNumagencia($numagencia)
    {
        $this->numagencia = $numagencia;

        return $this;
    }

    /**
     * Method to set the value of field digagencia
     *
     * @param string $digagencia
     * @return $this
     */
    public function setDigagencia($digagencia)
    {
        $this->digagencia = $digagencia;

        return $this;
    }

    /**
     * Method to set the value of field numconta
     *
     * @param integer $numconta
     * @return $this
     */
    public function setNumconta($numconta)
    {
        $this->numconta = $numconta;

        return $this;
    }

    /**
     * Method to set the value of field digconta
     *
     * @param string $digconta
     * @return $this
     */
    public function setDigconta($digconta)
    {
        $this->digconta = $digconta;

        return $this;
    }

    /**
     * Method to set the value of field periodopagto
     *
     * @param integer $periodopagto
     * @return $this
     */
    public function setPeriodopagto($periodopagto)
    {
        $this->periodopagto = $periodopagto;

        return $this;
    }

    /**
     * Method to set the value of field sdel
     *
     * @param string $sdel
     * @return $this
     */
    public function setSdel($sdel)
    {
        $this->sdel = $sdel;

        return $this;
    }

    /**
     * Method to set the value of field usercreate
     *
     * @param string $usercreate
     * @return $this
     */
    public function setUsercreate($usercreate)
    {
        $this->usercreate = $usercreate;

        return $this;
    }

    /**
     * Method to set the value of field datacreate
     *
     * @param string $datacreate
     * @return $this
     */
    public function setDatacreate($datacreate)
    {
        $this->datacreate = $datacreate;

        return $this;
    }

    /**
     * Method to set the value of field userupdate
     *
     * @param string $userupdate
     * @return $this
     */
    public function setUserupdate($userupdate)
    {
        $this->userupdate = $userupdate;

        return $this;
    }

    /**
     * Method to set the value of field dataupdate
     *
     * @param string $dataupdate
     * @return $this
     */
    public function setDataupdate($dataupdate)
    {
        $this->dataupdate = $dataupdate;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field chapa
     *
     * @return string
     */
    public function getChapa()
    {
        return $this->chapa;
    }

    /**
     * Returns the value of field nome
     *
     * @return string
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Returns the value of field cpf
     *
     * @return string
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Returns the value of field empresa
     *
     * @return integer
     */
    public function getEmpresa()
    {
        return $this->empresa;
    }

    /**
     * Returns the value of field situacao
     *
     * @return string
     */
    public function getSituacao()
    {
        return $this->situacao;
    }

    /**
     * Returns the value of field tipo
     *
     * @return string
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Returns the value of field dataadmissao
     *
     * @return string
     */
    public function getDataadmissao()
    {
        return $this->dataadmissao;
    }

    /**
     * Returns the value of field cargo
     *
     * @return string
     */
    public function getCargo()
    {
        return $this->cargo;
    }

    /**
     * Returns the value of field email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Returns the value of field centrocusto
     *
     * @return string
     */
    public function getCentrocusto()
    {
        return $this->centrocusto;
    }

    /**
     * Returns the value of field banco
     *
     * @return integer
     */
    public function getBanco()
    {
        return $this->banco;
    }

    /**
     * Returns the value of field numagencia
     *
     * @return integer
     */
    public function getNumagencia()
    {
        return $this->numagencia;
    }

    /**
     * Returns the value of field digagencia
     *
     * @return string
     */
    public function getDigagencia()
    {
        return $this->digagencia;
    }

    /**
     * Returns the value of field numconta
     *
     * @return integer
     */
    public function getNumconta()
    {
        return $this->numconta;
    }

    /**
     * Returns the value of field digconta
     *
     * @return string
     */
    public function getDigconta()
    {
        return $this->digconta;
    }

    /**
     * Returns the value of field periodopagto
     *
     * @return integer
     */
    public function getPeriodopagto()
    {
        return $this->periodopagto;
    }

    /**
     * Returns the value of field sdel
     *
     * @return string
     */
    public function getSdel()
    {
        return $this->sdel;
    }

    /**
     * Returns the value of field usercreate
     *
     * @return string
     */
    public function getUsercreate()
    {
        return $this->usercreate;
    }

    /**
     * Returns the value of field datacreate
     *
     * @return string
     */
    public function getDatacreate()
    {
        return $this->datacreate;
    }

    /**
     * Returns the value of field userupdate
     *
     * @return string
     */
    public function getUserupdate()
    {
        return $this->userupdate;
    }

    /**
     * Returns the value of field dataupdate
     *
     * @return string
     */
    public function getDataupdate()
    {
        return $this->dataupdate;
    }

    /**
     * Validations and business logic
     */
    public function validation()
    {

        $this->validate(
            new Email(
                array(
                    'field'    => 'email',
                    'required' => true,
                )
            )
        );
        if ($this->validationHasFailed() == true) {
            return false;
        }
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSource('funcionarios');
        $this->belongsTo('empresa', 'Nucleo\Models\Empresas', 'id', array('alias' => 'Empresas'));
    }

    public function getSource()
    {
        return 'funcionarios';
    }

}
