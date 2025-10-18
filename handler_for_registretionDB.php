<?php
session_start();

include_once ('config/connectionToDB.php');
include_once ('helpers.php');
include_once ('helpers_for_DB.php');
simpleViewArray($_POST);

$errors = [];
$success = false;

// Перевырка полів на заповненість
if (!empty($_POST)) {

    $new_employee_data = clenFeilds($_POST);
    $valid_data_user = validFields($new_employee_data);
    
    if (!empty($valid_data_user)) {
        $_SESSION['error'] = $valid_data_user;
    } else { 
        $success = true; 
    }
}

if ($success) {
    $hashPassword = password_hash($new_employee_data['password'], PASSWORD_DEFAULT);
    $new_employee_data['password'] = $hashPassword;
    
    try {
        var_dump(createEmployee($new_employee_data, $dbh));
        $_SESSION['success'] = 'Успішна реєстрація!';
     
    } catch (PDOException $e) {
        // $errors["errors"] = $e->getMessage();
        $errors["errors="] = "You have entered the wrong data!"; // потрібна обробка помилок зрозуміла для користувача
    }
}

redirect('/public/index');
exit;