<?php
  $db_host = getenv("MYSQL_HOST") ?? "localhost";
  $db_name = getenv("MYSQL_DATABASE") ?? "noladiy";
  $db_user = getenv('MYSQL_USER') ?? 'root';
  $db_pass = getenv('MYSQL_PASSWORD') ?? '';

return [
    'class' => 'yii\db\Connection',
    'dsn' => "mysql:host={$db_host};dbname={$db_name}",
    'username' => $db_user,
    'password' => $db_pass,
    'charset' => 'utf8',

    // Schema cache options (for production environment)
    //'enableSchemaCache' => true,
    //'schemaCacheDuration' => 60,
    //'schemaCache' => 'cache',
];
