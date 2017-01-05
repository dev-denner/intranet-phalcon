<?php

namespace Otrs\Models;

use SysPhalcon\Models\ModelBase;
use Phalcon\Config as ObjectPhalcon;

class Otrs extends ModelBase {

    public function initialize() {

        parent::initialize();
        $this->setConnectionService('otrsDb');
        $this->setReadConnectionService('otrsDb');
    }

    public function getFila() {
        $connection = $this->customConnection('otrsDb');
        $query = 'SELECT id, name FROM queue
                  WHERE name NOT LIKE "%::%"
                  AND group_id IN (9,15,19)
                  AND id <> 21';
        $result = $connection->select($query);
        $return = $connection->fetchAll($result);
        $connection->bye();

        return new ObjectPhalcon($return);
    }

    public function getResponsavel() {
        $connection = $this->customConnection('otrsDb');
        $query = 'SELECT us.id, us.first_name, us.last_name FROM users us
                  WHERE id IN (
                        SELECT DISTINCT ti.responsible_user_id
                        FROM ticket ti
                        WHERE ti.valid_id = 1
                   )';
        $result = $connection->select($query);
        $return = $connection->fetchAll($result);
        $connection->bye();

        return new ObjectPhalcon($return);
    }

}
