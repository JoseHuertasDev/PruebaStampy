<?php
class Entity{
    protected $db;
    function __construct(){
        $this->db = new PDO('mysql:host=localhost;'.'dbname=db_users_stampy;charset=utf8', 'root', '');
    }
}