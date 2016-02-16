<?php

return new \Phalcon\Config(array(
    'application' => array(
        'pluginsDir' => APP_PATH . '/app/plugins/',
        'libraryDir' => APP_PATH . '/app/library/',
        'helpersDir' => APP_PATH . '/app/helpers/',
        'formsDir' => APP_PATH . '/app/forms/',
        'baseUri' => 'http://localhost/api-phalcon/',
        'timezone' => 'America/Sao_Paulo',
        'cryptSalt' => 'eEAfR|_&G&f,+vU]:jFr!!A&+71w1Ms9~8_4L',
        'environment' => 'development',
    ),
    'model' => array(
        'metadata' => array(
            'on' => false,
            'adapter' => 'Files',
            'path' => APP_PATH . '/cache/metadata/'
        ),
    ),
    'cache' => array(
        'cacheDir' => APP_PATH . '/cache/',
        'lifetime' => 86400
    ),
    'logger' => array(
        'adapter' => 'File',
        'file' => APP_PATH . '/logs/',
        'format' => '[%date%][%type%] %message%'
    ),
    'volt' => array(
        'path' => APP_PATH . '/cache/volt/',
        'extension' => '.php',
        'separator' => '_',
        'stat' => true
    ),
        ));
