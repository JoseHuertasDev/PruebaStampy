<?php
include_once 'entity.php';

class UserModel extends Entity{

    function GetUser($user){
        $sqlStatement = $this->db->prepare("SELECT * FROM users WHERE email=?");
        $sqlStatement->execute(array($user));
        return $sqlStatement->fetch(PDO::FETCH_OBJ);
    }
      
}
