<?php

namespace app\core;

use Exception;

class Request{
    public static function parseUrl(){
        if(isset($_SERVER['REQUEST_URI'])){
            $url = '/' . trim($_SERVER['REQUEST_URI'], '/');
            $url = explode('?', $url);
            return $url[0];
        }
        else{
            throw new Exception("Nothing is requested");
        }
    }

    public static function getMethod(){
        return $_SERVER['REQUEST_METHOD'];
    }
}

?>