<?php

error_reporting(E_ALL);

define('APP_PATH', realpath('..'));

try {

  require_once APP_PATH . '/app/config/Bootstrap.php';
  require_once APP_PATH . '/app/plugins/ErrorPlugin.php';

  $di = new \Phalcon\DI\FactoryDefault();
  $app = new Bootstrap($di);

  echo $app->run(array());
} catch (\Phalcon\Exception $e) {
  echo $e->getMessage();
  Error::exception($e);
}