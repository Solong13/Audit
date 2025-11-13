<?php
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
    $id_position = getPositionId($new_employee_data['current_position'], $dbh);
    unset($new_employee_data['current_position']);
    $new_employee_data = array_merge($new_employee_data, $id_position);

    $hash_password = password_hash($new_employee_data['password'], PASSWORD_DEFAULT);
    $new_employee_data['password'] = $hash_password;

    $res = logInEmployee($new_employee_data, $dbh);

    if (!$res) {
        try {
            createEmployee($new_employee_data, $dbh);
            $_SESSION['success'] = 'Успішна реєстрація!';
        } catch (PDOException $e) {
            //echo $e->getMessage();
            $_SESSION["error"] = "You have entered the wrong data!"; // потрібна обробка помилок зрозуміла для користувача
        }
    } else {
         $_SESSION["error"] = "This employee alrady exists!";
    }


}

header("Location: ?page=registration");
exit();
