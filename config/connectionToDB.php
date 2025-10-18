<?php

// Підключення до бд. Фронт частина для введення даних, дод рядок часу в бд, і функції на крад бд, і запис значень в податки, та вивід значень кодів при вводі даних в таблицю

// Потрібно рухатися до підключення бд через точку входу, як одне єдине підключення, пізніше бутстрап


// class Database {
//     private $pdo;

//     public function __construct() 
//     {
//         $this->pdo = new PDO('mysql:host=localhost;dbname=Audit', 'root', '');
//     }      
 
//     public function getConnection() 
//     {
//         return $this->pdo;
//     }
// }

$db_host= 'localhost';
$dbname = 'Audit';
$db_user = 'root';
$db_password = '';

try {
    $dbh = new PDO("mysql:host=$db_host;dbname=$dbname;", $db_user, $db_password, array(
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Встановлює режим вибірки даних на асоціативний масив
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8" // Встановлює кодування символів на UTF-8
    ));
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage() . "<br/>";
    die();
}

// Пробний запис в бд
// $stmt = $dbh->prepare("INSERT INTO workers (fullname, table_number)
// VALUES (:fullname, :table_number)");

// $params = [
//     ':fullname'  => 'Іван Ігорович Малслюк',
//     ':table_number' => 1927,
// ];

// foreach ($params as $key => $value) {
//     $stmt->bindValue($key, $value);
// }
// $stmt->execute();


// var_dump($dbh);
