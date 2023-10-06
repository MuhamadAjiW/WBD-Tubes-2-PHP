<?php

namespace app\models;

use app\core\Database;
use config\AppConfig;

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

        return $this->database->rowCount();
    }

    public function login($email){
        $query = 'SELECT user_id, password, admin FROM users WHERE email=:email LIMIT 1';
        $this->database->query($query);
        $this->database->bind('email', $email);
        $user = $this->database->fetch(); 
        return $user;
    }

    public function fetchUsersPaged($page = 1, $pagesize = AppConfig::ENTRIES_PER_PAGE){
        $query = "SELECT user_id, email, username, name, bio, admin FROM users";
        $this->database->query($query);
        $this->database->execute();
        $totalusers = $this->database->rowCount();

        $query = "SELECT user_id, email, username, name, bio, admin
        FROM users
        LIMIT :limit OFFSET :offset";
        $this->database->query($query);
        $this->database->bind('limit', $pagesize);
        $this->database->bind('offset', ($page - 1) * $pagesize);
        
        return [$this->database->fetchAll(), $totalusers];
    }

    public function fetchUserByID($user_id) {
        $query = "SELECT user_id, name, username, email, password, bio, admin FROM users WHERE user_id = :user_id";

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

    public function fetchInfoUsersByID($user_id) {
        $query = 'SELECT email,username,name,bio,admin FROM users WHERE user_id=:user_id LIMIT 1';
        $this->database->query($query);
        $this->database->bind('user_id', $user_id);
        $user = $this->database->fetch(); 
        return $user;
    }

    public function fetchAllUsers() {
        $query = "SELECT user_id, email, username, name, bio, admin, password FROM users";

        $this->database->query($query);

        return $this->database->fetchAll();
    }
    
    public function checkUsernameExists($username) {
        $query = "SELECT username FROM users WHERE username = :username";

        $this->database->query($query);
        $this->database->bind('username', $username);
        $rows = $this->database->fetchAll();

        return $rows;
    }

    public function checkUsernameExists2($username) { // Checking By ID
        $query = "SELECT user_id FROM users WHERE username=:username";

        $this->database->query($query);
        $this->database->bind('username', $username);
        
        return $this->database->fetch();
    }

    public function deleteUserByID($user_id) {
        $query = "DELETE FROM users WHERE user_id = :user_id";

        $this->database->query($query);
        $this->database->bind('user_id', $user_id);
        $this->database->execute();

        return $this->database->rowCount();
    }

    public function updateUserData($user_id, $name, $username, $email, $password, $bio, $admin) {
        $query = "UPDATE users SET name=:name, username=:username, email=:email, password=:password, bio=:bio, admin=:admin WHERE user_id=:user_id";

        $this->database->query($query);
        $this->database->bind('email', $email);
        $this->database->bind('username', $username);
        $this->database->bind('password',  password_hash($password, PASSWORD_DEFAULT));
        $this->database->bind('name', $name);
        $this->database->bind('bio', $bio);
        $this->database->bind('admin', $admin);
        $this->database->bind('user_id', $user_id);

        $this->database->execute();

        return $this->database->rowCount();
    }

    public function updateUserData2($user_id, $name, $username, $email, $bio, $admin) { // No password update
        $query = "UPDATE users SET name=:name, username=:username, email=:email, bio=:bio, admin=:admin WHERE user_id=:user_id";

        $this->database->query($query);
        $this->database->bind('email', $email);
        $this->database->bind('username', $username);
        $this->database->bind('name', $name);
        $this->database->bind('bio', $bio);
        $this->database->bind('admin', $admin);
        $this->database->bind('user_id', $user_id);

        $this->database->execute();

        return $this->database->rowCount();
    }
}
?>