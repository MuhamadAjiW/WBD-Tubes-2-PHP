<?php

namespace app\core;

use config\AppConfig;
use Exception;

class Router{
    private $routes = [];

    private function validityCheck($route, $methods, $handler){
        if(is_null($methods)){
            throw new Exception("Method cannot be null");
        }
        if(strpos($route, ' ') !== false){
            throw new Exception("Route cannot contain whitespaces");
        }
        if(strpos($route, '?') !== false){
            throw new Exception("Route cannot contain question marks");
        }
        if(isset($this->routes[$route])){
            throw new Exception("Route is defined twice: " . $route);
        }
    }

    public function handleRoute(){
        $url = Request::parseUrl();
        $method = Request::getMethod();
        
        if ($this->isFileRequest($url, $method)){
            $this->handleFileRequest($url);
        }

        if(isset($this->routes[$url])){
            if(isset($this->routes[$url][$method])){
                $handler = $this->routes[$url][$method];
                $handler_class = str_replace('/', '\\', $handler[0]);
                $handler_func = $handler[1];
                
                $instance = new $handler_class;
                $instance->$handler_func();
            }
            else{
                header("HTTP/1.0 405 Not Allowed");
                //TODO: should be 405 method not allowed
                $handler_class = 'app\\controllers\\Error404';
                $handler_func = 'index';
        
                $instance = new $handler_class;
                call_user_func_array([$instance, $handler_func], []);
            }
        } else{
            error_log("Not found: " . $url);
            $handler_class = 'app\\controllers\\Error404';
            $handler_func = 'index';
    
            $instance = new $handler_class;
            call_user_func_array([$instance, $handler_func], []);
        }

        return $url;
    }

    public function handleFileRequest($route){
        $content_type = mime_content_type($route);
        header("Content-Type: $content_type");
        readfile($route);
    }

    public function isFileRequest($route, $method){
        $folder = explode('/', $route)[0];
        
        if($method !== 'GET'){
            return false;
        }
        if(!in_array($route, AppConfig::PUBLIC_FOLDERS)){
            return false;
        }
        if(is_file($route)){
            return true;
        }
        return false;
    }


    public function addRoute($route, $handler_class, $handler_func = 'index', $methods = ['GET']){
        $this->validityCheck($route, $methods, $handler_class);
        foreach($methods as $method){
            $this->routes[$route][$method] = [$handler_class, $handler_func];
        }
    }

    public function addGet($route, $handler_class, $handler_func = 'index'){
        $this->validityCheck($route, ['GET'], $handler_class);
        $this->routes[$route]['GET'] = [$handler_class, $handler_func];
    }

    public function addPost($route, $handler_class, $handler_func){
        $this->validityCheck($route, ['POST'], $handler_class);
        $this->routes[$route]['POST'] = [$handler_class, $handler_func];
    }

    public function addPut($route, $handler_class, $handler_func){
        $this->validityCheck($route, ['PUT'], $handler_class);
        $this->routes[$route]['PUT'] = [$handler_class, $handler_func];
    }

    public function addDelete($route, $handler_class, $handler_func){
        $this->validityCheck($route, ['DELETE'], $handler_class);
        $this->routes[$route]['DELETE'] = [$handler_class, $handler_func];
    }

    public function addPatch($route, $handler_class, $handler_func){
        $this->validityCheck($route, ['PATCH'], $handler_class);
        $this->routes[$route]['PATCH'] = [$handler_class, $handler_func];
    }

    public function addOptions($route, $handler_class, $handler_func){
        $this->validityCheck($route, ['OPTIONS'], $handler_class);
        $this->routes[$route]['OPTIONS'] = [$handler_class, $handler_func];
    }
}

?>