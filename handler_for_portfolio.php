<?php
session_start();
include_once ('config/connectionToDB.php');
include_once ('helpers.php');   
include_once ('helpers_for_DB.php');   
/*
Видалення на користувача(і якщо його запис я з бд видаляю його має викидати) і редагування записів зп з певними правами

Пропрацювати логіку введення даних заробітної плати...
Я бухгалтер - вводжу дані

+++Чи повинен при реэстрації працівник вводити сам свою зп і якщо так то потрібно її перевіряти
+++ Одна таблиція посада оклад і одна з кодами 

Змінити реєстрацію, щоб актуальний оклад підтягувався за професією і цехом
створюмо окрему таблицю професія оклад
?створюмо окрему таблицю з кодами

Я користувач і можу лише дивтися свої дані, а от хто має права той і вводить їх і редагує/видаляє
Користувач бачить готову відсортовану по датам інфу

Результат генерація таблиці чи серії таблиць за певний період часу як моя розрахункова

вказувати при інсьорті всі поля а вносити що є по факту. 
Переписати під БД реєстрацію то авторизацію
почитати для оновлення про кукі і сесії
*/

// від балди денні години за червень 2025
$day_personal_hours = 168;

simpleViewArray($_POST);  
$all_data = clenFeilds($_POST); 
simpleViewArray($all_data); 

$current_position = getCurrentEmployee($all_data["id_employee"], $dbh);

/*Де брати кількість днів денного персоналу ? масив?*/
$all_hour = $all_data['All_hours_c6'];
$current_salary = $current_position["base_salary"];
$night_shift_hours = $all_data['Night_shift_hours_c11'];
$salary_indexation = $all_data['Salary_indexation_c150'];
$overtime_hours = $all_data['Overtime_hours_c29'];
$health_allowance = $all_data['Health_allowance'];
$vacation_pay = $all_data['Vacation_pay'];
$premium_c116 = $all_data['premium_c116'];

// оклад
$my_salary = $current_salary; 
// нічні
$money_for_night_shift =  round(($my_salary / $day_personal_hours) / 2 * $night_shift_hours, 2);
// наднормові
$overtime_hours_isready = round(($my_salary / $day_personal_hours) * 2 * $overtime_hours, 2);
// до сплати податків
$amount_before_taxes = round(($my_salary + $money_for_night_shift + $overtime_hours_isready + $premium_c116 + $salary_indexation), 2);

// ПДФО 18%
$PDFO_tax_c532 = round(($amount_before_taxes * 0.18), 2);
// Військовий Збір 5%
$Military_Service_tax_c590 = round(($amount_before_taxes * 0.05), 2);
// Профспілки внесок 1%
$Trade_union_tax_c555 = round(($amount_before_taxes * 0.01), 2);
// Сума всіх податків
$sum_all_taxes = round(($PDFO_tax_c532 + $Military_Service_tax_c590 + $Trade_union_tax_c555), 2);
// Сума після виплати податків
$amount_after_taxes = round(($amount_before_taxes - $sum_all_taxes), 2);

$all_data = array_merge($all_data, [
    "current_salary" => $my_salary,
    "money_for_overtime" => $overtime_hours_isready,
    "money_for_night_shift" => $money_for_night_shift,
    "PDFO_tax_c532" => $PDFO_tax_c532,
    "Military_Service_tax_c590" => $Military_Service_tax_c590,
    "Trade_union_tax_c555" => $Trade_union_tax_c555,
    "id_employee" => $all_data["id_employee"],
    "gross_salary" => $amount_before_taxes,
    "net_salary" => $amount_after_taxes,
]);

simpleViewArray($all_data); 

salaryRecord($all_data, $dbh);
redirect('/public/index');
die;