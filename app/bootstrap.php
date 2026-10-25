<?php
// Shared setup for every page: config, error logging, session, database.

define('APP_ROOT', dirname(__DIR__));

$config = require APP_ROOT . '/config.php';

// Log every warning and deprecation to our own file; never show them to visitors.
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', APP_ROOT . '/logs/php-error.log');
error_reporting(E_ALL);

// Sessions live with the app, so a PHP version switch on the host does not log everyone out.
session_start([
    'save_path' => APP_ROOT . '/sessions',
    'gc_maxlifetime' => 604800,
    'cookie_httponly' => true,
    'cookie_samesite' => 'Lax',
]);

$db = new PDO(
    "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4",
    $config['db_user'],
    $config['db_pass'],
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
);

require APP_ROOT . '/app/helpers.php';
require APP_ROOT . '/app/auth.php';
require APP_ROOT . '/app/orders.php';
