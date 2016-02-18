<?php

return new \Phalcon\Config(array(
    'application' => array(
        'controllersDir' => APP_PATH . '/app/modules/cnab/controllers/',
        'modelsDir' => APP_PATH . '/app/modules/cnab/models/',
        'migrationsDir' => APP_PATH . '/app/modules/cnab/migrations/',
        'viewsDir' => APP_PATH . '/app/modules/cnab/views/',
        'formsDir' => APP_PATH . '/app/modules/cnab/forms/',
    ),
        ));
