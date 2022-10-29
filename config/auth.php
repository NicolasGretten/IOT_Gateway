<?php

return [
    'defaults' => [
        'guard' => 'account',
        'passwords' => 'account',
    ],

    'guards' => [
        'account' => [
            'driver' => 'jwt',
            'provider' => 'account',
        ]
    ],

    'providers' => [
        'account' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Account::class
        ]
    ],
];
