<?php

/**
 * Register application modules
 */
$application->registerModules(array(
    'tools' => array(
        'className' => 'Tools\Module',
        'path' => __DIR__ . '/../apps/Tools/Module.php'
    ),
    'nucleo' => array(
        'className' => 'Nucleo\Module',
        'path' => __DIR__ . '/../apps/Nucleo/Module.php'
    ),
));

