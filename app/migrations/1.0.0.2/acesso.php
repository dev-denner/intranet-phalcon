<?php 

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

class AcessoMigration_1002 extends Migration
{

    public function up()
    {
        $this->morphTable(
            'acesso',
            array(
            'columns' => array(
                new Column(
                    'ID',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'autoIncrement' => true,
                        'size' => 11,
                        'first' => true
                    )
                ),
                new Column(
                    'PERFIL',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'ID'
                    )
                ),
                new Column(
                    'ACTION',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'notNull' => true,
                        'size' => 11,
                        'after' => 'PERFIL'
                    )
                ),
                new Column(
                    'PERMISSION',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'notNull' => true,
                        'size' => 1,
                        'after' => 'ACTION'
                    )
                ),
                new Column(
                    'SOFTDEL',
                    array(
                        'type' => Column::TYPE_VARCHAR,
                        'size' => 1,
                        'after' => 'PERMISSION'
                    )
                ),
                new Column(
                    'USERCREATE',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'size' => 11,
                        'after' => 'SOFTDEL'
                    )
                ),
                new Column(
                    'DATECREATE',
                    array(
                        'type' => Column::TYPE_DATETIME,
                        'size' => 1,
                        'after' => 'USERCREATE'
                    )
                ),
                new Column(
                    'USERUPDATE',
                    array(
                        'type' => Column::TYPE_INTEGER,
                        'unsigned' => true,
                        'size' => 11,
                        'after' => 'DATECREATE'
                    )
                ),
                new Column(
                    'DATEUPDATE',
                    array(
                        'type' => Column::TYPE_DATETIME,
                        'size' => 1,
                        'after' => 'USERUPDATE'
                    )
                )
            ),
            'indexes' => array(
                new Index('PRIMARY', array('ID')),
                new Index('ACESSO_PERFIL_IDX', array('PERFIL')),
                new Index('ACESSO_ACTIONS_IDX', array('ACTION')),
                new Index('ACESSO_USERS1_IDX', array('USERCREATE')),
                new Index('ACESSO_USERS2_IDX', array('USERUPDATE'))
            ),
            'references' => array(
                new Reference('ACESSO_ACTIONS', array(
                    'referencedSchema' => 'mpeapi',
                    'referencedTable' => 'actions',
                    'columns' => array('ACTION'),
                    'referencedColumns' => array('id')
                )),
                new Reference('ACESSO_PERFIL', array(
                    'referencedSchema' => 'mpeapi',
                    'referencedTable' => 'perfil',
                    'columns' => array('PERFIL'),
                    'referencedColumns' => array('ID')
                )),
                new Reference('ACESSO_USERS1', array(
                    'referencedSchema' => 'mpeapi',
                    'referencedTable' => 'users',
                    'columns' => array('USERCREATE'),
                    'referencedColumns' => array('ID')
                )),
                new Reference('ACESSO_USERS2', array(
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
