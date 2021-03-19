<?php
class HomeController extends BaseController
{
    private $_authService;
    private $_homeView;
    private $_navigationService;
    private $_userModel;
    function __construct(IAuthService $authService, 
    INavigationService $navigationService,
    HomeView $homeView, UserModel $userModel )
    {
        parent::__construct();
        $this->_authService = $authService;
        $this->_navigationService = $navigationService;
        $this->_homeView = $homeView;
        $this->_userModel = $userModel;
    }

    public function showList(){
        if(!$this->_authService->isAuth()){
            return $this->_navigationService->goLoginPage();
        }
        $users = $this->_userModel->GetAll();
        if($users){
            $this->_homeView->setUsers($users);
            return $this->_homeView->show();
        }

        $this->_homeView->show("¡No hay usuarios para mostrar!");
    }
}
