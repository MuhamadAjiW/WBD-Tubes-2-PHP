<?php

namespace app\core;

use config\AppConfig;

class Controller{
    private $rel = "";
    private $icon = "<link rel=\"icon\" href=\"storage/assets/logo.svg\" sizes=\"any\" type=\"image/svg+xml\">";
    private $topbar;
    private $footer;

    public function __construct(){
        $this->topbar = AppConfig::TOP_BAR_PATH;
        $this->footer = AppConfig::FOOTER_PATH;
    }

    public function view($view, $data = []){
        $data[AppConfig::REL_DATA] = $this->rel;

        $this->rel = $this->rel . $this->icon;
        $data[AppConfig::TOP_BAR] = $this->topbar;
        $data[AppConfig::FOOTER] = $this->footer;

        extract($data);
        require_once '../app/views/' . $view . '.php';
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

    public function setIcon($path){
        $icon = "<link rel=\"icon\" href=\"" . $path . "\" sizes=\"any\" type=\"image/svg+xml\">";
    }
    public function setTopBar($path){
        $this->topbar = $path;
    }
    public function setFooter($path){
        $this->footer = $path;
    }
}

?>