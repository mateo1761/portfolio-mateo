<?php

return [
    'opportunistic_pruning' => env(
        'OPPORTUNISTIC_PRUNING_ENABLED',
        env('APP_ENV', 'production') === 'production',
    ),
];
