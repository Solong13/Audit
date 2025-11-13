<?php

$config = require_once(__DIR__ . '/config/config.php');

try {
    $dbh = new PDO("mysql:host={$config['db_host']};dbname={$config['dbname']};", $config['db_user'], $config['db_password'], array(
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Встановлює режим вибірки даних на асоціативний масив
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" // Встановлює кодування символів на UTF-8
    ));
    return $dbh;
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

