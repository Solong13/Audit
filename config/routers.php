<?php

use Src\Controllers\LoginController;
use Src\Controllers\PortfolioController;
use Src\Controllers\EmployeeController;
use Src\Controllers\LogoutController;
use Src\Controllers\AvatarController;
use Src\Controllers\RegistrationController;
use Src\Controllers\NotFoundController;

$app->router->get('/registration', [RegistrationController::class, 'registrationAction'])
       ->middleware('guest');

$app->router->post('/registration/newEmployee', [RegistrationController::class, 'newEmployeeAction'])
       ->middleware('guest');

$app->router->get('/', [LoginController::class, 'loginAction'])
       ->middleware('guest');

$app->router->get('/login', [LoginController::class, 'loginAction'])
       ->middleware('guest');

$app->router->post('/login', [LoginController::class, 'loginAction'])
       ->middleware('guest');

$app->router->get('/logout', [LogoutController::class, 'logoutAction'])
       ->middleware('auth');

$app->router->get('/portfolio', [PortfolioController::class, 'portfolioAction'])
       ->middleware('auth');

$app->router->get('/employee/salary/{id}', [EmployeeController::class, 'salaryAction'])
       ->middleware('auth');

$app->router->post('/employee/accrual', [EmployeeController::class, 'accrualAction'])
       ->middleware('auth');
  
$app->router->get('/employee/edit/{idsalary}', [EmployeeController::class, 'editAction'])
       ->middleware('auth');   

$app->router->get('/employee/delete/{idsalary}/{id_employee}', [EmployeeController::class, 'deleteAction'])
       ->middleware('auth');

$app->router->post('/avatar/upload', [AvatarController::class, 'uploadAction'])
       ->middleware('auth');

$app->router->get('/404', [NotFoundController::class, 'notFoundAction'])
       ->middleware('guest');