<?php
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once ($_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php');
require_once ($_SERVER['DOCUMENT_ROOT'] . '/helpers.php');
include_once (__DIR__ . '/../helpers_for_DB.php');  

$default_page = 'portfolio'; 
if (!isset($_SESSION['id_employee'])) { 
    $default_page = 'login'; 
} 

$page = $_GET['page'] ?? $default_page;

ob_start();
switch ($page) { 
    case 'login':  include_once (__DIR__ . '/../login_form.php');
        break;
    case 'handler_for_registretionDB':  include_once (__DIR__ . '/../handler_for_registretionDB.php');
        break;    
    case 'index':  include_once (__DIR__ . '/index.php');
        break;
    case 'edit_salary':  include_once (__DIR__ . '/../edit_salary.php');
        break;    
    case 'registration': include_once (__DIR__ . '/../register_form.php');
       break;
    case 'uploadPhotos': include_once (__DIR__ . '/../uploadPhotos.php');
       break;   
    case 'logout': include_once (__DIR__ . '/../logout.php');
        break;
    case 'handler_for_login': include_once (__DIR__ . '/../handler_for_loginDB.php');
        break;
    case 'employee_page': include_once (__DIR__ . '/../employee_page.php');
        break;
    case 'handler_for_salaries': include_once (__DIR__ . '/../actions/handler_for_salaries.php');
        break;    
    case 'portfolio': include_once (__DIR__ . '/../portfolio.php');
        break;      
    default: include_once (__DIR__ . '/../portfolio.php');
}  

$mainContent = ob_get_clean();
           
include_once (__DIR__ . '/../header.php');
echo ($mainContent);
include_once (__DIR__ . '/../footer.php');
