<?php

/**
 * Description of ErrorPlugin
 *
 * @author DennerFernandes
 */

namespace System\Plugins;

use Phalcon\DI\FactoryDefault as Di;
use Phalcon\Mvc\User\Plugin as Plugin;

class Error extends Plugin {

    public static function normal($type, $message, $file, $line) {
        self::logError($type, $message, $file, $line);
    }

    public static function exception($exception) {
        self::logError('Exception', $exception->getMessage(), $exception->getFile(), $exception->getLine(), $exception->getTraceAsString());
    }

    public static function shutdown() {
        $error = error_get_last();
        if ($error) {
            self::logError($error['type'], $error['message'], $error['file'], $error['line']);
        } else {
            return true;
        }
    }

    protected static function logError($type, $message, $file, $line, $trace = '') {

        $di = Di::getDefault();

        $template = "[%s] %s (File: %s Line: [%s])";

        if ($trace) {
            $template . PHP_EOL . $trace;
        }

        $logMessage = sprintf($template, $type, $message, $file, $line);

        if ($di->has('logger')) {
            $logger = $di->get('logger');
            if ($logger) {
                $logger->error($logMessage);
            } else {
                throw new \Exception($logMessage);
            }
        } else {
            throw new \Exception($logMessage);
        }
    }

}
