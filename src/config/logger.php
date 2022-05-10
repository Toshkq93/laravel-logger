<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Log Driver
    |--------------------------------------------------------------------------
    |
    | This determines how the logs are stored.
    | Currently supported drivers are 'db' and 'file'
    |
    */

    'driver' => env(
        'LOG_DRIVER',
        'file'
    ),


    /*
    |--------------------------------------------------------------------------
    | enable logging
    |--------------------------------------------------------------------------
    |
    | enable log all route.
    | 1 - true, 0 - false
    |
    */

    'enable' => env(
        'LOG',
        '1'
    ),

    /*
    |--------------------------------------------------------------------------
    | Route Prefix
    |--------------------------------------------------------------------------
    |
    | This prefix will be used when storing all data.
    |
    */

    'prefix' => env(
        'LOGGER_PREFIX',
        'logs'
    ),

    /*
    |--------------------------------------------------------------------------
    | Route Middleware
    |--------------------------------------------------------------------------
    |
    | These middleware will get attached onto each route, giving you
    | the chance to add your own middleware to this list or change any of
    | the existing middleware. Or, you can simply stick with this list.
    |
    */

    'middleware' => ['auth:api', 'can:view'],
];
