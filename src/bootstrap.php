<?php

Use Core\Database;
ini_set('log_errors', 1);
ini_set('error_reporting', E_ALL);
ini_set('error_log', __DIR__ . '/../logs/php_errors.log');
ini_set('display_errors', 1);// Замінити на 0 при деплої
ini_set('display_startup_errors', 1);

require_once(__DIR__ . '/../helpers/helpers.php');
require_once __DIR__. '/../helpers/helpers.php';
require_once(__DIR__ . '/../config/config.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../');
$dotenv->load();

$pdo = new PDO("mysql:host={$_ENV['APP_HOST']};dbname={$_ENV['APP_DBNAME']}", "{$_ENV['APP_USER']}", "{$_ENV['APP_PASS']}",[
            \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION, 
            \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
            \PDO::ATTR_EMULATE_PREPARES => false
        ]);
        
$database = new Database($pdo);

$app = new Core\Application();
require_once(__DIR__ . '/../config/routers.php');