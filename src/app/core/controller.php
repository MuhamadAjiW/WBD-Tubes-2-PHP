<?php

class Controller{
    public function view($view, $args = []){
        require_once 'app/views/' . $view . '.php';
        return new $view($args);
    }
}

?>