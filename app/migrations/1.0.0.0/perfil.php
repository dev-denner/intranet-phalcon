<?php

/**
 *
 * @author      Denner Fernandes <denners777@hotmail.com>
 * @since       30/06/2015 03:11:27
 *
 */
use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Tools\Builder\Mvc\Model\Migration;

class PerfilMigration_1000 extends Migration {

  public function up() {
    $this->morphTable(
            'perfil', array(
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
            new Column('description', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 20,
                'after' => 'id'
                    )
            ),
            new Column('status', array(
                'type' => Column::TYPE_VARCHAR,
                'notNull' => true,
                'size' => 1,
                'after' => 'description'
                    )
            ),
            new Column('softdelete', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 1,
                'after' => 'status'
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
            new Index('perfil_users1_idx', array('usercreate')),
            new Index('perfil_users2_idx', array('userupdate'))
        ),
        'references' => array(
            new Reference('perfil_users1', array(
                'referencedSchema' => 'intranet',
                'referencedTable' => 'users',
                'columns' => array('usercreate'),
                'referencedColumns' => array('id')
                    )),
            new Reference('perfil_users2', array(
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
