<?php

return [
    /*
    |--------------------------------------------------------------------------
    | LogViewer route
    | Address to access: 'example.com/logs'
    |--------------------------------------------------------------------------
    */
    'route' => 'logs',

    /*
    |--------------------------------------------------------------------------
    | Middleware's that must be applied along the route.
    |--------------------------------------------------------------------------
    */
    // 'middleware' => ['auth'],
    'middleware' => [],

    /*
    |--------------------------------------------------------------------------
    | Number of pagination per page,
    | The default number of pagination per page is 15.
    |--------------------------------------------------------------------------
    */
    'per_page' => 10,

    /*
    |--------------------------------------------------------------------------
    | The absolute path of the logs is located.
    |--------------------------------------------------------------------------
    */
    'logs_path' => env('LOGVIEWER_LOGS_PATH', storage_path('logs/')),

    /*
    |--------------------------------------------------------------------------
    | Default log file to view at dashboard.
    |--------------------------------------------------------------------------
    */
    'default_log' => 'laravel.log'
];
