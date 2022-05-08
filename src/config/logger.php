<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Log Storage Driver
    |--------------------------------------------------------------------------
    */

    'driver' => env('LOG_DRIVER', 'file'),


    /*
    |--------------------------------------------------------------------------
    | enable logging
    |--------------------------------------------------------------------------
    */

    'enable' => env('LOG', '1'),
];