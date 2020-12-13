<?php

echo "<pre>";

////////////////

$errorsActive = [
    E_ERROR             => true,
    E_WARNING           => true,
    E_PARSE             => true,
    E_NOTICE            => true,
    E_CORE_ERROR        => true,
    E_CORE_WARNING      => true,
    E_COMPILE_ERROR     => true,
    E_COMPILE_WARNING   => true,
    E_USER_ERROR        => true,
    E_USER_WARNING      => true,
    E_USER_NOTICE       => true,
    E_STRICT            => true,
    E_RECOVERABLE_ERROR => true,
    E_DEPRECATED        => true,
    E_USER_DEPRECATED   => true,
    E_ALL               => true,
];

error_reporting(
    array_sum(
        array_keys($errorsActive, $search = true)
    )
);

error_reporting(E_ALL);

/////////////
class WarningException extends ErrorException {}
class ParseException extends ErrorException {}
class NoticeException extends ErrorException {}
class CoreErrorException extends ErrorException {}
class CoreWarningException extends ErrorException {}
class CompileErrorException extends ErrorException {}
class CompileWarningException extends ErrorException {}
class UserErrorException extends ErrorException {}
class UserWarningException extends ErrorException {}
class UserNoticeException extends ErrorException {}
class StrictException extends ErrorException {}
class RecoverableErrorException extends ErrorException {}
class DeprecatedException extends ErrorException {}
class UserDeprecatedException extends ErrorException {}

function customErrorHandler($errno, $errstr, $errfile, $errline, $errcontext)
{
    if (0 === error_reporting()) { 
        return false;
    }

    switch($errno)
    {
        case E_ERROR: throw new ErrorException ($errstr, 0, $errno, $errfile, $errline);
        case E_WARNING: throw new WarningException ($errstr, 0, $errno, $errfile, $errline);
        case E_PARSE: throw new ParseException ($errstr, 0, $errno, $errfile, $errline);
        case E_NOTICE: throw new NoticeException ($errstr, 0, $errno, $errfile, $errline);
        case E_CORE_ERROR: throw new CoreErrorException ($errstr, 0, $errno, $errfile, $errline);
        case E_CORE_WARNING: throw new CoreWarningException ($errstr, 0, $errno, $errfile, $errline);
        case E_COMPILE_ERROR: throw new CompileErrorException ($errstr, 0, $errno, $errfile, $errline);
        case E_COMPILE_WARNING: throw new CoreWarningException ($errstr, 0, $errno, $errfile, $errline);
        case E_USER_ERROR: throw new UserErrorException ($errstr, 0, $errno, $errfile, $errline);
        case E_USER_WARNING: throw new UserWarningException ($errstr, 0, $errno, $errfile, $errline);
        case E_USER_NOTICE: throw new UserNoticeException ($errstr, 0, $errno, $errfile, $errline);
        case E_STRICT: throw new StrictException ($errstr, 0, $errno, $errfile, $errline);
        case E_RECOVERABLE_ERROR: throw new RecoverableErrorException ($errstr, 0, $errno, $errfile, $errline);
        case E_DEPRECATED: throw new DeprecatedException ($errstr, 0, $errno, $errfile, $errline);
        case E_USER_DEPRECATED: throw new UserDeprecatedException ($errstr, 0, $errno, $errfile, $errline);
    }
};

set_error_handler("customErrorHandler");

////////////////////////

function shutdown()
{
    echo 'Shutdown function', PHP_EOL;
}

register_shutdown_function('shutdown');

////////////////////////

try {
    throw new \Exception('message');
} catch (Exception $e) {
    print_r($e);
}

////////////////////////

ini_set('display_errors', '1');
include "file_with_errors.php";

echo 'Last command', PHP_EOL;
