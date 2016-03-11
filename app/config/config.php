<?php

return new \Phalcon\Config([
    'application' => [
        'pluginsDir' => APP_PATH . '/app/plugins/',
        'libraryDir' => APP_PATH . '/app/library/',
        'helpersDir' => APP_PATH . '/app/helpers/',
        'formsDir' => APP_PATH . '/app/forms/',
        'baseUri' => 'http://localhost/api-phalcon/',
        'timezone' => 'America/Sao_Paulo',
        'cryptSalt' => 'eEAfR|_&G&f,+vU]:jFr!!A&+71w1Ms9~8_4L!<@[N@DyaIP_2My|:+.u>/6m,$D',
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
        'file' => APP_PATH . '/logs/',
        'format' => '[%date%][%type%] %message%'
    ],
    'volt' => [
        'path' => APP_PATH . '/cache/volt/',
        'extension' => '.php',
        'separator' => '_',
        'stat' => true
    ],
    'pagination' => [
        'limiter' => 10,
        'options' => [10, 25, 50, 75, 100, 500],
        'perpage' => 5
    ]
        ]);
