<?php

return [
    'channels' => [
        'access' => [ // bind in LogMiddleware
            'driver' => 'single',
            'path' => storage_path('logs/detaillog.access.log'),
            'level' => 'debug',
        ],
        'cache' => [ // bind in EventServiceProvider
            'driver' => 'single',
            'path' => storage_path('logs/detaillog.cache.log'),
            'level' => 'debug',
        ],
        'events' => [ // bind in EventServiceProvider
            'driver' => 'single',
            'path' => storage_path('logs/detaillog.events.log'),
            'level' => 'debug',
        ],
        'query' => [ // bind in QueryServiceProvider
            'driver' => 'single',
            'path' => storage_path('logs/detaillog.query.log'),
            'level' => 'debug',
        ],
        'session' => [ // bind in LogMiddleware
            'driver' => 'single',
            'path' => storage_path('logs/detaillog.session.log'),
            'level' => 'debug',
        ],
    ],
];
