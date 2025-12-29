<?php
// Наш фронт контроллер
session_start();
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once(__DIR__ . '/../config/config.php');// константи шляхів
require ROOT . '/vendor/autoload.php'; 
require_once(HELPERS . '/helpers.php');
require_once(__DIR__ . '/../src/bootstrap.php');



// $session = new Core\Session();
// $session->add('employee', $_SESSION);
// $router = new \Core\Router();
// $router->run();
$app = new Core\Application();
$app->run();
//dump($router->run());

// dump("Post :");
//dump($_POST);
// dump("Session :");
//dump($_SESSION);

// require_once ($_SERVER['DOCUMENT_ROOT'] . '/bootstrap.php');
// require_once ($_SERVER['DOCUMENT_ROOT'] . '/helpers.php');
// include_once (__DIR__ . '/../helpers_for_DB.php'); 



// $obk = new \Core\Application();
// dump(request()->getMethod());
// dump(request()->isGet());
// dump(request()->isPost());
// dump(request()->isAjax());
// dump(request()->get('page'));

// $res = require __DIR__ . '/../vendor/autoload.php'; 
// dump($res);
// dump($_SERVER['REQUEST_URI']);
// $default_page = 'portfolio'; 
// if (!isset($_SESSION['id_employee'])) { 
//     $default_page = 'login'; 
// } 

// $page = $_GET['page'] ?? $default_page;

// ob_start();
// switch ($page) { 
//     case 'login':  include_once (__DIR__ . '/../login_form.php');
//         break;
//     case 'handler_for_registretionDB':  include_once (__DIR__ . '/../handler_for_registretionDB.php');
//         break;    
//     case 'index':  include_once (__DIR__ . '/index.php');
//         break;
//     case 'edit_salary':  include_once (__DIR__ . '/../edit_salary.php');
//         break;    
//     case 'registration': include_once (__DIR__ . '/../register_form.php');
//        break;
//     case 'uploadPhotos': include_once (__DIR__ . '/../uploadPhotos.php');
//        break;   
//     case 'logout': include_once (__DIR__ . '/../logout.php');
//         break;
//     case 'handler_for_login': include_once (__DIR__ . '/../handler_for_loginDB.php');
//         break;
//     case 'employee_page': include_once (__DIR__ . '/../employee_page.php');
//         break;
//     case 'handler_for_salaries': include_once (__DIR__ . '/../actions/handler_for_salaries.php');
//         break;    
//     case 'portfolio': include_once (__DIR__ . '/../portfolio.php');
//         break;      
//     default: include_once (__DIR__ . '/../portfolio.php');
// }  

// $mainContent = ob_get_clean();
           
// include_once (__DIR__ . '/../header.php');
// echo ($mainContent);
// include_once (__DIR__ . '/../footer.php');



