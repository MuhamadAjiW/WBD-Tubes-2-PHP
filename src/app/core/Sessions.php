<?php

namespace app\core;

use app\core\Database;
use config\AppConfig;

class Sessions{
    public static function cleanExpiredSessions(){
        $database = new Database();
        $currenttime = time();
        $database->query("DELETE FROM sessions WHERE expire_date < :currenttime");
        $database->bind('currenttime', $currenttime);
        $database->execute();
    }

    public static function addSessions($session_id, $user_id, $admin, $loggedin, $expire_date){
        $database = new Database();

        $query = "INSERT INTO sessions (session_id, user_id, admin, loggedin, expire_date)
        VALUES (:session_id, :user_id, :admin, :loggedin, :expire_date)";

        $database->query($query);
        $database->bind('session_id', $session_id);
        $database->bind('user_id', $user_id);
        $database->bind('admin', $admin);
        $database->bind('loggedin', $loggedin);
        $database->bind('expire_date', $expire_date);

        $database->execute();
    }

    public static function extendSessions($session_id, $expire_date){
        $database = new Database();

        $query = "UPDATE sessions SET expire_date = :expire_date
        WHERE session_id = :session_id";

        $database->query($query);
        $database->bind('session_id', $session_id);
        $database->bind('expire_date', $expire_date);

        $database->execute();
    }

    public static function getSessionInfo($session_id){
        $database = new Database();

        $query = "SELECT * FROM sessions WHERE session_id = :session_id";

        $database->query($query);
        $database->bind('session_id', $session_id);

        return $database->fetch();
    }

    public static function logout($redirect = null){
        session_unset();
        session_destroy();
        setcookie("session_id", "", time() - 3600, "/", AppConfig::DOMAIN_NAME);
        if(isset($redirect)){
            Router::redirect($redirect);
        }
    }
}

?>