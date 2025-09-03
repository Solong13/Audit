<?php
session_start();

include_once ('helpers.php');
simpleViewArray($_POST);
/*
-Перевірка щоб поля були не пусті, ++
-якщо пусті запис в масив помилок ++
-потім успішна реєстрація та запис даних в файл ++
-і повідомлення про успішну реєстрацію користувача ++
-І редірект ++
*/
$errors = [];
$success = false;

const USERSDATA = 'data/user_data.txt';

// Перевырка полів на заповненість
//simpleViewArray(auto_regist( $_POST));
if (isset($_POST) && !empty($_POST)) {

    $new_user_data = clenFeilds($_POST);
    
    $valid_data_user = validFields($new_user_data);
    //simpleViewArray($valid_data_user);
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
    
    if(checkUsers($new_user_data, $all_data_of_users)) {
        $all_data_of_users[] = $new_user_data; // -  дод даних вже до існуючого масива даних
        encoder($all_data_of_users);
        if (!empty($all_data_of_users)) {// - зберігання в json
            $_SESSION['success'] = 'Успішна реєстрація!';
        } else {
            $errors["errors"] = 'Не вдалось зберегти дані!';
        }
        
    } else {
        $errors["registered"] = 'Such a user already exists!';
    }

    //simpleViewArray($all_data_of_users);
    
} else {
    echo 'Something is wrong!';
}

$_SESSION['errors'] = $errors;
redirect('/public/index');
exit();