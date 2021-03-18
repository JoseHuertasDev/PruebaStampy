<?php
    require_once './libs/router.class.php';
    require_once './app/controller/user.controller.php';

    // CONSTANTES PARA RUTEO
    define("BASE_URL", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/');
    define("LOGIN", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/login');
    define("LOGOUT", 'http://'.$_SERVER["SERVER_NAME"].':'.$_SERVER["SERVER_PORT"].dirname($_SERVER["PHP_SELF"]).'/logout');
    
    class Startup{
        public function init(){

            //Añadimos las dependencias
            DependencyInjectorEngine::add("UserController","UserController");
            DependencyInjectorEngine::add("IUserView","UserView");
            DependencyInjectorEngine::add("ITemplate","TemplateEngine");
            DependencyInjectorEngine::addSingleton("UserModel","UserModel");

            $this->startRouter();
        }   

        private function startRouter(){
            // creo el router
            $router = new Router(); 
            //"encendemos" el router
            $router->addRoute("login", "GET", "UserController", "Login");
            $router->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 
        }
    }


    (new Startup())->init();