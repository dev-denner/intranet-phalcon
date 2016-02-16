<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class UsersGroupsMigration_1000
 */
class UsersGroupsMigration_1000 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('users_groups', array(
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
                        'userId',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'id'
                        )
                    ),
                    new Column(
                        'groupId',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'userId'
                        )
                    ),
                    new Column(
                        'sdel',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 1,
                            'after' => 'groupId'
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
                    new Index('users_groups_users_idx', array('userId'), null),
                    new Index('users_groups_goups_idx', array('groupId'), null)
                ),
                'references' => array(
                    new Reference(
                        'users_groups_goups',
                        array(
                            'referencedSchema' => 'nucleo',
                            'referencedTable' => 'groups',
                            'columns' => array('groupId'),
                            'referencedColumns' => array('id')
                        )
                    ),
                    new Reference(
                        'users_groups_users',
                        array(
                            'referencedSchema' => 'nucleo',
                            'referencedTable' => 'users',
                            'columns' => array('userId'),
                            'referencedColumns' => array('id')
                        )
                    )
                ),
                'options' => array(
                    'TABLE_TYPE' => 'BASE TABLE',
                    'AUTO_INCREMENT' => '2',
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
