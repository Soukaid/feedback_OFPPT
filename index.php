<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Get the requested path
$request = $_SERVER['REQUEST_URI'];

// Basic routing
switch ($request) {
    case '/':
        require __DIR__ . '/index.html';
        break;
    case '/feedback':
        require __DIR__ . '/formulaire de feedback.html';
        break;
    case '/connexion':
        require __DIR__ . '/connexion.html';
        break;
    case '/dashboard':
        require __DIR__ . '/dashboard.php';
        break;
    default:
        http_response_code(404);
        require __DIR__ . '/index.html';
        break;
}
?>