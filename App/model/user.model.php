<?php
include_once 'entity.php';

class UserModel extends Entity{

    function getUser($user){
        $sqlStatement = $this->db->prepare("SELECT * FROM users WHERE email=?");
        $sqlStatement->execute(array($user));
        return $sqlStatement->fetch(PDO::FETCH_OBJ);
    }
    function getAll(){
        $sqlStatement = $this->db->prepare("SELECT * FROM users");
        $sqlStatement->execute();
        return $sqlStatement->fetchAll(PDO::FETCH_OBJ);
    }
    function getUserById($id){
        $sqlStatement = $this->db->prepare("SELECT * FROM users WHERE ID=?");
        $sqlStatement->execute(array($id));
        return $sqlStatement->fetch(PDO::FETCH_OBJ);
    }
    function getUserByEmail($email){
        $sqlStatement = $this->db->prepare("SELECT * FROM users WHERE email=?");
        $sqlStatement->execute(array($email));
        return $sqlStatement->fetch(PDO::FETCH_OBJ);
    }
    function updateUser($user){
        $sqlStatement = $this->db->prepare("UPDATE users SET email=?, password=? WHERE ID=?");
        $sqlStatement->execute(array($user->email, $user->password, $user->id));
        return $sqlStatement->rowCount() > 0;
    }
    function saveNewUser($email, $password){
        $sqlStatement = $this->db->prepare("INSERT INTO users (email, password) VALUES( ?,?)");
        return $sqlStatement->execute(array($email, $password));
    }
}
