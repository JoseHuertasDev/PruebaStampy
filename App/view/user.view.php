<?php
class UserView extends ViewBase implements IView{
    private $user;


    function showEdit($message = "", $_user = false){
        $message = $message;
        $this->showHeader();
        $user = $_user;
        include "./app/components/edit.php";
        $this->showFooter();
    }
    function show($message = ""){
        $message = $message;
        $this->showHeader();
        include "./app/components/login.php";
        $this->showFooter();
    }
}