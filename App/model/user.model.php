<?php
include_once 'entity.php';

class UserModel extends Entity{

    function GetUser($user){
        $sqlStatement = $this->db->prepare("SELECT * FROM users WHERE email=?");
        $sqlStatement->execute(array($user));
        return $sqlStatement->fetch(PDO::FETCH_OBJ);
    }
    function GetAll(){
        $sqlStatement = $this->db->prepare("SELECT * FROM users");
        $sqlStatement->execute();
        return $sqlStatement->fetchAll(PDO::FETCH_OBJ);
    }
    function GetUserById($id){
        $sqlStatement = $this->db->prepare("SELECT * FROM users WHERE ID=?");
        $sqlStatement->execute(array($id));
        return $sqlStatement->fetch(PDO::FETCH_OBJ);
    }
    function UpdateUser($user){
        $sqlStatement = $this->db->prepare("UPDATE users SET email=?, password=? WHERE ID=?");
        $sqlStatement->execute(array($user->email, $user->password, $user->id));
        return $sqlStatement->rowCount() > 0;
    }
    
}
