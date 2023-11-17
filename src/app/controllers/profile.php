<?php

namespace app\controllers;
use app\core\Router;
use app\core\Controller;
use app\core\Request;
use app\models\UserModel;
use app\util\RESTUtil;
use Exception;

class Profile extends Controller{
    private $rest;

    public function __construct() {
        parent::__construct();
        $middleware = $this->middleware('AuthMiddleware');
        $middleware->check(false, "/login");

        $this->rest = new RESTUtil();
    }

    public function index(){
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/auth.css");
        $this->addRel("stylesheet", "/public/css/profile.css");
        $this->addRel("stylesheet", "/public/css/topbar.css");
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
            Router::redirect('/login');
        }
       
}
    public function profile(){
        if(isset($_SESSION['user_id']) && isset($_POST['username']) && isset($_POST['name']) && isset($_POST['email']) && isset($_POST['bio']) && isset($_POST['changeUname'])){
            $usermodel = $this->model("UserModel");

            $user_id = $_SESSION['user_id'];
            $username = $_POST['username'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $bio = $_POST['bio'];
            $changeUname = $_POST['changeUname'];

            $getResponse = $this->rest->sendRequest("/api/authors/" . $username, Request::GET_METHOD, null);

            if ($changeUname == 'true'){
                $usernameexist = $usermodel->checkUsernameExists($username);
    
                if (count($usernameexist) > 0) {
                    http_response_code(409);
                    echo json_encode(array("message" => "Username already taken"));
                    exit;
                }
            }

            try{
                if(isset($getResponse['valid']) && $getResponse['valid']){
                    $author_id = $getResponse['data']['author_id'];
                    $response = $this->rest->sendRequest("/api/authors/" . $author_id, Request::PATCH_METHOD, json_encode(
                        array(
                            "author_id" => $author_id,
                            "username" => $username,
                            "name" => $name,
                            "email" => $email,
                            "bio" => $bio
                        )
                    ));
                }

                $rows = $usermodel->updateUserData3($user_id, $name, $username, $email, $bio);
                if($rows){
                    http_response_code(200);
                    echo json_encode(array("message" => "Edit profile success"));
                    Router::redirect('/profile');
                    exit;
                }
                else{
                    http_response_code(500);
                    echo json_encode(array("message" => "Edit profile failed"));
                    exit;
                }
            } catch (Exception){
                http_response_code(500);
                echo json_encode(array("message" => "Edit profile failed"));
                exit;
            }
        }
        else{
            http_response_code(400);
            echo json_encode(array("message" => "Bad request"));
            exit;
        }
    }
}

?>