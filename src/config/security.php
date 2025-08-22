<?php
session_start();

function csrf_set_cookie() {
    if (empty($_COOKIE['XSRF-TOKEN'])) {
        $token = bin2hex(random_bytes(16));
        setcookie('XSRF-TOKEN', $token, ['path' => '/', 'samesite' => 'Strict']);
        $_SESSION['csrf'] = $token;
    }
}

function csrf_validate($token) {
    return isset($_SESSION['csrf'], $_COOKIE['XSRF-TOKEN']) &&
        hash_equals($_SESSION['csrf'], $_COOKIE['XSRF-TOKEN']) &&
        hash_equals($_SESSION['csrf'], $token);
}

function rate_limited($key, $limit = 10, $window = 60) {
    $now = time();
    if (!isset($_SESSION['rate'][$key])) {
        $_SESSION['rate'][$key] = [];
    }
    $_SESSION['rate'][$key] = array_filter(
        $_SESSION['rate'][$key],
        fn($ts) => $ts > $now - $window
    );
    if (count($_SESSION['rate'][$key]) >= $limit) {
        return true;
    }
    $_SESSION['rate'][$key][] = $now;
    return false;
}
