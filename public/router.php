<?php
// Simple router for PHP's built-in server
$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);

// For static files, serve them directly
if (is_file(__DIR__ . $requestPath)) {
    return false;
}

// Otherwise, route to index.php
require_once __DIR__ . '/index.php';
