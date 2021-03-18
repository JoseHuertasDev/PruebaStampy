<?php
    interface IAuthService{
        public function isAuth();
        public function logUser(string $email);
        public function logOut();
    }

    class AuthService implements IAuthService{
        function __construct()
        {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
        }

        public function isAuth(){
            //Si hay una session y esta seteado un email
            return (session_status() === PHP_SESSION_ACTIVE  && isset($_SESSION["EMAIL"]));
        }

        public function logUser(string $email){
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            $_SESSION["EMAIL"] = $email;
            $_SESSION['LAST_ACTIVITY'] = time();
        }

        public function logOut(){
            session_destroy();
        }
    }