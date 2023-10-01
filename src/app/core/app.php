<?php

class App{
    private $controller = 'Error404';
    private $method = 'index';
    private $params = [];

    private $database;

    public function __construct(){
        echo "Halo halo ini app<br>";
        require_once 'app/controllers/' . $this->controller . '.php';        
        $this->handleRoute();
    }
    
    public function handleRoute(){
        $url = $this->parseUrl();
        
        if($url){
            if($url[0] === ''){
                $this->controller = 'Home';
                require_once 'app/controllers/' . $this->controller . '.php';
            }
            else if(file_exists('app/controllers/' . $url[0] . '.php')){
                $this->controller = $url[0];
                require_once 'app/controllers/' . $this->controller . '.php';
            }
            
            $this->controller = new $this->controller;
            $this->params = array_values($url);
            unset($url[0]);

            if(isset($url[1])){
                if(method_exists($this->controller, $url[1])){
                    $this->method = $url[1];
                    unset($url[1]);
                }
            }
        }
    
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    public function parseUrl(){
        if(isset($_SERVER['REQUEST_URI'])){
            $url = trim($_SERVER['REQUEST_URI'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}
?>