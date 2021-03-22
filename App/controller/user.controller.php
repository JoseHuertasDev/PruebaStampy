<?php
class UserController extends BaseController{

    private $_view;
    private $_model;
    private $_authService;
    private $_navigationService;

    function __construct(UserView $view, UserModel $model, 
    IAuthService $authService, INavigationService $navigationService){
        parent::__construct();
        $this->_view = $view;
        $this->_model = $model;
        $this->_authService = $authService;
        $this->_navigationService = $navigationService;
    }

    function login(){
        if($this->_authService->isAuth()){
            $this->_navigationService->goHome();
        }
        $this->_view->show();
    }

    function logout(){
        $this->_authService->logOut();
        $this->_navigationService->goLoginPage();
    }

    function saveNewUser($params = null){
        if(!$this->_authService->isAuth()){
            return $this->_navigationService->goLoginPage();
        }
        $viewModel = new UserViewModel();

        if($this->showErrorIfDataMissing($viewModel)) return; //Si se mostro un error

        $emaiInput = $_POST["input_user"];
        $pass = $_POST["input_pass"];
        $pass_repeat = $_POST["input_pass_repeat"];
        
        $viewModel->email = $emaiInput;

        if($this->_model->getUserByEmail($emaiInput)){
            return $this->_view->showEdit("Ya existe un usuario con este email", $viewModel);
        }

        if($pass!==$pass_repeat){
            return $this->_view->showEdit("Las contraseñas deben ser iguales", $viewModel);
        }
        
        if(!$this->_model->saveNewUser($emaiInput, password_hash($pass, PASSWORD_DEFAULT))){
            return  $this->_view->showEdit("Ocurrió un error al guardar en la base de datos. Por favor contactese con un administrador", $viewModel);
        }

        $this->_navigationService->goHome();
    }
    
    protected function showErrorIfDataMissing($user = null){
        
        if(!isset($_POST["input_user"]) || empty($_POST["input_user"])){
            $this->_view->showEdit("Debe especificar un email");
            return true;
        }
        if($user !== null){
            $user->email = $_POST["input_user"];
        }
        if(!isset($_POST["input_pass"]) || empty($_POST["input_pass"])){
            $this->_view->showEdit("Debe especificar una contraseña", $user);
            return true;
        }
        if(!isset($_POST["input_pass_repeat"]) || empty($_POST["input_pass_repeat"])){
            $this->_view->showEdit("Debe repetir la contraseña", $user);
            return true;
        }
        return false;

    }
    function saveUser($params = null){
        if(!$this->_authService->isAuth()){
            return $this->_navigationService->goLoginPage();
        }
        $id = $params[':ID'];

        if(!isset($id) || ! is_numeric($id) ){
            return $this->_view->showEdit("No se indico un usuario");
        }
        $user = $this->_model->getUserById($id);
        if(!$user){
            return $this->_view->showEdit("No se encontró un usuario para este ID");
        }
        
        if($this->showErrorIfDataMissing($user)) return; //Si se mostro un error

        $emaiInput = $_POST["input_user"];
        $pass = $_POST["input_pass"];
        $pass_repeat = $_POST["input_pass_repeat"];

        $user->email = $emaiInput;

        if(!empty($pass)){

            if($pass != $pass_repeat){
                return $this->_view->showEdit("Las contraseñas deben coincidir",$user);
            }
            $user->password = password_hash($pass, PASSWORD_DEFAULT);
        }
        
        
        if(!$this->_model->updateUser($user)){
            return  $this->_view->showEdit("Ocurrió un error al guardar en la base de datos. Por favor contactese con un administrador",$user);
        }

        $this->_navigationService->goHome();
    }

    function editUser($params = null){
        if(!$this->_authService->isAuth()){
            return $this->_navigationService->goLoginPage();
        }
        $id = $params[':ID'];

        if(!isset($id) || ! is_numeric($id) ){
            return $this->_view->showEdit();
        }
        $user = $this->_model->getUserById($id);

        if(!$user){
            return $this->_view->showEdit("No se encontró un usuario para este ID");
        }
        $this->_view->showEdit("",$user);
    }
    function logUser(){
        if($this->_authService->isAuth()){
            return $this->_navigationService->goHome();
        }
        if(!isset($_POST["input_user"]) || empty($_POST["input_user"])){
            return $this->_view->show("El usuario no existe");
        }
        if(!isset($_POST["input_pass"]) || empty($_POST["input_pass"])){
            return $this->_view->show("Debe especificar una contraseña");
        }

        $user = $_POST["input_user"];
        $pass = $_POST["input_pass"];

        if(isset($user)){
            $userFromDB = $this->_model->getUser($user);

            if(isset($userFromDB) && $userFromDB){
                // Existe el usuario

                if (password_verify($pass, $userFromDB->password)){
                    $this->_authService->logUser($user);
                    $this->_navigationService->goHome();
                }else{
                    $this->_view->show("Contraseña incorrecta");
                }

            }else{
                // No existe el user en la DB
                $this->_view->show("El usuario no existe");
            }
        }
    }

    
}
