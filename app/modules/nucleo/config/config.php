<?php

return new \Phalcon\Config(array(
    'application' => array(
        'controllersDir' => APP_PATH . '/app/modules/nucleo/controllers/',
        'modelsDir' => APP_PATH . '/app/modules/nucleo/models/',
        'migrationsDir' => APP_PATH . '/app/modules/nucleo/migrations/',
        'viewsDir' => APP_PATH . '/app/modules/nucleo/views/',
        'formsDir' => APP_PATH . '/app/modules/nucleo/forms/',
    ),
        ));
