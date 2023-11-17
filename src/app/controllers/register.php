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
                $data['errors'] = $errors;
                $this->index($data);
            }
        }
    }

    public function registerApi(){        
        $json_data = file_get_contents("php://input");
        $data = json_decode($json_data, true);

        $userSignUp = $this->model("UserModel");
        $email = $data['email'];
        $password = $data['password'];
        $username = $data['username'];
        $name = $data['name'];
        $bio = $data['bio'];
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
                $userSignUp->addUser($email,$username,$password,$name,$bio,False);
                http_response_code(201);
                echo json_encode(array("message" => "User successfully created", "valid" => true, "data" => [
                    "email" => $email,
                    "username" => $username,
                    "name" => $name,
                    "bio" => $bio,
                    "admin" => False 
                ]));
                return;
            } catch(Exception){
                http_response_code(500);
                echo json_encode(array("message" => "Failed to create user", "valid" => false, "data" => [
                    "error" => ["nameError" => "Internal error"]
                ]));
                return;
            }
        }
        else{
            $errors['email'] = $data['email'];
            $errors['password'] = $data['password'];
            $errors['username'] = $data['username'];
            $errors['name'] = $data['name'];
            
            http_response_code(400);
            echo json_encode(array("message" => "Invalid request", "valid" => false, "data" => [
                "error" => $errors
            ]));
            return;
        }
    }
}
?>