<?php

$mpeTeste = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.1.8)(PORT = 1521))
    (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = MPETESTE)))';

$rm = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.1.8)(PORT = 1521))
    (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = ORAINST3)))';

$protheus = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.1.8)(PORT = 1521))
    (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = ORAINST1)))';

$mpeProd = '(DESCRIPTION = (ADDRESS = (PROTOCOL = TCP)(HOST = 192.168.1.8)(PORT = 1521))
    (CONNECT_DATA = (SERVER = DEDICATED) (SERVICE_NAME = MPEPROD)))';


return new \Phalcon\Config(array(
    'database' => array(
        'db' => array(
            'adapter' => 'Oracle',
            'host' => '192.168.1.8:1521/MPETESTE',
            'username' => 'NUCLEO',
            'password' => 'nucleo',
            'dbname' => $mpeTeste,
            'charset' => 'utf8',
            'schema' => 'NUCLEO',
        ),
        'rmDb' => array(
            'adapter' => 'Oracle',
            'host' => '192.168.1.8:1521:ORAINST3',
            'username' => 'RM',
            'password' => 'rm',
            'dbname' => $rm,
            'charset' => 'utf8',
            'schema' => 'RM',
        ),
        'protheusDb' => array(
            'adapter' => 'Oracle',
            'host' => '192.168.1.8:1521:ORAINST1',
            'username' => 'PROTHEUS',
            'password' => 'protheu',
            'dbname' => $protheus,
            'charset' => 'utf8',
            'schema' => 'PRODUCAO_9ZGXI5',
        ),
        'cnabDb' => array(
            'adapter' => 'Oracle',
            'host' => '192.168.1.8:1521:MPEPROD',
            'username' => 'CNAB',
            'password' => 'cnab',
            'dbname' => $mpeProd,
            'charset' => 'utf8',
            'schema' => 'CNAB',
        ),
        'otrsDb' => array(
            'adapter' => 'Mysql',
            'host' => '192.168.1.8',
            'username' => 'otrs',
            'password' => 'otrs',
            'dbname' => 'otrs',
            'charset' => 'utf8',
            'schema' => 'otrs',
        ),
        'telefoniaDb' => array(
            'adapter' => 'Oracle',
            'host' => '192.168.1.8:1521:MPEPROD',
            'username' => 'TELEFONIA',
            'password' => 'telefonia',
            'dbname' => $mpeProd,
            'charset' => 'utf8',
            'schema' => 'TELEFONIA',
        ),
        'helpersDb' => array(
            'adapter' => 'Mysql',
            'host' => 'localhost',
            'username' => 'root',
            'password' => 'root',
            'dbname' => 'intranet',
            'charset' => 'utf8',
            'schema' => 'intranet',
        ),
    )
        )
);
