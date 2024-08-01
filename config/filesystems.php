<?php

return [
    'default' => 'public',

    'disks' => [
        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],
        // Esta ruta es modificable en el .env dependiendo de la ruta donde tengas ubicado la carpeta "public" en "estadias-front". Ejemplo: 
            // FRONTEND_PUBLIC_PATH=C:\xampp\htdocs\estadias-front\public
        'frontend_public' => [
            'driver' => 'local',
            'root' => env('FRONTEND_PUBLIC_PATH', base_path('../estadias-front/public')), 
            'url' => env('FRONTEND_URL', env('APP_URL')) . '/storage',
            'visibility' => 'public',
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_ACCESS_KEY_ID'),
            'secret' => env('AWS_SECRET_ACCESS_KEY'),
            'region' => env('AWS_DEFAULT_REGION'),
            'bucket' => env('AWS_BUCKET'),
            'url' => env('AWS_URL'),
        ],
    ],
];