<?php

namespace Src\Services\Login;

use Core\Session;
use Src\Models\LoginModel;
use Core\Post;

class LoginAuthService
{
    private LoginModel $loginModel;
    private  $post;
    private Session $session;

    public function __construct(Session $session, Post $post)
    {   
        $this->loginModel = new LoginModel();
        $this->session = $session;
        $this->post = $post;
    }

    public function serviceDataVerification(array $dataFromUserForLogin)
    {   
 
        $employee = $this->loginModel->logInEmployee($dataFromUserForLogin);

        if(!empty($employee)) {
            if (password_verify($this->post->get('password'), $employee['password'])) {
                if(mb_strtolower($this->post->get('fullname')) == mb_strtolower($employee["fullname"])) {

                    $this->session->add('employee',  
                        [
                            "id_employee" => $employee["id_employee"],
                            "table_number" => $employee["table_number"],
                            "fullname" => $employee["fullname"],
                            "photo" => $employee["photo"],
                            "employee_role" => $employee["employee_role"]
                        ]
                    );    
                            
                }

                return true;
                        
                } else {
                    $this->session->add('error',  'Пароль неправильный.');
                }
        } else {
            $this->session->add('error',  'Користувача не знайдено');
        }
        return false;
    }

    /*
        перевірив пароль
        перевірив користувача
        якщо щось не так → записав $_SESSION['error']
        якщо все ок → записав $_SESSION['employee']
        повернув true або false

        1. Отримати дані
        2. Очистити
        3. Знайти користувача
        4. Якщо не знайдено → помилка
        5. Якщо пароль не співпадає → помилка
        6. Якщо fullname не співпадає → помилка
        7. Записати в сесію
        8. Повернути успіх
    */

}
