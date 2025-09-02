<?php
// Найпростіша валідація, обрізання пробілів побокам та ігнорування html-символів
function fieldValidation(array $fileds) : array
{
    $new_validations_dates = [];
    
    foreach ($fileds as $key => $value) {
        $new_validations_dates[$key] = trim(htmlspecialchars($_POST[$key]));
    }

    return $new_validations_dates;
}
// Запис даних в файл в json форматі(сереалізація)
function encoder(mixed $user_data) 
{   
    file_put_contents("users/user_data.txt", json_encode($user_data));
}

// Створення файлу в перший раз та читання його і видача, як асоціативного масиву
function decoder(string $file_name) : array
{
    if (!file_exists($file_name)) {
        file_put_contents($file_name, "{}");
    }
    return json_decode(file_get_contents($file_name), true);
}

// Зручний вид масива
function simpleViewArray(mixed $array)
{
    echo '<pre>';
    print_r($array);
    echo '</pre>';
}

// Редірект
function redirect(string $where)
{
    header("Location: $where.php");
    exit;
}

// Перевірка з масива даних сервера чи немає співпадінь по даним
function checkUsers(array $dataUser, array $database) 
{
    $flag = null;
    if(isset($database) && !empty($database)){
        foreach($database as $key => $user){
            foreach ($user as $key) {
                if ($key === $dataUser['table_number']) {
                    $flag = $key;
                }
            }
        }
    } else {
        $flag = true;
    }

    if ($flag === $dataUser['table_number']) {
        return false;
    } else {
        return true;
    }
}