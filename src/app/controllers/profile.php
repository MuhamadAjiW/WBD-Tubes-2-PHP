<?php

namespace app\controllers;
use app\core\Router;
use app\core\Controller;
use app\models\UserModel;
class Profile extends Controller{
    public function index(){
        session_start();
        $usermodel = $this->model("UserModel");
        $email = $_SESSION["email"];
        if($_SESSION["email"] != null){
            $user=$usermodel->fetchInfoUsers($email);
            $email=$user["email"];
            $username = $user["username"];
            $name = $user["name"];
            $bio = $user["bio"];
            $admin = $user["admin"];
            $this->view('Profile', ['email' => $email, 'name' => $name, 'username' => $username, 'bio' => $bio, 'admin' => $admin]);
        } 
    }
}

?>