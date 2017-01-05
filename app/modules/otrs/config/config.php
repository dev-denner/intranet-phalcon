<?php

return new \Phalcon\Config([
    'application' => [
        'controllersDir' => APP_PATH . '/app/modules/otrs/controllers/',
        'modelsDir' => APP_PATH . '/app/modules/otrs/models/',
        'migrationsDir' => APP_PATH . '/app/modules/otrs/migrations/',
        'formsDir' => APP_PATH . '/app/modules/otrs/forms/',
    ],
        ]);
