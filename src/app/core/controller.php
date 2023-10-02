<?php

namespace app\core;

use config\AppConfig;

class Controller{
    private $rel = "";
    private $use_topbar = true;

    public function view($view, $data = []){
        $data[AppConfig::REL_DATA] = $this->rel;
        if($this->use_topbar){
            $data[AppConfig::TOP_BAR] = file_get_contents(AppConfig::TOP_BAR_PATH);
        } else{
            $data[AppConfig::TOP_BAR] = "";
        }
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

    public function addRel($type, $path){
        $this->rel = $this->rel . "<link rel=" . "\"" . $type . "\" href=" . "\"" . $path . "\">";
    }

    public function topbar_off(){
        $this->use_topbar = true;
    }
    public function topbar_on(){
        $this->use_topbar = false;
    }
}

?>