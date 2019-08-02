<?php
    return [
        'endpoint_url' => env('ZIPKIN_ENDPOINT_URL', 'http://localhost:9411/api/v2/spans'),
        'app_name' => env('ZIPKIN_APP_NAME', 'laravel-app'),
    ];