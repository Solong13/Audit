<?php
session_start();
include_once ('config/connectionToDB.php');
include_once ('helpers.php');   
include_once ('helpers_for_DB.php');  

$new_employee_data = clenFeilds($_POST);
$valid_data_employee = validFields($_POST);

if (empty($valid_data_employee)) {
    $employee = logInEmployee($new_employee_data, $dbh);
    if ($employee) {
        if (password_verify($new_employee_data['password'], $employee['password'])) {
            $employee['password'] = $new_employee_data['password'];
            if(mb_strtolower($new_employee_data["fullname"]) == mb_strtolower($employee["fullname"])) {
                $_SESSION['employee'] = 
                [
                    "id_employee" => $employee["id_employee"],
                    "table_number" => $employee["table_number"],
                    "fullname" => $employee["fullname"],
                    "current_salary" => $employee["current_salary"],
                    "photo" => $employee["photo"],
                    "employee_role" => $employee["employee_role"]
                ];
            }
        } else {
            $_SESSION['error'] = 'Пароль неправильный.';
        }
    } else { 
        $_SESSION['error'] = 'Користувача не знайдено';
    }
} else {
    $_SESSION['error'] = 'Невірно заповнені поля';
}

redirect('/public/index');
exit();