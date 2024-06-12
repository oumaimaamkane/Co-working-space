<?php

return [
    'paths' => ['api/*', 'sanctum/csrf-cookie'],
    'allowed_methods' => ['*'], // or specify the methods like ['GET', 'POST', 'PUT', 'DELETE']
    'allowed_origins' => ['*'], // or specify the origins like ['http://localhost:3000']
    'allowed_origins_patterns' => [],
    'allowed_headers' => ['*'], // or specify the headers like ['X-Requested-With', 'Content-Type', 'Authorization']
    'exposed_headers' => [],
    'max_age' => 0,
    'supports_credentials' => false, // set to true if you need to support credentials (cookies, authorization headers, etc.)
];

