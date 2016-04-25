<?php

error_reporting(E_ALL);

define('APP_PATH', realpath('..'));

try {

    if (is_file(APP_PATH . '/vendor/autoload.php')) {
        require_once APP_PATH . '/vendor/autoload.php';
    }

    if (is_file(APP_PATH . '/app/library/WhoopsServiceProvider.php')) {
        require_once APP_PATH . '/app/library/WhoopsServiceProvider.php';
    }

    require_once APP_PATH . '/app/config/bootstrap.php';

    $di = new Phalcon\Di\FactoryDefault();

    new \Whoops\Provider\Phalcon\WhoopsServiceProvider($di);

    $app = new Bootstrap($di);

    echo $app->run(array());
} catch (\Phalcon\Exception $e) {
    echo dump($e->getMessage()) . '<br>';
    echo '<pre>' . $e->getTraceAsString() . '</pre>';
}

