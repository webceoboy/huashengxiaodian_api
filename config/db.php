<?php

return [
    'class' => 'yii\db\Connection',
    'dsn' => sprintf('mysql:host=%s;dbname=%s', $_ENV['DB_HOST'], $_ENV['DB_NAME']),
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'charset' => 'utf8mb4',

    // Schema cache options (for production environment)
    'enableSchemaCache' => YII_ENV_PROD,
    'schemaCacheDuration' => 60,
    'schemaCache' => 'cache',
];
