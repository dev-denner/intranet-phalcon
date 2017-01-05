<?php

use Phalcon\Config;
use Phalcon\Logger;

return new Config([
    'application' => [
        'pluginsDir' => getenv('PLUGIN_DIR'),
        'libraryDir' => getenv('LIBRARY_DIR'),
        'helpersDir' => getenv('HELPERS_DIR'),
        'formsDir' => getenv('FORMS_DIR'),
        'viewsDir' => getenv('VIEWS_DIR'),
        'baseUri' => getenv('BASE_URI'),
        'timezone' => getenv('TIMEZONE'),
        'cryptSalt' => getenv('CRIPTSALT'),
        'environment' => getenv('ENVIRONMENT'),
    ],
    'model' => [
        'metadata' => [
            'on' => false,
            'adapter' => 'Files',
            'path' => APP_PATH . '/cache/metadata/'
        ],
    ],
    'cache' => [
        'cacheDir' => getenv('CACHE_DIR'),
        'lifetime' => getenv('CACHE_LIFETIME')
    ],
    'logger' => [
        'adapter' => 'File',
        'file' => APP_PATH . '/logs/',
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
        'fromName' => getenv('MAIL_FROM_NAME'),
        'fromEmail' => getenv('MAIL_FROM_EMAIL'),
        'smtp' => [
            'server' => getenv('MAIL_SMTP_SERVER'),
            'port' => getenv('MAIL_SMTP_POST'),
            'security' => getenv('MAIL_SMTP_SECURITY'),
            'username' => getenv('MAIL_SMTP_USER'),
            'password' => getenv('MAIL_SMTP_PASS')
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
