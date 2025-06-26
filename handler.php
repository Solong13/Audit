<?php

// var_dump($_REQUEST);
// var_dump($_POST);
/*
-Перевірка щоб поля були не пусті, ++
-якщо пусті запис в масив помилок ++
-потім успішна реєстрація та запис даних в файл
-і повідомлення про успішну реєстрацію користувача
-І редірект
*/
$errors = [];
$success = false;

// Перевырка полів на заповненість
if (isset($_POST)) {
    if (!empty($_POST["fullname"])) {
        if (!empty($_POST["current_position"])) {
            if (!empty($_POST["workshop"])) {
                if (!empty($_POST["table_number"])) {
                    if (!empty($_POST["current_salary"])) {

                        $success = true; 
                        //echo "Успішна реєстрація!!!";

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

// Самий алгоритм реєстрації запису в файл
if (isset($success)) {

    if (!file_exists("$_POST[table_number].json")) {
        $new_user = $_POST;
        $content = json_encode($new_user, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        file_put_contents('users/'.$_POST['table_number'].'.json', $content);
        header("Location: index.php?errors=Успішна реєстрація!!!");
        exit;
    } else {
        header("Location: index.php?errors=Даний користувач вже існує");
        exit;
    }
    

} else {
    header("Location: index.php?errors=$errors");
    exit;
}