<?php

$isProduction = env('APP_ENV', 'production') === 'production';

return [
    'content_security_policy' => env('CONTENT_SECURITY_POLICY_ENABLED', $isProduction),
    'hsts' => env('HSTS_ENABLED', $isProduction),
];
