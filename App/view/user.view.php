<?php
class UserView extends ViewBase implements IView{
  
    function show($message = ""){
        $message = $message;
        $this->showHeader();
        include "./app/components/login.php";
        $this->showFooter();
    }
}