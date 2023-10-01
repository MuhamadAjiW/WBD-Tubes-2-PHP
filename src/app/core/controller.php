<?php

namespace app\core;

class Controller{
    public function view($view, $data = []){
        extract($data);
        require_once 'app/views/' . $view . '.php';
    }
}

?>