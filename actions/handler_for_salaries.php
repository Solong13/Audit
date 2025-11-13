<?php
require_once (__DIR__ .  '/../bootstrap.php');
include_once (__DIR__ . '/../helpers_for_DB.php');  
include_once (__DIR__ . '/../handler_for_portfolio.php'); 
//var_dump($_POST);
if (empty($_POST["All_hours_c6"])) {
  $_SESSION['error_salary'] = 'заповніть поля';
  redirect('?page=employee_page');
  die;
} else {
  salaryCalculation($_POST, $dbh);
}



