<?php

return [
    'key' => env('ZOOM_CLIENT_KEY'),
    'secret' => env('ZOOM_CLIENT_SECRET'),
    'baseUrl' => 'https://api.zoom.us/v2/',
    'authentication_method' => 'Server-to-Server OAuth',
    'max_api_calls_per_request' => '5'
];
