<?php

namespace App\Plugins;

use Phalcon\Db\Profiler;
use Phalcon\Logger;
use Phalcon\Mvc\User\Component;
use Phalcon\DI\FactoryDefault as Di;

class DbListener extends Component {

    protected $_profiler;
    protected $_logger;

    /**
     * Creates the profiler and starts the logging
     */
    public function __construct() {
        $this->_profiler = new Profiler();
        $di = Di::getDefault();
        if ($di->has('loggerDb')) {
            $this->_logger = $di->get('loggerDb');
        }
    }

    /**
     * This is executed if the event triggered is 'beforeQuery'
     */
    public function beforeQuery($event, $connection) {
        $this->_profiler->startProfile($connection->getSQLStatement());
    }

    /**
     * This is executed if the event triggered is 'afterQuery'
     */
    public function afterQuery($event, $connection) {
        $this->_logger->log($connection->getSQLStatement(), Logger::INFO);
        $this->_profiler->stopProfile();
    }

    public function getProfiler() {
        return $this->_profiler;
    }

}
