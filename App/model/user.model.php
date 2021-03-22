<?php
include_once 'entity.php';

class UserModel extends Entity{
    function getAll(){
        $sqlStatement = $this->db->prepare("CALL GetAllUsers()");
        $sqlStatement->execute();
        return $sqlStatement->fetchAll(PDO::FETCH_OBJ);
    }
    function getUserById($id){
        $sqlStatement = $this->db->prepare("CALL GetUserById(?)");
        $sqlStatement->execute(array($id));
        return $sqlStatement->fetch(PDO::FETCH_OBJ);
    }
    function getUserByEmail($email){
        $sqlStatement = $this->db->prepare("CALL GetUserByMail(?)");
        $sqlStatement->execute(array($email));
        return $sqlStatement->fetch(PDO::FETCH_OBJ);
    }
    function updateUser($user){
        $sqlStatement = $this->db->prepare("CALL UpdateUser(?,?,?)");
        $sqlStatement->execute(array($user->email, $user->password, $user->id));
        return $sqlStatement->rowCount() > 0;
    }
    function saveNewUser($email, $password){
        $sqlStatement = $this->db->prepare("CALL InsertUser(?,?)");
        return $sqlStatement->execute(array($email, $password));
    }

    function deleteUser($user){
        $sqlStatement = $this->db->prepare("CALL DeleteUser(?)");
        return $sqlStatement->execute(array($user->id));
    }
}
