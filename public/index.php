<?php

error_reporting(E_ALL);

define('APP_PATH', realpath('..'));

try {

  if (is_file(APP_PATH . '/vendor/autoload.php')) {
    require_once APP_PATH . '/vendor/autoload.php';
  }

  require_once APP_PATH . '/config/Bootstrap.php';

  $di = new Phalcon\Di\FactoryDefault();
  $app = new Bootstrap($di);

  echo $app->run(array());
} catch (Phalcon\Exception $e) {
  echo $e->getMessage(), $e->getFile(), $e->getLine(), $e->getCode();
  echo nl2br(htmlentities($e->getTraceAsString()));
  echo ErrorPlugin::exception($e);
} catch (PDOException $e) {
  echo $e->getMessage() . PHP_EOL . $e->getFile() . PHP_EOL . $e->getLine() . PHP_EOL . $e->getCode();
}

