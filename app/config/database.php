<?php

return new \Phalcon\Config(array(
    'database' => array(
        'db' => array(
            'adapter' => 'Oracle',
            'host' => '192.168.1.8:1521/XE',
            'username' => 'NUCLEO',
            'password' => 'nucleo',
            'dbname' => '192.168.1.8:1521/XE',
            'charset' => 'utf8',
            'schema' => 'NUCLEO',
        ),
    )
  )
);
