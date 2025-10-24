<?php
session_start();
require_once ('../config/connectionToDB.php'); 
include_once ('../helpers_for_DB.php'); 
include_once ('../handler_for_portfolio.php');   
/*
Оновлені дані спочатку перераховуються і потім знову перезаписуються по існуючому id_salary
*/
//var_dump($_POST["All_hours_c6"]);
if (empty($_POST["All_hours_c6"])) {
  $_SESSION['error_salary'] = 'заповніть поля';
 
  redirect('/employee_page');
  die;
}
salaryCalculation($_POST, $dbh);



