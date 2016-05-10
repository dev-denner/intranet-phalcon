<?php

use Phalcon\Config;
use Phalcon\Logger;

return new Config([
    'application' => [
        'pluginsDir' => APP_PATH . '/app/plugins/',
        'libraryDir' => APP_PATH . '/app/library/',
        'helpersDir' => APP_PATH . '/app/helpers/',
        'formsDir' => APP_PATH . '/app/forms/',
        'viewsDir' => APP_PATH . '/app/shared/views',
        'baseUri' => 'http://localhost/',
        'timezone' => 'America/Sao_Paulo',
        'cryptSalt' => '8f6bf30e9688ff321db47803211756eb266df08f',
        'environment' => 'development',
    ],
    'model' => [
        'metadata' => [
            'on' => false,
            'adapter' => 'Files',
            'path' => APP_PATH . '/cache/metadata/'
        ],
    ],
    'cache' => [
        'cacheDir' => APP_PATH . '/cache/',
        'lifetime' => 86400
    ],
    'logger' => [
        'adapter' => 'File',
        'file' => APP_PATH . '/logs',
        'format' => '[%date%][%type%] %message%',
        'logLevel' => Logger::DEBUG,
    ],
    'volt' => [
        'path' => APP_PATH . '/cache/volt/',
        'extension' => '.php',
        'separator' => '_',
        'compileAlways' => true,
        'stat' => true
    ],
    'pagination' => [
        'limiter' => 10,
        'options' => [10, 25, 50, 75, 100, 500],
        'perpage' => 5
    ],
    'mail' => [
        'fromName' => 'Intranet – Grupo MPE',
        'fromEmail' => 'noreply@grupompe.com.br',
        'smtp' => [
            'server' => 'mpemta.grupompe.com.br',
            'port' => 587,
            'security' => '',
            'username' => 'gestaodepessoas',
            'password' => 'alterar1'
        ]
    ],
    'amazon' => [
        'AWSAccessKeyId' => '',
        'AWSSecretKey' => ''
    ],
    'access' => [
        'path' => APP_PATH . '/cache/access/'
    ],
        ]);
