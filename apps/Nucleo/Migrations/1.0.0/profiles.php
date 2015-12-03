<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class ProfilesMigration_100
 */
class ProfilesMigration_100 extends Migration
{
    /**
     * Define the table structure
     *
     * @return void
     */
    public function morph()
    {
        $this->morphTable('profiles', array(
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
                        'user',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'id'
                        )
                    ),
                    new Column(
                        'group',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'size' => 11,
                            'after' => 'user'
                        )
                    ),
                    new Column(
                        'module',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'size' => 11,
                            'after' => 'group'
                        )
                    ),
                    new Column(
                        'controller',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'size' => 11,
                            'after' => 'module'
                        )
                    ),
                    new Column(
                        'action',
                        array(
                            'type' => Column::TYPE_INTEGER,
                            'notNull' => true,
                            'size' => 11,
                            'after' => 'controller'
                        )
                    ),
                    new Column(
                        'status',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'notNull' => true,
                            'size' => 1,
                            'after' => 'action'
                        )
                    ),
                    new Column(
                        'sdel',
                        array(
                            'type' => Column::TYPE_VARCHAR,
                            'size' => 1,
                            'after' => 'status'
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
                    new Index('profiles_users_idx', array('user')),
                    new Index('profiles_groups_idx', array('group')),
                    new Index('profiles_modules_idx', array('module')),
                    new Index('profiles_controller_idx', array('controller')),
                    new Index('profiles_actions_idx', array('action'))
                ),
                'references' => array(
                    new Reference(
                        'profiles_users',
                        array(
                            'referencedSchema' => 'nucleo',
                            'referencedTable' => 'users',
                            'columns' => array('user'),
                            'referencedColumns' => array('id')
                        )
                    ),
                    new Reference(
                        'profiles_groups',
                        array(
                            'referencedSchema' => 'nucleo',
                            'referencedTable' => 'groups',
                            'columns' => array('group'),
                            'referencedColumns' => array('id')
                        )
                    ),
                    new Reference(
                        'profiles_modules',
                        array(
                            'referencedSchema' => 'nucleo',
                            'referencedTable' => 'modules',
                            'columns' => array('module'),
                            'referencedColumns' => array('id')
                        )
                    ),
                    new Reference(
                        'profiles_controllers',
                        array(
                            'referencedSchema' => 'nucleo',
                            'referencedTable' => 'controllers',
                            'columns' => array('controller'),
                            'referencedColumns' => array('id')
                        )
                    ),
                    new Reference(
                        'profiles_actions',
                        array(
                            'referencedSchema' => 'nucleo',
                            'referencedTable' => 'actions',
                            'columns' => array('action'),
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
