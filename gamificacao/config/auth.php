<?php
return [
    'defaults' => [
        'guard' => 'web',
        'passwords' => 'alunos',
    ],

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'alunos',
        ],
        'instrutor' => [
            'driver' => 'session',
            'provider' => 'instrutors',
        ],
    ],

    'providers' => [
        'alunos' => [
            'driver' => 'eloquent',
            'model' => App\Models\Aluno::class,
        ],
        'instrutors' => [
            'driver' => 'eloquent',
            'model' => App\Models\Instrutor::class,
        ],
    ],

    'passwords' => [
        'alunos' => [
            'provider' => 'alunos',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => 10800,
];