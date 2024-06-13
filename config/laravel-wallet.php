<?php

return [
    'users' => [
        'table' => 'users',

        'foreign_id' => 'user_id',
    ],

    'wallets' => [
        'table' => 'wallets',

        'foreign_id' => 'wallet_id',
    ],

    'wallet_logs' => [
        'table' => 'wallet_logs',
    ],
];
