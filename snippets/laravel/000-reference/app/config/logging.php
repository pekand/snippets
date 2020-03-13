<?php

use Monolog\Handler\NullHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Handler\SyslogUdpHandler;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Log Channel
    |--------------------------------------------------------------------------
    |
    | This option defines the default log channel that gets used when writing
    | messages to the logs. The name specified in this option should match
    | one of the channels defined in the "channels" configuration array.
    |
    */

    'default' => env('LOG_CHANNEL', 'stack'),

    /*
    |--------------------------------------------------------------------------
    | Log Channels
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log channels for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Drivers: "single", "daily", "slack", "syslog",
    |                    "errorlog", "monolog",
    |                    "custom", "stack"
    |
    */

    'channels' => [
        'stack' => [
            'driver' => 'stack',
            'channels' => [
                'single', //default logger
                'custom',
            ],
            'ignore_exceptions' => false,
        ],

        'single' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
        ],

        'daily' => [
            'driver' => 'daily',
            'path' => storage_path('logs/laravel.log'),
            'level' => 'debug',
            'days' => 14,
        ],

        'slack' => [
            'driver' => 'slack',
            'url' => env('LOG_SLACK_WEBHOOK_URL'),
            'username' => 'Laravel Log',
            'emoji' => ':boom:',
            'level' => 'critical',
        ],

        'papertrail' => [
            'driver' => 'monolog',
            'level' => 'debug',
            'handler' => SyslogUdpHandler::class,
            'handler_with' => [
                'host' => env('PAPERTRAIL_URL'),
                'port' => env('PAPERTRAIL_PORT'),
            ],
        ],

        'stderr' => [
            'driver' => 'monolog',
            'handler' => StreamHandler::class,
            'formatter' => env('LOG_STDERR_FORMATTER'),
            'with' => [
                'stream' => 'php://stderr',
            ],
        ],

        'syslog' => [
            'driver' => 'syslog',
            'level' => 'debug',
        ],

        'errorlog' => [
            'driver' => 'errorlog',
            'level' => 'debug',
        ],

        'null' => [
            'driver' => 'monolog',
            'handler' => NullHandler::class,
        ],

        'emergency' => [
            'path' => storage_path('logs/laravel.log'),
        ],

        'query' => [
            'driver' => 'single',
            'path' => storage_path('logs/laravel.access.log'),
            'level' => 'debug',
        ],

        'access' => [ // bind in LogMiddleware
            'driver' => 'single',
            'path' => storage_path('logs/laravel.access.log'),
            'level' => 'debug',
        ],

        'session' => [ // bind in LogMiddleware
            'driver' => 'single',
            'path' => storage_path('logs/laravel.session.log'),
            'level' => 'debug',
        ],

        'query' => [ // bind in QueryServiceProvider
            'driver' => 'single',
            'path' => storage_path('logs/laravel.query.log'),
            'level' => 'debug',
        ],

        'events' => [ // bind in EventServiceProvider
            'driver' => 'single',
            'path' => storage_path('logs/laravel.events.log'),
            'level' => 'debug',
        ],

        'cache' => [ // bind in EventServiceProvider
            'driver' => 'single',
            'path' => storage_path('logs/laravel.cache.log'),
            'level' => 'debug',
        ],
        'custom' => [
            'driver' => 'custom',
            'via' => App\Lib\Logging\CreateCustomLogger::class,
            'tap' => [\App\Lib\Logging\CustomizeFormatter::class], // custom log formatter
            'emoji'    => ':gear:',
            'path' => storage_path('logs/laravel.custom.log'),
            'level' => 'debug',
            'bubble' => true, // bubble to other chanels 
            'permission' => '0644',
            'locking' => 'true', // lock file
        ],
    ],

];
