<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       30/06/2015 03:06:41
 *
 */
use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Tools\Builder\Mvc\Model\Migration;

class ModulesMigration_1000 extends Migration {

  public function up() {
    $this->morphTable(
            'modules', array(
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
            new Column('name', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 45,
                'after' => 'id'
                    )
            ),
            new Column('softdelete', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 1,
                'after' => 'name'
                    )
            ),
            new Column('usercreate', array(
                'type' => Column::TYPE_INTEGER,
                'unsigned' => true,
                'size' => 11,
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
                'size' => 11,
                'after' => 'datecreate'
                    )
            ),
            new Column('dateupdate', array(
                'type' => Column::TYPE_DATETIME,
                'size' => 1,
                'after' => 'userupdate'
                    )
            )
        ),
        'indexes' => array(
            new Index('PRIMARY', array('id')),
            new Index('modules_users1_idx', array('usercreate')),
            new Index('modules_users2_idx', array('userupdate'))
        ),
        'references' => array(
            new Reference('modules_users1', array(
                'referencedSchema' => 'intranet',
                'referencedTable' => 'users',
                'columns' => array('usercreate'),
                'referencedColumns' => array('id')
                    )),
            new Reference('modules_users2', array(
                'referencedSchema' => 'intranet',
                'referencedTable' => 'users',
                'columns' => array('userupdate'),
                'referencedColumns' => array('id')
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
