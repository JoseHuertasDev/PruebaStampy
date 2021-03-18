<?php

require_once "app/view/user.view.php";
require_once "app/model/user.model.php";
require_once "app/services/auth.service.php";
require_once "app/services/navigation.service.php";

class UserController{

    private $_view;
    private $_model;
    private $_authService;
    private $_navigationService;

    function __construct(IUserView $view, UserModel $model, 
    IAuthService $authService, INavigationService $navigationService){
        $this->_view = $view;
        $this->_model = $model;
        $this->_authService = $authService;
        $this->_navigationService = $navigationService;
    }

    function login(){
        if($this->_authService->isAuth()){
            $this->_navigationService->goHome();
        }
        $this->_view->ShowLogin();
    }

    function logout(){
        $this->_authService->logOut();
        $this->_navigationService->goLoginPage();
    }

    function logUser(){
        if(!isset($_POST["input_user"])){
            return $this->_view->ShowLogin("El usuario no existe");
        }
        if(!isset($_POST["input_pass"])){
            return $this->_view->ShowLogin("Debe especificar una contraseña");
        }

        $user = $_POST["input_user"];
        $pass = $_POST["input_pass"];

        if(isset($user)){
            $userFromDB = $this->_model->GetUser($user);

            if(isset($userFromDB) && $userFromDB){
                // Existe el usuario

                if (password_verify($pass, $userFromDB->password)){
                    $this->_authService->logUser($user);
                    $this->_navigationService->goHome();
                }else{
                    $this->_view->ShowLogin("Contraseña incorrecta");
                }

            }else{
                // No existe el user en la DB
                $this->_view->ShowLogin("El usuario no existe");
            }
        }
    }
}
