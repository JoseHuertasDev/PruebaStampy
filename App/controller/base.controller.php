<?php 


abstract class BaseController {

    private $data; 

    public function __construct() {
        $this->data = file_get_contents("php://input"); 
    }

    function getData(){ 
        return json_decode($this->data); 
    }  
}

