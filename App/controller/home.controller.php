<?php
class HomeController
{
    private $_authService;
    private $_homeView;
    private $_navigationService;
    private $_userModel;
    function __construct(IAuthService $authService, 
    INavigationService $navigationService,
    HomeView $homeView, UserModel $userModel )
    {
        $this->_authService = $authService;
        $this->_navigationService = $navigationService;
        $this->_homeView = $homeView;
        $this->_userModel = $userModel;
    }

    public function showList(){
        if(!$this->_authService->isAuth()){
            return $this->_navigationService->goLoginPage();
        }
        //print_r($this->_userModel->GetAll());
        $this->_homeView->show();
    }
}
