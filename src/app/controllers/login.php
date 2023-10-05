<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use app\core\Sessions;
use config\AppConfig;
use Exception;

class Login extends Controller{
    public function index(){
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/auth.css");
        $this->addRel("stylesheet", "/public/css/topbar.css");

        $this->view('Login');
    }
    
    public function login(){
        if(isset($_POST['login'])){
            $userLogin = $this->model("UserModel");
            $email = $_POST["email"];
            $password = $_POST["password"];
            $user = $userLogin->login($email,$password);
            if($user==null){
                $_SESSION['error'] = "Invalid username or password";
                $this->index();
            }
            else{
                if (password_verify($password, $user['password'])) {
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_id'] = $user['user_id'];
                    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['permissions'] = $user['admin'];
                    $_SESSION['last_ping'] = time();

                    if(isset($_POST['remember-me'])){
                        $cookie_name = "remember_session_id";
                        $cookie_value = session_id();
                        $cookie_time = $_SESSION['last_ping'] + AppConfig::REMEMBER_THRESHOLD;
                        setcookie($cookie_name, $cookie_value, $cookie_time, "/", AppConfig::DOMAIN_NAME, false, true);
                        
                        // TODO: CRITICAL ini crime separah parahnya crime, harusnya ini dijalanin di backround task per satuan waktu, bukan per request
                        // Karena tubes ini sebenernya gak mencakup ini jadi yaudah lah ya
                        Sessions::cleanExpiredSessions();
                        
                        try{
                            Sessions::addSessions($cookie_value, $_SESSION['user_id'], $_SESSION['permissions'], true, $cookie_time);
                        } catch(Exception){
                            Sessions::extendSessions($cookie_value, $cookie_time);
                        }
                    }
                    // Router::redirect('/home');
                } else {
                    $_SESSION['error'] = "Invalid username or password";
                    $this->index();
                }
            }
        }
    }
}

?>