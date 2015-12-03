<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class FuncionariosMigration_100
 */
class FuncionariosMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('funcionarios', array(
                'columns' => array(
                    new Column(
                        'id',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'size' => 11,
                            'first' => true
                        )
                    ),
                    new Column(
                        'chapa',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 6,
                            'after' => 'id'
                        )
                    ),
                    new Column(
                        'nome',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 105,
                            'after' => 'chapa'
                        )
                    ),
                    new Column(
                        'cpf',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 14,
                            'after' => 'nome'
                        )
                    ),
                    new Column(
                        'empresa',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'cpf'
                        )
                    ),
                    new Column(
                        'situacao',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 50,
                            'after' => 'empresa'
                        )
                    ),
                    new Column(
                        'tipo',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 50,
                            'after' => 'situacao'
                        )
                    ),
                    new Column(
                        'dataadmissao',
                        array(
                            'type' => Column::TYPE_DATETIME,
                            'size' => 1,
                            'after' => 'tipo'
                        )
                    ),
                    new Column(
                        'cargo',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 80,
                            'after' => 'dataadmissao'
                        )
                    ),
                    new Column(
                        'email',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 120,
                            'after' => 'cargo'
                        )
                    ),
                    new Column(
                        'centrocusto',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 9,
                            'after' => 'email'
                        )
                    ),
                    new Column(
                        'banco',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'centrocusto'
                        )
                    ),
                    new Column(
                        'numagencia',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'banco'
                        )
                    ),
                    new Column(
                        'digagencia',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 1,
                            'after' => 'numagencia'
                        )
                    ),
                    new Column(
                        'numconta',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'digagencia'
                        )
                    ),
                    new Column(
                        'digconta',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 1,
                            'after' => 'numconta'
                        )
                    ),
                    new Column(
                        'periodopagto',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'digconta'
                        )
                    ),
                    new Column(
                        'sdel',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 1,
                            'after' => 'periodopagto'
                        )
                    ),
                    new Column(
                        'usercreate',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 45,
                            'after' => 'sdel'
                        )
                    ),
                    new Column(
                        'datacreate',
                        array(
                            'type' => Column::TYPE_DATETIME,
                            'size' => 1,
                            'after' => 'usercreate'
                        )
                    ),
                    new Column(
                        'userupdate',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 45,
                            'after' => 'datacreate'
                        )
                    ),
                    new Column(
                        'dataupdate',
                        array(
                            'type' => Column::TYPE_DATETIME,
                            'size' => 1,
                            'after' => 'userupdate'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('PRIMARY', array('id')),
                    new Index('funcionarios_empresas_idx', array('empresa'))
                ),
                'references' => array(
                    new Reference(
                        'funcionarios_empresas',
                        array(
                            'referencedSchema' => 'nucleo',
                            'referencedTable' => 'empresas',
                            'columns' => array('empresa'),
                            'referencedColumns' => array('id')
                        )
                    )
                ),
                'options' => array(
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '',
                    'ENGINE' => 'InnoDB',
                    'TABLE_COLLATION' => 'latin1_swedish_ci'
                ),
            )
        );
    }

    /**
     * Run the migrations
     *
     * @return void
     */
    public function up()
    {

    }

    /**
     * Reverse the migrations
     *
     * @return void
     */
    public function down()
    {

    }

}
