<?php

return [

    /*
     * Расширение файла конфигурации app/config/filesystems.php
     * добавляет локальные диски для хранения изображений постов и пользователей
     */

    'contests' => [
        'driver' => 'local',
        'root' => storage_path('app/public/contests/'),
        'url' => env('APP_URL').'/storage/contests/',
        'visibility' => 'public',
    ],

];
