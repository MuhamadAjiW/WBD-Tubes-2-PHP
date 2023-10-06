<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use Exception;

class User extends Controller{

    public function __construct(){
        parent::__construct();
        $middleware = $this->middleware('AuthMiddleware');
        $middleware->check(false, "/error/404");
    }

    //TODO: Messages and validation
    public function getUser(){
        try{
            $usermodel = $this->model('UserModel');
            
            $user_id = $_GET['uid'];
    
            try{                
                $userData = $usermodel->fetchUserByID($user_id);
                if (!empty($userData)) {
                    header('Content-Type: application/json');
                    echo json_encode($userData);
    
                    http_response_code(200);
                } else {
                    http_response_code(404);
                }
            } catch(Exception){
                http_response_code(400);
                exit;
            }            
        } catch (Exception){
            http_response_code(500);
        }
    }

    public function addUser(){
        try{
            $usermodel = $this->model('UserModel');
            
            parse_str(file_get_contents("php://input"), $vars);

            $email = $vars['email'];
            $username = $vars['username'];
            $password = $vars['password'];
            $name = $vars['name'];
            $bio = $vars['bio'];
            $admin = $vars['admin'];

            try{        
                $usermodel->addUser($email, $username, $password, $name, $bio, $admin);
            } catch(Exception){
                http_response_code(400);
                exit;
            }

            http_response_code(200);
        } catch (Exception){
            http_response_code(500);
        }
    }

    public function editUser(){
        try{
            $usermodel = $this->model('UserModel');
    
            parse_str(file_get_contents("php://input"), $vars);

            $user_id = $vars['uid'];
            $email = $vars['email'];
            $username = $vars['username'];
            $password = $vars['password'];
            $name = $vars['name'];
            $bio = $vars['bio'];
            $admin = $vars['admin'];

            try{
                $usermodel->updateUserData($user_id, $name, $username, $email, $password, $bio, $admin);
            } catch(Exception){
                http_response_code(400);
                exit;
            }

            http_response_code(200);
        } catch (Exception){
            http_response_code(500);
        }
    }

    public function deleteUser(){
        try{
            $usermodel = $this->model('UserModel');
    
            parse_str(file_get_contents("php://input"), $vars);

            $user_id = $vars['uid'];

            try{
                $usermodel->deleteUserByID($user_id);
            } catch(Exception){
                http_response_code(400);
                exit;
            }

            http_response_code(200);
        } catch (Exception){
            http_response_code(500);
        }
    }
}

?>