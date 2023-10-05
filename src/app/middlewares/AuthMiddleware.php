<?php

namespace app\middlewares;

use app\core\Database;
use app\core\Router;
use app\core\Sessions;
use config\AppConfig;
use Exception;

class AuthMiddleware{
    public function check($redirect=null){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user_id'])) {
            if(isset($_COOKIE['remember_session_id'])){
                // TODO: CRITICAL ini crime separah parahnya crime, harusnya ini dijalanin di backround task per satuan waktu, bukan per request
                // Karena tubes ini sebenernya gak mencakup ini jadi yaudah lah ya
                Sessions::cleanExpiredSessions();

                $sessioninfo = Sessions::getSessionInfo($_COOKIE['remember_session_id']);
                if(!empty($sessioninfo)){
                    $_SESSION['logged_in'] = true;
                    $_SESSION['user_id'] = $sessioninfo['user_id'];
                    $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                    $_SESSION['permissions'] = $sessioninfo['admin'];
                    $_SESSION['last_ping'] = time();

                    $cookie_name = "remember_session_id";
                    $cookie_value = session_id();
                    $cookie_time = $_SESSION['last_ping'] + AppConfig::REMEMBER_THRESHOLD;

                    setcookie($cookie_name, $cookie_value, $cookie_time, "/", AppConfig::DOMAIN_NAME, false, true);
                        
                    try{
                        Sessions::addSessions($cookie_value, $_SESSION['user_id'], $_SESSION['permissions'], true, $cookie_time);
                    } catch(Exception){
                        Sessions::extendSessions($cookie_value, $cookie_time);
                    }
                }
                else{
                    session_unset();
                    session_destroy();
                    setcookie("session_id", "", time() - 3600, "/", AppConfig::DOMAIN_NAME);
                    if(isset($redirect)){
                        Router::redirect($redirect);
                    }
                }
            }
            else{
                if(isset($redirect)){
                    Router::redirect($redirect);
                }
            }
        } else if (time() - $_SESSION['last_ping'] > AppConfig::INACTIVITY_THRESHOLD) {
            session_unset();
            session_destroy();
            setcookie("session_id", "", time() - 3600, "/", AppConfig::DOMAIN_NAME);
            if(isset($redirect)){
                Router::redirect($redirect);
            }
        }
        else{
            $_SESSION['last_ping'] = time();
        }
    }
}


?>