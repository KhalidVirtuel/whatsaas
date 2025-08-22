<?php
function db() {
    static $pdo = null;
    if ($pdo === null) {
        $env = require __DIR__ . '/env.php';
        $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s;charset=utf8mb4',
            $env['DB_HOST'], $env['DB_PORT'], $env['DB_NAME']);
        $options = [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ];
        $pdo = new PDO($dsn, $env['DB_USER'], $env['DB_PASS'], $options);
    }
    return $pdo;
}
