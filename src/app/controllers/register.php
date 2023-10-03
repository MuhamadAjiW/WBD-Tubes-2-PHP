<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;

class Register extends Controller{
    public function index(){
        $usermodel = $this->model("UserModel");
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
            $userEmail = $userSignUp->getEmail($email);
            $userUsername = $userSignUp->getUserName($username);
            if($userEmail == null and $userUsername == null){
                $userSignUp->addUser($email,$username,$password,$nama,"",False);
                
            }
            else{
                $namaError = "Username atau password sudah digunakan";
                $this->view('Register', ['namaError' => $namaError]);
            }
        }
    }
}
?>