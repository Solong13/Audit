<?php  

namespace Src\Controllers;

use Core\Controller;
use Core\Session;
use Src\Services\Login\LoginAuthService;
use Src\Services\Login\LoginAuthPostService;

class LoginController extends Controller
{
    public LoginAuthService $loginAuthService;
    public LoginAuthPostService $LoginAuthPostService;
    public Session $session;

    public function __construct(Session $session)
    {   
        parent::__construct();
        $this->session = $session;
        $this->loginAuthService = new LoginAuthService($this->session, $this->post);
        $this->LoginAuthPostService = new LoginAuthPostService($this->session, $this->post);
    }

    public function loginAction() 
    {   // Подумати що робити з перезавантаженням та повторним відправленням пост даних??
        $this->session->delete('error');
            
        $readyData = $this->LoginAuthPostService->serviceDataClear();

        if (!empty($readyData)) {
            $addEmployeeToSession = $this->loginAuthService->serviceDataVerification($readyData);
            if ($addEmployeeToSession) {
                $this::redirect('portfolio');
            }
        }
        
        echo $this->view->render('login', ['error' => $this->session->get('error')]);
    }

}
