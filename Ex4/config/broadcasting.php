<?php

return [
    'default' => env('BROADCAST_DRIVER', 'null'),

    'connections' => [
        'pusher' => [
            'driver' => 'pusher',
            'key' => env('1b2b74186fa29af2e797'),
            'secret' => env('546bcbe8844c7e55fef7'),
            'app_id' => env('1964227'),
            'options' => [
                'cluster' => env('eu'),
                'host' => env('PUSHER_HOST', '127.0.0.1'),
                'port' => env('PUSHER_PORT', 6001),
                'scheme' => env('PUSHER_SCHEME', 'http'),
                'encrypted' => false,
                'useTLS' => env('true') === 'https',
            ],
        ],

        // ... autres configurations
    ],
];