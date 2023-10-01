<?php

namespace app\core;

class Controller{
    public function view($view, $data = []){
        extract($data);
        require_once 'app/views/' . $view . '.php';
    }

    public function model($model){
        $class = 'app\\models\\' . $model;
        return new $class;
    }

    public function middleware($middleware){
        $class = 'app\\middlewares\\' . $middleware;
        return new $class;
    }
}

?>