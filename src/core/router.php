<?php
require_once __DIR__ . '/response.php';
require_once __DIR__ . '/../config/security.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$method = $_SERVER['REQUEST_METHOD'];

$routes = [
    'POST /leads' => ['LeadController', 'create'],
];

$key = $method . ' ' . $path;
if (!isset($routes[$key])) {
    json_error('Not Found', 404);
}

if (rate_limited($key)) {
    json_error('Too Many Requests', 429);
}

[$class, $func] = $routes[$key];
require_once __DIR__ . '/../controllers/' . $class . '.php';
call_user_func([$class, $func], $_REQUEST);
