<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class FuncionariosMigration_1000
 */
class FuncionariosMigration_1000 extends Migration
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
                            'autoIncrement' => true,
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
                        'dataAdmissao',
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
                            'after' => 'dataAdmissao'
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
                        'centroCusto',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 9,
                            'after' => 'email'
                        )
                    ),
                    new Column(
                        'sdel',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 1,
                            'after' => 'centroCusto'
                        )
                    ),
                    new Column(
                        'createBy',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 45,
                            'after' => 'sdel'
                        )
                    ),
                    new Column(
                        'createIn',
                        array(
                            'type' => Column::TYPE_DATETIME,
                            'size' => 1,
                            'after' => 'createBy'
                        )
                    ),
                    new Column(
                        'updateBy',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 45,
                            'after' => 'createIn'
                        )
                    ),
                    new Column(
                        'updateIn',
                        array(
                            'type' => Column::TYPE_DATETIME,
                            'size' => 1,
                            'after' => 'updateBy'
                        )
                    )
                ),
                'indexes' => array(
                    new Index('PRIMARY', array('id'), null),
                    new Index('funcionarios_empresas_idx', array('empresa'), null)
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
                    'AUTO_INCREMENT' => '1',
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
