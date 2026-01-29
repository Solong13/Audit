<?php

namespace Src\Services\Registration;

use Core\Session;
use Src\Models\LogUpModel;
use Src\Models\LoginModel;

class LogUpService 
{
    private Session $session;
    private LogUpModel $logUpModel;
    private LoginModel $loginModel;

    public function __construct(session $session)
    {
        $this->session = $session;
        $this->logUpModel = new LogUpModel();
        $this->loginModel = new LoginModel();
    }

    public function getDataForRegForm() : array
    {
        $result = $this->logUpModel->getPosition();
        if ($this->session->get('error') || !empty($this->session->get('success'))) {
           return array_merge($result, 
           [
            'forReg' => $this->session->get()
           ]);
        } else {
            $this->session->delete('error');
            $this->session->delete('success');
        }
        return $result;
    }

    public function logUp(array $data) : bool
    {
        $success = false;
        // Перевырка полів на заповненість
        if (!empty($data)) {
            $new_employee_data = clenFeilds($data);
            $valid_data_user = validFields($new_employee_data);
            
            if (!empty($valid_data_user)) {
                $this->session->add('error', $valid_data_user[0]);
            } else { 
                $success = true; 
            }
        } else {
            $this->session->add('error','Fill the all empty fields');
        }
        if ($success) {
            $id_position = $this->logUpModel->getPositionId($new_employee_data['current_position']);
            unset($new_employee_data['current_position']);//work position
            $new_employee_data = array_merge($new_employee_data, $id_position);
            $hash_password = password_hash($new_employee_data['password'], PASSWORD_DEFAULT);
            $new_employee_data['password'] = $hash_password;
            $employee_alrady_exists = $this->loginModel->logInEmployee($new_employee_data);

            if (!$employee_alrady_exists) {
                try {
                    $this->logUpModel->createEmployee($new_employee_data);
                    $this->session->add('success','Success Registration');
                    return true;
                } catch (\PDOException $e) {
                    //$e->getMessage();
                    $this->session->add('error', 'Something is wrong!'); // потрібна обробка помилок зрозуміла для користувача
                }
            } else {
                $this->session->add('error','This employee alrady exists!');
            }
        }
        return false;
    }
}