<?php

include_once "libs/template.engine.php";

interface IUserView{
    /**
     * @var string
     */
    function ShowLogin($message = "" );
}

class UserView implements IUserView{

    private $title;
    private $templateEngine;

    function __construct(ITemplate $templateEngine){
        $this->templateEngine = $templateEngine;
        $this->title = "StampyMail - Login";
    }

    function displayInsideMainTemplate($content){
        $this->templateEngine->setFile("./app/templates/index.html");
        $this->templateEngine->set("title",$this->title);
        $this->templateEngine->set("content", $content);
        echo $this->templateEngine->getOutput();
    }
    function ShowLogin($message = ""){
        $this->templateEngine->setFile("./app/templates/login.html");
        $this->templateEngine->set("title",$this->title);
        $this->templateEngine->set("message", $message);
        $this->displayInsideMainTemplate( $this->templateEngine->getOutput() );
    }

}