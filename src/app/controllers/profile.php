<?php

namespace app\controllers;
use app\core\Router;
use app\core\Controller;
use app\models\UserModel;
class Profile extends Controller{
    public function index(){
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/auth.css");
        $userProfil = $this->model("UserModel");
        $user = $_SESSION['user_id'];
        if($user != null){
            $userProfil = $userProfil->fetchInfoUsersByID($user);
            $email=$userProfil['email'];
            $username = $userProfil['username'];
            $name = $userProfil['name'];
            $bio = $userProfil['bio'];
            $admin = $userProfil['admin'];
            $this->view('Profile', ['email' => $email, 'name' => $name, 'username' => $username, 'bio' => $bio, 'admin' => $admin]);
        }
        else{
            Router::redirect('/error/404');
        }
}
}

?>