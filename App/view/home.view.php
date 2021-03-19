<?php
    class HomeView extends ViewBase implements IView {
        public $_users;
        public function setUsers($users){
            $this->_users = $users;
        }
        public function show($message = ""){
            $this->showHeader();
            $users = $this->_users;
            include('./app/components/home.php');
            $this->showFooter();
        }
    }