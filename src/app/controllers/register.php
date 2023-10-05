<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;

class Register extends Controller{
    public function index(){
        $usermodel = $this->model("UserModel");

        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/auth.css");
        $this->addRel("stylesheet", "/public/css/topbar.css");
        
        $this->view('Register');
    }
    
    public function register(){
        //TODO: Implement
        $namaError ='';
        if(isset($_POST['signup'])){
            $userSignUp = $this->model("UserModel");
            $email = $_POST['email'];
            $password = $_POST['password'];
            $username = $_POST['username'];
            $nama = $_POST['name'];
            $userEmail = $userSignUp->fetchUserIDByEmail($email);
            $userUsername = $userSignUp->fetchUserIDByUsername($username);
            if($userEmail == null and $userUsername == null){
                $userSignUp->addUser($email,$username,$password,$nama,"",False);
                $this->view('Login');
            }
            else{
                $namaError = "Username atau password sudah digunakan";
                $this->view('Register', ['namaError' => $namaError]);
            }
        }
    }
}
?>