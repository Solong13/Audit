<?php
session_start();

include_once ('helpers.php');

/*
-Перевірка щоб поля були не пусті, ++
-якщо пусті запис в масив помилок ++
-потім успішна реєстрація та запис даних в файл ++
-і повідомлення про успішну реєстрацію користувача +-
-І редірект ++
*/
$errors = [];
$success = false;

const USERSDATA = 'users/user_data.txt';

// Перевырка полів на заповненість
if (isset($_POST)) {
    if (!empty($_POST["fullname"])) {
        if (!empty($_POST["current_position"])) {
            if (!empty($_POST["workshop"])) {
                if (!empty($_POST["table_number"])) {
                    if (!empty($_POST["current_salary"])) {
                        $success = true; 
                       
                    } else {
                        $errors["current_salary"] = "Введіть свій оклад";
                    }
                } else {
                    $errors["table_number"] = "Введіть свій табельний номер";
                }
            } else {
                $errors["workshop"] = "Оберіть місце роботи";
            }
        } else {
            $errors["current_position"]= "Оберіть актуальну посаду";
        }
    } else {
        $errors["fullname"] = "Заповніть Вашe ПІП";
    }
} else {
    $errors["main"] = "Заповніть поля!";
}

// Сам алгоритм реєстрації запису в файл!
if ($success && empty($errors)) {

    $new_user_data = fieldValidation($_POST); // - валідація даних
    $all_data_of_users = decoder(USERSDATA);// - повернення асоціативного масива
    
    if(checkUsers($new_user_data, $all_data_of_users)) {
        $all_data_of_users[] = $new_user_data; // -  дод даних вже до існуючого масива даних
        encoder($all_data_of_users); // - зберігання в json
        $_SESSION['success'] = 'Успішна реєстрація!';
    } else {
        $errors["register"] = 'Such a user already exists!';
    }

    //simpleViewArray($all_data_of_users);
    
} else {
    $errors["fields"] = 'Спробуйте ще раз';
}

$_SESSION['errors'] = $errors;
redirect('index');