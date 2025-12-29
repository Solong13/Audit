<?php

namespace Src\Services\Index;
use Src\Models\IndexModel;
use Core\Session;

class IndexService 
{
    private IndexModel $indexDb; 
    private Session $session;

    public function __construct()
    {   
        $this->indexDb = new IndexModel();
        $this->session = new Session();
    }

    public function getDataFromClient()
    {
        // Чи є взагалі сесія користувача
        $sessionDataClient = $this->session->get('employee');
        if (!empty($sessionDataClient)) {
            // Якщо це адмін
                if ((int)$sessionDataClient['employee_role'] !== 1) {
                    $result = $this->indexDb->getSalaryCurrentEmployee($sessionDataClient['id_employee']);
                } else {
                    // Якщо це звичайний куристувач
                    $result = $this->indexDb->getAllEmployeeAndTheirPositions();
                }

                return $result;
        }
        // Немає ще одного else Через те що наш App слідкує за авторізаціюєю користувача

    }
}

/*Cтворити можливо батьківський Сервіс??
*/