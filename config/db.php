<?php

return [
    'class'    => 'yii\db\Connection',
//    'dsn'      => 'mysql:host=' . getenv('DB_HOST', 'localhost') . ';dbname=' . getenv('DB_DATABASE', 'yii2basic'),
    'dsn'      => 'mysql:host=localhost;dbname=bookstall',
    'username' => 'root', // getenv('DB_USERNAME', 'root'),
    'password' => '', // getenv('DB_PASSWORD', ''),
    'charset'  => 'utf8mb4', // getenv('DB_CHARSET', 'utf8'),

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
