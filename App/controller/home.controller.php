<?php
class HomeController
{
    private $_authService;
    private $_homeView;
    private $_navigationService;
    function __construct(IAuthService $authService, 
    INavigationService $navigationService,
    HomeView $homeView )
    {
        $this->_authService = $authService;
        $this->_navigationService = $navigationService;
        $this->_homeView = $homeView;
    }

    public function showList(){
        if(!$this->_authService->isAuth()){
            return $this->_navigationService->goLoginPage();
        }
        $this->_homeView->show();
    }
}
