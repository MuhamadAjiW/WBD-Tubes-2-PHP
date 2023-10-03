<?php

namespace app\controllers;

use app\core\Controller;

class Home extends Controller{
    public function index(){
        // $middleware = $this->middleware('TestMiddleware');        
        $this->addRel("stylesheet", "/public/css/topbar.css");
        $this->addRel("stylesheet", "/public/css/style.css");
        $this->addRel("stylesheet", "/public/css/home.css");
        $this->view('Home', []);
    }
}

?>