<?php

namespace app\core;

use Exception;

class Request{
    public const GET_METHOD = "GET";
    public const POST_METHOD = "POST";
    public const PUT_METHOD = "PUT";
    public const DELETE_METHOD = "DELETE";
    public const PATCH_METHOD = "PATCH";

    public static function parseUrl(){
        if(isset($_SERVER['REQUEST_URI'])){
            $url = explode('?', $_SERVER['REQUEST_URI']);
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