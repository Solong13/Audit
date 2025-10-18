<?php
session_start();

include_once ('helpers.php');               

$errors = [];
$success = false;

// Перевырка полів на заповненість
if (isset($_POST) && !empty($_POST)) {

    $new_user_data = clenFeilds($_POST);
    
    $valid_data_user = validFields($new_user_data);
    
    if ($valid_data_user !== null && !empty($valid_data_user)) {
        $_SESSION['errors'] = $valid_data_user;
        redirect('/public/index');
        exit;
    } else { 
        $success = true; 
    }
    
}

// Сам алгоритм реєстрації запису в файл!
if ($success && empty($errors)) {

     // - валідація даних
    $all_data_of_users = decoder(USERSDATA);// - повернення асоціативного масива
    simpleViewArray($all_data_of_users);         

    $ourUser = false;
    $idUser = null;
    foreach ($all_data_of_users as $key => $user) {
        $currentUser = '';
       var_dump($user);
        foreach ($user as $value) {
            if($user["table_number"] === $new_user_data["table_number"]) {
                print_r($user);
                $currentUser = $user;
                
                if($value == $new_user_data["fullname"]) {
                    $ourUser = $currentUser;
                    $idUser = $key;
                } else {
                     $errors["errors"] = 'Your fullname is incorrect! Please, try again.';
                }
                
            } else { 
                $errors["errors"] = 'You wrote the wrong full table_number!';
            }
        }

    }
}

//simpleViewArray($ourUser);   

if (isset($ourUser) && !empty($ourUser)) {
    $_SESSION['user'] = $ourUser;
    $_SESSION['user']['id'] = $idUser;
    redirect('/public/index');
    exit();
} else {
    $errors["errors"] = 'User doesn\'t found!';
    $_SESSION['errors'] = $errors;
    redirect('/public/index');
    exit();
}

