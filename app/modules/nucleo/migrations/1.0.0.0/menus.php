<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class MenusMigration_1000
 */
class MenusMigration_1000 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('menus', array(
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
                        'title',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 45,
                            'after' => 'id'
                        )
                    ),
                    new Column(
                        'slug',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 45,
                            'after' => 'title'
                        )
                    ),
                    new Column(
                        'parents',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'slug'
                        )
                    ),
                    new Column(
                        'action',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'size' => 11,
                            'after' => 'parents'
                        )
                    ),
                    new Column(
                        'sdel',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 1,
                            'after' => 'action'
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
                    new Index('menus_actions_idx', array('action'), null),
                    new Index('menus_menus_idx', array('parents'), null)
                ),
                'references' => array(
                    new Reference(
                        'menus_actions',
                        array(
                            'referencedSchema' => 'nucleo',
                            'referencedTable' => 'actions',
                            'columns' => array('action'),
                            'referencedColumns' => array('id')
                        )
                    ),
                    new Reference(
                        'menus_menus',
                        array(
                            'referencedSchema' => 'nucleo',
                            'referencedTable' => 'menus',
                            'columns' => array('parents'),
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
