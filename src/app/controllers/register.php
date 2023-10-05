<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use Exception;

class Register extends Controller{
    public function index($data = []){
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/auth.css");
        $this->addRel("stylesheet", "/public/css/topbar.css");
        
        $this->view('Register', $data);
    }
    
    public function register(){
        if(isset($_POST['signup'])){
            $userSignUp = $this->model("UserModel");
            $email = $_POST['email'];
            $password = $_POST['password'];
            $username = $_POST['username'];
            $name = $_POST['name'];
            $userEmail = $userSignUp->fetchUserIDByEmail($email);
            $userUsername = $userSignUp->fetchUserIDByUsername($username);

            $errors = [];

            if($userEmail != null){
                $errors['emailError'] = "Email has already been registered";
            }
          
            if($userUsername != null){
                $errors['usernameError'] = "Username has already been taken";
            }
            else if(!preg_match('/^[[:ascii:]]+$/', $username)){
                $errors['usernameError'] = "Username contains non ASCII characters";
            }

            if(!preg_match('/^[[:ascii:]]+$/', $name)){
                $errors['nameError'] = "Name contains non ASCII characters";
            }

            if(strlen($password) < 8){
                $errors['passwordError'] = "Password should be at least 8 characters long";
            }

            if(empty($errors)){
                try{
                    $userSignUp->addUser($email,$username,$password,$name,"",False);
                } catch(Exception){
                    $this->index();
                }
                Router::redirect('/login');
            }
            else{
                $errors['email'] = $_POST['email'];
                $errors['password'] = $_POST['password'];
                $errors['username'] = $_POST['username'];
                $errors['name'] = $_POST['name'];
                $this->index($errors);
            }
        }
    }
}
?>