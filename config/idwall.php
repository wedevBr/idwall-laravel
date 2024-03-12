<?php

/*
 * You can place your custom package configuration in here.
 */
return [
    'api_v2_url' => env('IDWALL_V2_URL', 'https://api-v2.idwall.co'),
    'auth_v2_token' => env('IDWALL_V2_TOKEN'),
    'api_v3_url' => env('IDWALL_V3_URL'),
    'auth_v3_token' => env('IDWALL_V3_TOKEN', 'https://api-v3.idwall.co/maestro'),
];
