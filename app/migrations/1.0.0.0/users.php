<?php

/**
 * index.php
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       28/06/2015 05:23:30
 *
 */
use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Tools\Builder\Mvc\Model\Migration;

class UsersMigration_1000 extends Migration {

  public function up() {
    $this->morphTable(
            'users', array(
        'columns' => array(
            new Column('id', array(
                'type' => Column::TYPE_INTEGER,
                'unsigned' => true,
                'notNull' => true,
                'autoIncrement' => true,
                'size' => 11,
                'first' => true
                    )
            ),
            new Column('cpf', array(
                'type' => Column::TYPE_VARCHAR,
                'notNull' => true,
                'size' => 11,
                'after' => 'id'
                    )
            ),
            new Column('password', array(
                'type' => Column::TYPE_VARCHAR,
                'notNull' => true,
                'size' => 64,
                'after' => 'cpf'
                    )
            ),
            new Column('email', array(
                'type' => Column::TYPE_VARCHAR,
                'notNull' => true,
                'size' => 70,
                'after' => 'password'
                    )
            ),
            new Column('name', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 145,
                'after' => 'email'
                    )
            ),
            new Column('status', array(
                'type' => Column::TYPE_CHAR,
                'size' => 1,
                'after' => 'name'
                    )
            ),
            new Column('token', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 100,
                'after' => 'status'
                    )
            ),
            new Column('softdelete', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 1,
                'after' => 'token'
                    )
            ),
            new Column('usercreate', array(
                'type' => Column::TYPE_INTEGER,
                'unsigned' => true,
                'size' => 10,
                'after' => 'softdelete'
                    )
            ),
            new Column('datecreate', array(
                'type' => Column::TYPE_DATETIME,
                'size' => 1,
                'after' => 'usercreate'
                    )
            ),
            new Column('userupdate', array(
                'type' => Column::TYPE_INTEGER,
                'unsigned' => true,
                'size' => 10,
                'after' => 'datecreate'
                    )
            ),
            new Column('dateupdate', array(
                'type' => Column::TYPE_DATETIME,
                'size' => 1,
                'after' => 'userupdate'
                    )
            ),
            new Column('xxx', array(
                'type' => Column::TYPE_DATETIME,
                'size' => 1,
                'after' => 'dateupdate'
                    )
            )
        ),
        'indexes' => array(
            new Index('PRIMARY', array('id')),
            new Index('cpf_UNIQUE', array('cpf')),
            new Index('users_users1_idx', array('usercreate')),
            new Index('users_users2_idx', array('userupdate'))
        ),
        'references' => array(
            new Reference('users_users1', array(
                'referencedSchema' => 'intranet',
                'referencedTable' => 'users',
                'columns' => array('usercreate'),
                'referencedColumns' => array('id')
                    )),
            new Reference('users_users2', array(
                'referencedSchema' => 'intranet',
                'referencedTable' => 'users',
                'columns' => array('userupdate'),
                'referencedColumns' => array('id')
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
