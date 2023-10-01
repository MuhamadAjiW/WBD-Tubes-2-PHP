<?php

class Controller{
    public function view($view, $args = []){
        if(file_exists('app/views/' . $view . '.php')){
            require_once 'app/views/' . $view . '.php';
        } else{
            die('view does not exist');
        }
    }
}

?>