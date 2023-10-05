<?php

namespace app\models;

use app\core\Database;

class UserModel{
    private $database;

    public function __construct(){
        $this->database = new Database();
    }

    public function addUser(
        $email,
        $username,
        $password,
        $name,
        $bio,
        $admin
    ){
        $query = 'INSERT INTO users (email, username, password, name, bio, admin)
        VALUES (:email, :username, :password, :name, :bio, :admin)';
        
        $this->database->query($query);
        $this->database->bind('email', $email);
        $this->database->bind('username', $username);
        $this->database->bind('password',  password_hash($password, PASSWORD_DEFAULT));
        $this->database->bind('name', $name);
        $this->database->bind('bio', $bio);
        $this->database->bind('admin', $admin);

        $this->database->execute();
    }

    public function login($email){
        $query = 'SELECT user_id, password, admin FROM users WHERE email=:email LIMIT 1';
        $this->database->query($query);
        $this->database->bind('email', $email);
        $user = $this->database->fetch(); 
        return $user;
    }

    public function fetchUserByID($user_id) {
        $query = "SELECT * FROM users WHERE user_id=:user_id";
        $this->database->query($query);
        $this->database->bind('user_id', $user_id);
        return $this->database->fetch();
    }

    public function fetchUserIDByUsername($username) {
        $query = "SELECT user_id FROM users WHERE username=:username";
        $this->database->query($query);
        $this->database->bind('username', $username);

        return $this->database->fetch();
    }
    
    public function fetchUserIDByEmail($email) {
        $query = "SELECT email FROM users WHERE email=:email";
        $this->database->query($query);
        $this->database->bind('email', $email);

        return $this->database->fetch();
    }
    public function fetchInfoUsers($email) {
        $query = 'SELECT email,username,name,bio,admin FROM users WHERE email=:email LIMIT 1';
        $this->database->query($query);
        $this->database->bind('email', $email);
        $user = $this->database->fetch(); 
        return $user;
    }

    public function fetchAllUsers() {
        $query = "SELECT * FROM users";

        $this->database->query($query);

        return $this->database->fetchAll();
    }
   
}
?>