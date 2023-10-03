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
        // TODO: add hash and salt to password, email formatting for email
        $query = 'INSERT INTO users (email, username, password, name, bio, admin) VALUES (:email, :username, :password, :name, :bio, :admin)';
        
        $this->database->query($query);
        $this->database->bind('email', $email);
        $this->database->bind('username', $username);
        $this->database->bind('password',  password_hash($password, PASSWORD_DEFAULT));
        $this->database->bind('name', $name);
        $this->database->bind('bio', $bio);
        $this->database->bind('admin', $admin);

        $this->database->execute();
    }

    public function login($email, $password){
        $query = 'SELECT email, password FROM users WHERE email=:email LIMIT 1';
        $this->database->query($query);
        $this->database->bind('email', $email);
        $user = $this->database->fetch(); 
        return $user;
    }


}
?>