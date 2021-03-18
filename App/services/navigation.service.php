<?php
    interface INavigationService{
        public function goHome();
        public function goLoginPage();
    }

    class NavigationService implements INavigationService{
        public function goHome(){
            header("Location: ".HOME);
        }
        public function goLoginPage(){
            header("Location: ".LOGIN);
        }
    }