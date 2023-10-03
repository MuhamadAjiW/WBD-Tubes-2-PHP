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
    }
    
    public function handleRoute(){
        $url = Request::parseUrl();
        $method = Request::getMethod();
                
        if(isset($this->routes[$url])){
            if(isset($this->routes[$url][$method])){
                $handler = $this->routes[$url][$method];
                
                if($handler[1] == AppConfig::REDIRECT){
                    $dest = $handler[0];
                    header("HTTP/1.1 301 Moved Permanently");
                    $this->redirect($dest);
                }
                else{
                    $handler_class = str_replace('/', '\\', $handler[0]);
                    $handler_func = $handler[1];
                    
                    $instance = new $handler_class;
                    $instance->$handler_func();
                }
            }
            else{
                //TODO: should be 405 method not allowed
                self::NotFound();
            }
        } else{
            self::NotFound();
        }
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

    public function redirect_permanent($route, $dest){
        $this->addRoute($route, $dest, AppConfig::REDIRECT, ['GET']);
    }

    public static function redirect($dest){
        header("Location: $dest");
        exit;
    }

    public static function NotFound(){
        $handler_class = 'app\\controllers\\Error';
        $handler_func = 'not_found';
    
        $instance = new $handler_class;
        call_user_func_array([$instance, $handler_func], []);
    }

    public static function NotImplemented(){
        $handler_class = 'app\\controllers\\Error';
        $handler_func = 'not_implemented';
    
        $instance = new $handler_class;
        call_user_func_array([$instance, $handler_func], []);
    }
}

?>