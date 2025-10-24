<?php
// Найпростіша валідація, обрізання пробілів побокам та ігнорування html-символів
const USERSDATA = 'data/user_data.txt';

function clenFeilds(array $fileds) : array
{
    $new_validations_dates = [];
    foreach ($fileds as $key => $value) {
        if (isset($value) && empty($value)) {
            $new_validations_dates[$key] = null; 
        } else {
            $new_validations_dates[$key] = trim(htmlspecialchars($value));   
        }
    }

    return $new_validations_dates;
}

// Мінімально-необхідна валідація
function validFields(array $fileds) 
{
    $errors = [];
    if (isset($fileds["fullname"])) {
        if ((int)strlen($fileds["fullname"])  < 10 || (int)strlen($fileds["fullname"])> 50) {
            $errors[] = "ПІП повинно складати від 10 до 50 символів";
        } 
    }
    
    if (isset($fileds['table_number'])) {
        if ((int)strlen($fileds['table_number']) < 1 || (int)strlen($fileds['table_number']) > 6) {
            $errors[] = "Табельний номер повинен складати від 1 до 6 цифир";
        }
    }
    
    if (isset($fileds['current_salary'])) {
        if ($fileds["current_salary"] < 8000) {
            $errors[] = "Мінімальна заробітня плата в Україні становить 8000 гривень";
        }
    }

    return $errors;

}

// Запис даних в файл в json форматі(сереалізація)
function encoder(mixed $user_data) 
{   
    file_put_contents(USERSDATA, json_encode($user_data));
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
    var_dump($array);
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


// Типу винесений блок для реєстрації і авторизації???
function auto_regist(array $data)
{

    if (isset($data) && !empty($data)) {

    $new_user_data = clenFeilds($data);
    
    $valid_data_user = validFields($new_user_data);

    if ($valid_data_user !== null && !empty($valid_data_user)) {
        return $valid_data_user;
    } else { 
        return true; 
    }
    }

}

function sortedDataEmployee(array $getSalaryEmployee) : array
{

    foreach($getSalaryEmployee as $key => $value) {
        if($value["Accural_time"]) {
       // Додаємо нові ключі у той самий елемент
        $getSalaryEmployee[$key]['year'] = substr($value["Accural_time"], 0, 10);
        $getSalaryEmployee[$key]['time'] = substr($value["Accural_time"], 10, 20);
        $getSalaryEmployee[$key]['month'] = substr($value["Accural_time"], 5, 2);
        // Видаляємо старе поле
        unset($getSalaryEmployee[$key]["Accural_time"]);
        }
    }

    return $getSalaryEmployee;
}