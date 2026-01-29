<?php
// Наш фронт контроллер
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once(__DIR__ . '/../config/config.php');// константи шляхів
require ROOT . '/vendor/autoload.php'; 
require_once(HELPERS . '/helpers.php');
require_once(__DIR__ . '/../src/bootstrap.php');

$app = new Core\Application();
require_once(__DIR__ . '/../config/routers.php');// константи шляхів
$app->router->resolve();