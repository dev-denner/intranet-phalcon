<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       10/07/2015 16:15:44
 *
 */
use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Tools\Builder\Mvc\Model\Migration;

class UsersMigration_1001 extends Migration {

  public function up() {
    $this->morphTable(
            'users', array(
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
            new Column('CPF', array(
                'type' => Column::TYPE_VARCHAR,
                'notNull' => true,
                'size' => 11,
                'after' => 'ID'
                    )
            ),
            new Column('PASSWORD', array(
                'type' => Column::TYPE_VARCHAR,
                'notNull' => true,
                'size' => 64,
                'after' => 'CPF'
                    )
            ),
            new Column('EMAIL', array(
                'type' => Column::TYPE_VARCHAR,
                'notNull' => true,
                'size' => 70,
                'after' => 'PASSWORD'
                    )
            ),
            new Column('NAME', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 145,
                'after' => 'EMAIL'
                    )
            ),
            new Column('STATUS', array(
                'type' => Column::TYPE_CHAR,
                'size' => 1,
                'after' => 'NAME'
                    )
            ),
            new Column('TOKEN', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 100,
                'after' => 'STATUS'
                    )
            ),
            new Column('SOFTDEL', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 1,
                'after' => 'TOKEN'
                    )
            ),
            new Column('USERCREATE', array(
                'type' => Column::TYPE_INTEGER,
                'unsigned' => true,
                'size' => 10,
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
                'size' => 10,
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
            new Index('CPF_UNIQUE', array('CPF')),
            new Index('USERS_USERS1_IDX', array('USERCREATE')),
            new Index('USERS_USERS2_IDX', array('USERUPDATE'))
        ),
        'references' => array(
            new Reference('USERS_USERS1', array(
                'referencedSchema' => 'mpeapi',
                'referencedTable' => 'users',
                'columns' => array('USERCREATE'),
                'referencedColumns' => array('ID')
                    )),
            new Reference('USERS_USERS2', array(
                'referencedSchema' => 'mpeapi',
                'referencedTable' => 'users',
                'columns' => array('USERUPDATE'),
                'referencedColumns' => array('ID')
                    ))
        ),
        'options' => array(
            'TABLE_TYPE' => 'BASE TABLE',
            'AUTO_INCREMENT' => '6',
            'ENGINE' => 'InnoDB',
            'TABLE_COLLATION' => 'utf8_general_ci'
        )
            )
    );
  }

}
