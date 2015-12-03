<?php

use Phalcon\Db\Column;
use Phalcon\Db\Index;
use Phalcon\Db\Reference;
use Phalcon\Mvc\Model\Migration;

/**
 * Class UsersMigration_100
 */
class UsersMigration_100 extends Migration {

  /**
   * Define the table structure
   *
   * @return void
   */
  public function morph() {
    $this->morphTable('users', array(
        'columns' => array(
            new Column(
                    'id', array(
                'type' => Column::TYPE_INTEGER,
                'notNull' => true,
                'size' => 11,
                'first' => true
                    )
            ),
            new Column(
                    'cpf', array(
                'type' => Column::TYPE_VARCHAR,
                'notNull' => true,
                'size' => 14,
                'after' => 'id'
                    )
            ),
            new Column(
                    'password', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 105,
                'after' => 'cpf'
                    )
            ),
            new Column(
                    'email', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 105,
                'after' => 'password'
                    )
            ),
            new Column(
                    'name', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 105,
                'after' => 'email'
                    )
            ),
            new Column(
                    'status', array(
                'type' => Column::TYPE_VARCHAR,
                'notNull' => true,
                'size' => 1,
                'after' => 'name'
                    )
            ),
            new Column(
                    'token', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 105,
                'after' => 'status'
                    )
            ),
            new Column(
                    'sdel', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 1,
                'after' => 'token'
                    )
            ),
            new Column(
                    'usercreate', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 45,
                'after' => 'sdel'
                    )
            ),
            new Column(
                    'datacreate', array(
                'type' => Column::TYPE_DATETIME,
                'size' => 1,
                'after' => 'usercreate'
                    )
            ),
            new Column(
                    'userupdate', array(
                'type' => Column::TYPE_VARCHAR,
                'size' => 45,
                'after' => 'datacreate'
                    )
            ),
            new Column(
                    'dataupdate', array(
                'type' => Column::TYPE_DATETIME,
                'size' => 1,
                'after' => 'userupdate'
                    )
            )
        ),
        'indexes' => array(
            new Index('PRIMARY', array('id')),
            new Index('cpf_UNIQUE', array('cpf'))
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
  public function up() {
    
  }

  /**
   * Reverse the migrations
   *
   * @return void
   */
  public function down() {
    
  }

}
