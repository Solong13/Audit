<?php  

$new_employee_data = clenFeilds($_POST);
$valid_data_employee = validFields($_POST);// повертає масив помилок

if (empty($valid_data_employee)) { // якщо масив помилок пустий
    $employee = logInEmployee($new_employee_data, $dbh);
    if ($employee) {
        if (password_verify($new_employee_data['password'], $employee['password'])) {
            if(mb_strtolower($new_employee_data["fullname"]) == mb_strtolower($employee["fullname"])) {
                $_SESSION['employee'] = 
                [
                    "id_employee" => $employee["id_employee"],
                    "table_number" => $employee["table_number"],
                    "fullname" => $employee["fullname"],
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

if (isset($_SESSION['error'])) {
    header("Location: ?page=login");
    exit();
} else {
    header("Location: ?page=portfolio");
    exit();
}
