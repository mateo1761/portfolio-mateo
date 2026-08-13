<?php

return [
    'policy_version' => '1.2',
    'consent_hash_key' => env('CONTACT_CONSENT_HASH_KEY') ?: env('APP_KEY'),
];
