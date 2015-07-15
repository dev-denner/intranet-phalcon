<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       30/06/2015 03:08:30
 *
 */
use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Tools\Builder\Mvc\Model\Migration;

class AppsMigration_1000 extends Migration {

  public function up() {
    $this->morphTable(
            'apps', array(
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
            new Column('controller', array(
                'type' => Column::TYPE_VARCHAR,
                'notNull' => true,
                'size' => 20,
                'after' => 'id'
                    )
            ),
            new Column('name', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 45,
                'after' => 'controller'
                    )
            ),
            new Column('module', array(
                'type' => Column::TYPE_INTEGER,
                'unsigned' => true,
                'notNull' => true,
                'size' => 11,
                'after' => 'name'
                    )
            ),
            new Column('softdelete', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 1,
                'after' => 'module'
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
                'size' => 6,
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
                'size' => 6,
                'after' => 'userupdate'
                    )
            )
        ),
        'indexes' => array(
            new Index('PRIMARY', array('id')),
            new Index('apps_modules', array('module')),
            new Index('apps_users1_idx', array('usercreate')),
            new Index('apps_users2_idx', array('userupdate'))
        ),
        'references' => array(
            new Reference('apps_modules', array(
                'referencedSchema' => 'intranet',
                'referencedTable' => 'modules',
                'columns' => array('module'),
                'referencedColumns' => array('id')
                    )),
            new Reference('apps_users1', array(
                'referencedSchema' => 'intranet',
                'referencedTable' => 'users',
                'columns' => array('usercreate'),
                'referencedColumns' => array('id')
                    )),
            new Reference('apps_users2', array(
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
