<?php

namespace App\Modules\Nucleo\Models\Mysql;

use App\Shared\Models\ModelBase;

/**
 *
 */
class LogForms extends ModelBase {

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var string
     */
    public $sequenceKey;

    /**
     *
     * @var string
     */
    public $usersName;

    /**
     *
     * @var string
     */
    public $formName;

    /**
     *
     * @var string
     */
    public $identKey;

    /**
     *
     * @var datetime
     */
    public $createdAt;

    /**
     *
     */
    public function beforeValidationOnCreate() {

        $this->createdAt = date('Y-m-d H:i:s');
        $this->sequenceKey = $this->getSequenceKey();
    }

    /**
     *
     */
    public function initialize() {
        parent::initialize();
        $this->setConnectionService('helpersDb');
    }

    public function getSequenceKey() {

        $connection = $this->customSimpleQuery('helpersDb');
        $query = "SHOW TABLE STATUS LIKE 'log_forms'";
        $ai = $connection->fetchOne($query, \Phalcon\Db::FETCH_ASSOC);
        return date('Ymd') . str_pad($ai['Auto_increment'], 10, 0, STR_PAD_LEFT);
    }

}
