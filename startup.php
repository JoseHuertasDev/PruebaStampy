<?php
    include_once "libs/includes.php";

    class Startup{
        private $router;
        public function init(){
            $this->router = new Router(); 

            //Añadimos las dependencias
            DependencyInjectorEngine::add("UserController","UserController");
            DependencyInjectorEngine::add("UserView","UserView");
            DependencyInjectorEngine::add("HomeView","HomeView");
            DependencyInjectorEngine::addSingleton("UserModel","UserModel");
            DependencyInjectorEngine::addSingleton("IAuthService","AuthService");
            DependencyInjectorEngine::add("INavigationService","NavigationService");
            
            $this->setRoutes();
            $this->startRouter();
        }   

        private function setRoutes(){
            //"encendemos" el router
            $this->router->addRoute("home", "GET", "HomeController", "showList");
            $this->router->addRoute("login", "GET", "UserController", "login");
            $this->router->addRoute("logout", "GET", "UserController", "logout");
            $this->router->addRoute("log-user", "POST", "UserController", "logUser");
            $this->router->addRoute("editar-usuario/:ID","GET","UserController","editUser");
            $this->router->addRoute("anadir-usuario","GET","UserController","editUser");
            $this->router->addRoute("eliminar-usuario/:ID","GET","HomeController","deleteUser");
            $this->router->addRoute("guardar-usuario/:ID","POST","UserController","saveUser");
            $this->router->addRoute("guardar-usuario","POST","UserController","saveNewUser");
            $this->router->setDefaultRoute("HomeController", "showList");
        }
        private function startRouter(){            
            $this->router->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 
        }
    }


    (new Startup())->init();