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

    public function showList($message = ""){
        if(is_array($message)){
            $message = "";
        }
        if(!$this->_authService->isAuth()){
            return $this->_navigationService->goLoginPage();
        }
        $users = $this->_userModel->getAll();
        if($users){
            $this->_homeView->setUsers($users);
            return $this->_homeView->show($message);
        }

        $this->_homeView->show("¡No hay usuarios para mostrar!");
    }

    function deleteUser($params = null){
        if(!$this->_authService->isAuth()){
            return $this->_navigationService->goLoginPage();
        }
        $id = $params[':ID'];
        $user = $this->_userModel->getUserById($id);
        if(!$user){
            return $this->showList("No se encontró un usuario para este ID");
            //TO DO
        }

        if(!$this->_userModel->deleteUser($user)){
            return $this->showList("No se pudo eliminar el usuario. Contactese con un administrador.");
        }

        $this->_navigationService->goHome();
    }
}
