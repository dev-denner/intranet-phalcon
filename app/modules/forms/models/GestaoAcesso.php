<?php

/**
 * @copyright   2016 - 2016 Grupo MPE
 * @license     New BSD License; see LICENSE
 * @link        http://www.grupompe.com.br
 * @author      Denner Fernandes <denner.fernandes@grupompe.com.br>
 * */

namespace App\Modules\Forms\Models;

use App\Shared\Models\ModelBase;
use App\Shared\Models\beforeCreate;
use App\Shared\Models\beforeUpdate;
use Phalcon\Mvc\Model\Behavior\SoftDelete;

class GestaoAcesso extends ModelBase
{

    use beforeCreate;

    use beforeUpdate;

    protected $id;
    protected $nomeFormulario;
    protected $userId;
    protected $amarracao;
    protected $sdel;
    protected $createBy;
    protected $createIn;
    protected $updateBy;
    protected $updateIn;

    public function getId()
    {
        return $this->id;
    }

    public function getNomeFormulario()
    {
        return $this->nomeFormulario;
    }

    public function getUserId()
    {
        return $this->userId;
    }

    public function getAmarracao()
    {
        return $this->amarracao;
    }

    public function getSdel()
    {
        return $this->sdel;
    }

    public function getCreateBy()
    {
        return $this->createBy;
    }

    public function getCreateIn()
    {
        return $this->createIn;
    }

    public function getUpdateBy()
    {
        return $this->updateBy;
    }

    public function getUpdateIn()
    {
        return $this->updateIn;
    }

    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    public function setNomeFormulario($nomeFormulario)
    {
        $this->nomeFormulario = $nomeFormulario;
        return $this;
    }

    public function setUserId($userId)
    {
        $this->userId = $userId;
        return $this;
    }

    public function setAmarracao($amarracao)
    {
        $this->amarracao = $amarracao;
        return $this;
    }

    public function setSdel($sdel)
    {
        $this->sdel = $sdel;
        return $this;
    }

    public function setCreateBy($createBy)
    {
        $this->createBy = $createBy;
        return $this;
    }

    public function setCreateIn($createIn)
    {
        $this->createIn = $createIn;
        return $this;
    }

    public function setUpdateBy($updateBy)
    {
        $this->updateBy = $updateBy;
        return $this;
    }

    public function setUpdateIn($updateIn)
    {
        $this->updateIn = $updateIn;
        return $this;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {

        parent::initialize();

        $this->belongsTo('userId', 'App\Modules\Nucleo\Models\Users', 'id', ['alias' => 'Users']);
        $this->belongsTo('amarracao', 'App\Modules\Nucleo\Models\Protheus\CentroCustos', 'cttCusto', ['alias' => 'CentroCustos']);

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
    public function getSource()
    {
        return 'FRM_GESTAO_ACESSO';
    }

    /**
     * Independent Column Mapping.
     * Keys are the real names in the table and the values their names in the application
     *
     * @return array
     */
    public static function columnMap()
    {
        return [
            'ID_FRM_GESTAO_ACESSO' => 'id',
            'DS_NOME_FORMULARIO' => 'nomeFormulario',
            'CD_USUARIO' => 'userId',
            'CD_AMARRACAO' => 'amarracao',
            'SDEL' => 'sdel',
            'CREATEBY' => 'createBy',
            'CREATEIN' => 'createIn',
            'UPDATEBY' => 'updateBy',
            'UPDATEIN' => 'updateIn',
        ];
    }

    public static function getDeleted()
    {
        return 'sdel';
    }

    public function getCentroCustoByParent()
    {

        $connection = $this->customSimpleQuery('protheusDb');

        $query = "SELECT CTT.CODIGO,
                         CTT.DESCRICAO,
                         GA.*
                  FROM FRM_GESTAO_ACESSO GA
                  INNER JOIN (SELECT TRIM(CTT_CUSTO) CODIGO,
                                     TRIM(CTT_DESC01) DESCRICAO
                              FROM {$this->schema}.CTT010@PROTHEUSPROD
                              WHERE D_E_L_E_T_ = ' '
                                AND LENGTH(TRIM(CTT_CUSTO)) = 4
                                AND SUBSTR(TRIM(CTT_CUSTO), 1, 1) <> '1'
                                AND TRIM(CTT_XBLMOV) IS NULL
                              UNION ALL
                              SELECT TRIM(CTT_CUSTO),
                                     TRIM(CTT_DESC01)
                              FROM {$this->schema}.CTT010@PROTHEUSPROD
                              WHERE D_E_L_E_T_ = ' '
                                AND LENGTH(TRIM(CTT_CUSTO)) = 7
                                AND SUBSTR(TRIM(CTT_CUSTO), 1, 1) = '1'
                                AND TRIM(CTT_XBLMOV) IS NULL
                              ) CTT
                  ON CTT.CODIGO = GA.CD_AMARRACAO";

        return new ObjectPhalcon($connection->fetchAll($query, \Phalcon\Db::FETCH_ASSOC));
    }

}
