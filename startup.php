<?php
    include_once "libs/includes.php";

    class Startup{
        public function init(){

            //Añadimos las dependencias
            DependencyInjectorEngine::add("UserController","UserController");
            DependencyInjectorEngine::add("UserView","UserView");
            DependencyInjectorEngine::add("HomeView","HomeView");
            DependencyInjectorEngine::addSingleton("UserModel","UserModel");
            DependencyInjectorEngine::addSingleton("IAuthService","AuthService");
            DependencyInjectorEngine::add("INavigationService","NavigationService");

            $this->startRouter();
        }   

        private function startRouter(){
            // creo el router
            $router = new Router(); 
            //"encendemos" el router
            $router->addRoute("home", "GET", "HomeController", "showList");
            $router->addRoute("login", "GET", "UserController", "login");
            $router->addRoute("logout", "GET", "UserController", "logout");
            $router->addRoute("log-user", "POST", "UserController", "logUser");
            $router->setDefaultRoute("HomeController", "showList");
            $router->route($_GET['action'], $_SERVER['REQUEST_METHOD']); 
        }
    }


    (new Startup())->init();