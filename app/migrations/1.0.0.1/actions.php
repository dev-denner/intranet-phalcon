<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       10/07/2015 16:15:31
 *
 */
use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Tools\Builder\Mvc\Model\Migration;

class ActionsMigration_1001 extends Migration {

  public function up() {
    $this->morphTable(
            'actions', array(
        'columns' => array(
            new Column('ID', array(
                'type' => Column::TYPE_INTEGER,
                'unsigned' => true,
                'notNull' => true,
                'autoIncrement' => true,
                'size' => 11,
                'first' => true
                    )
            ),
            new Column('NAME', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 35,
                'after' => 'ID'
                    )
            ),
            new Column('SLUG', array(
                'type' => Column::TYPE_VARCHAR,
                'notNull' => true,
                'size' => 35,
                'after' => 'NAME'
                    )
            ),
            new Column('APP', array(
                'type' => Column::TYPE_INTEGER,
                'unsigned' => true,
                'notNull' => true,
                'size' => 11,
                'after' => 'SLUG'
                    )
            ),
            new Column('SOFTDEL', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 1,
                'after' => 'APP'
                    )
            ),
            new Column('USERCREATE', array(
                'type' => Column::TYPE_INTEGER,
                'unsigned' => true,
                'size' => 11,
                'after' => 'SOFTDEL'
                    )
            ),
            new Column('DATECREATE', array(
                'type' => Column::TYPE_DATETIME,
                'size' => 1,
                'after' => 'USERCREATE'
                    )
            ),
            new Column('USERUPDATE', array(
                'type' => Column::TYPE_INTEGER,
                'unsigned' => true,
                'size' => 11,
                'after' => 'DATECREATE'
                    )
            ),
            new Column('DATEUPDATE', array(
                'type' => Column::TYPE_DATETIME,
                'size' => 1,
                'after' => 'USERUPDATE'
                    )
            )
        ),
        'indexes' => array(
            new Index('PRIMARY', array('ID')),
            new Index('ACTIONS_APPS_IDX', array('APP')),
            new Index('ACTIONS_USERS1_IDX', array('USERCREATE')),
            new Index('ACTIONS_USERS2_IDX', array('USERUPDATE'))
        ),
        'references' => array(
            new Reference('ACTIONS_APPS', array(
                'referencedSchema' => 'mpeapi',
                'referencedTable' => 'apps',
                'columns' => array('APP'),
                'referencedColumns' => array('ID')
                    )),
            new Reference('ACTIONS_USERS1', array(
                'referencedSchema' => 'mpeapi',
                'referencedTable' => 'users',
                'columns' => array('USERCREATE'),
                'referencedColumns' => array('ID')
                    )),
            new Reference('ACTIONS_USERS2', array(
                'referencedSchema' => 'mpeapi',
                'referencedTable' => 'users',
                'columns' => array('USERUPDATE'),
                'referencedColumns' => array('ID')
                    ))
        ),
        'options' => array(
            'TABLE_TYPE' => 'BASE TABLE',
            'AUTO_INCREMENT' => '1',
            'ENGINE' => 'InnoDB',
            'TABLE_COLLATION' => 'utf8_general_ci'
        )
            )
    );
  }

}
