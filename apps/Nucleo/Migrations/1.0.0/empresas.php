<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class EmpresasMigration_100
 */
class EmpresasMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('empresas', array(
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
                        'codigo',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 3,
                            'after' => 'id'
                        )
                    ),
                    new Column(
                        'razaosocial',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 105,
                            'after' => 'codigo'
                        )
                    ),
                    new Column(
                        'nomefantasia',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 105,
                            'after' => 'razaosocial'
                        )
                    ),
                    new Column(
                        'codprotheus',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 20,
                            'after' => 'nomefantasia'
                        )
                    ),
                    new Column(
                        'lojaprotheus',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 5,
                            'after' => 'codprotheus'
                        )
                    ),
                    new Column(
                        'sdel',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 1,
                            'after' => 'lojaprotheus'
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
                    new Index('PRIMARY', array('id'))
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
