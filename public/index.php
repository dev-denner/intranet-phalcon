<?php

use Phalcon\Logger\Adapter\File as LoggerFile;

error_reporting(E_ALL);
define('APP_PATH', realpath('..'));
try {
    if (is_file(APP_PATH . '/vendor/autoload.php')) {
        require_once APP_PATH . '/vendor/autoload.php';
    }

    require_once APP_PATH . '/app/config/bootstrap.php';
    $di = new Phalcon\Di\FactoryDefault();
    $app = new Bootstrap($di);
    echo $app->run(array());
} catch (\Exception $e) {
    echo '<pre>';
    echo 'Ocorreu um erro inesperado! <br />';
    echo 'Por favor copie o código abaixo e envie ao <a href="mailto:suporte@grupomep.com.br" class="btn btn-link">suporte@grupompe.com.br</a> para solucionar o problema.<br />';
    echo get_class($e), ": ", $e->getMessage(), '<br />';
    echo "Arquivo = ", $e->getFile(), '<br />';
    echo "Linha = ", $e->getLine(), '<br />';
    echo $e->getTraceAsString(), '<br />';
    echo '</pre>';

    $logger = new LoggerFile(APP_PATH . '/logs/' . date('Y-m-d') . '.log');
    $logger->error($e->getMessage());
    Rollbar::report_exception($e);
} catch (\PDOException $e) {
    echo '<pre>';
    echo 'Ocorreu um erro inesperado! <br />';
    echo 'Por favor copie o código abaixo e envie ao <a href="mailto:suporte@grupomep.com.br" class="btn btn-link">suporte@grupompe.com.br</a> para solucionar o problema.<br />';
    echo '<br />';
    echo get_class($e), ": ", $e->getMessage(), '<br />';
    echo "Arquivo = ", $e->getFile(), '<br />';
    echo "Linha = ", $e->getLine(), '<br />';
    echo $e->getTraceAsString(), '<br />';
    echo '</pre>';

    $logger = new LoggerFile(APP_PATH . '/logs/' . date('Y-m-d') . '.log');
    $logger->error($e->getMessage());
    Rollbar::report_exception($e);
}

