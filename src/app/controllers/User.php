<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use Exception;

class User extends Controller{

    public function __construct(){
        parent::__construct();
        $middleware = $this->middleware('AuthMiddleware');
        $middleware->check(true, "/error/404");
    }

    //TODO: Messages and validation
    public function getUser(){
        try{
            if (isset($_GET['uid'])) {
                $usermodel = $this->model('UserModel');
                
                $user_id = $_GET['uid'];

                try{                
                    $userData = $usermodel->fetchUserByID($user_id);
                    if (!empty($userData)) {
                        header('Content-Type: application/json');
                        
                        http_response_code(200);
                        unset($userData['password']);
                        echo json_encode($userData);
                        exit;
                    } else {
                        http_response_code(404);
                        echo json_encode(array("message" => "User does not exist"));
                        exit;
                    }
                } catch(Exception){
                    http_response_code(500);
                    echo json_encode(array("message" => "Fetch user failed"));
                    exit;
                }            
            }
            else{
                http_response_code(400);
                echo json_encode(array("message" => "Bad request"));
                exit;
            }
        } catch (Exception){
            http_response_code(500);
            echo json_encode(array("message" => "Fetch user failed"));
            exit;
        }
    }

    public function addUser(){
        try{
            parse_str(file_get_contents("php://input"), $vars);
            
            $email = $vars['email'];
            $username = $vars['username'];
            $password = $vars['password'];
            $name = $vars['name'];
            $bio = $vars['bio'];
            $admin = $vars['admin'];
            if (isset($vars['name']) && isset($vars['username']) && isset($vars['password']) && isset($vars['email']) && isset($vars['bio']) && isset($vars['admin'])) {
                $usermodel = $this->model('UserModel');

                $usernameexist = $usermodel->checkUsernameExists($username);

                if (count($usernameexist) > 0) {
                    http_response_code(409);
                    echo json_encode(array("message" => "Username already taken"));
                    exit;
                }

                try{        
                    $rows = $usermodel->addUser($email, $username, $password, $name, $bio, $admin);
                    if($rows){
                        http_response_code(200);
                        echo json_encode(array("message" => "Add user success"));
                        exit;
                    }
                    else{
                        http_response_code(500);
                        echo json_encode(array("message" => "Add user failed"));
                        exit;
                    }
                } catch(Exception){
                    http_response_code(500);
                    echo json_encode(array("message" => "Add user failed"));
                    exit;
                }
            }
            else{
                http_response_code(400);
                echo json_encode(array("message" => "Bad request"));
                exit;
            }
        } catch (Exception){
            http_response_code(500);
            echo json_encode(array("message" => "Add user failed"));
            exit;
        }
    }

    public function editUser(){
        try{
            parse_str(file_get_contents("php://input"), $vars);
            
            $user_id = $vars['uid'];
            $email = $vars['email'];
            $username = $vars['username'];
            $password = $vars['password'];
            $name = $vars['name'];
            $bio = $vars['bio'];
            $admin = $vars['admin'];
            $changeUname = $vars['changeUname'];

            if (isset($vars['uid']) && isset($vars['name']) && isset($vars['username']) && isset($vars['password']) && isset($vars['email']) && isset($vars['bio']) && isset($vars['admin']) && isset($vars['changeUname'])) {
                $usermodel = $this->model('UserModel');

                if ($changeUname == 'true'){
                    $usernameexist = $usermodel->checkUsernameExists($username);
        
                    if (count($usernameexist) > 0) {
                        http_response_code(409);
                        echo json_encode(array("message" => "Username already taken"));
                        exit;
                    }
                }
                
                try{
                    $rows = $usermodel->updateUserData($user_id, $name, $username, $email, $password, $bio, $admin);

                    if($rows){
                        http_response_code(200);
                        echo json_encode(array("message" => "Edit user success"));
                        exit;
                    }
                    else{
                        http_response_code(500);
                        echo json_encode(array("message" => "Edit user failed"));
                        exit;
                    }
                } catch(Exception){
                    http_response_code(500);
                    echo json_encode(array("message" => "Edit user failed"));
                    exit;
                }
            }
            else{
                http_response_code(400);
                echo json_encode(array("message" => "Bad request"));
                exit;
            }
        } catch (Exception){
            http_response_code(500);
            echo json_encode(array("message" => "Edit user failed"));
            exit;
        }
    }

    public function deleteUser(){
        try{
            
            parse_str(file_get_contents("php://input"), $vars);
            
            if (isset($vars['uid'])) {
                $usermodel = $this->model('UserModel');

                $user_id = $vars['uid'];

                $userData = $usermodel->fetchUserByID($user_id);

                if (count($userData) > 0) {
                    try{
                        $rows = $usermodel->deleteUserByID($user_id);
                        if($rows){
                            http_response_code(200);
                            echo json_encode(array("message" => "Edit user success"));
                            exit;   
                        }
                    } catch(Exception){
                        http_response_code(500);
                        echo json_encode(array("message" => "Edit user failed"));
                        exit;
                    }
                }
                else{
                    http_response_code(404);
                    echo json_encode(array("message" => "User does not exist"));
                    exit;
                }
            }
        } catch (Exception){
            http_response_code(500);
            echo json_encode(array("message" => "Delete user failed"));
            exit;
        }
    }
}

?>