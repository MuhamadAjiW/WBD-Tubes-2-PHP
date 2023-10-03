<?php

namespace app\controllers;

use app\core\Controller;

class Search extends Controller{
    public function index(){
        // $middleware = $this->middleware('TestMiddleware');        
        $this->addRel("stylesheet", "/public/css/topbar.css");
        $this->addRel("stylesheet", "/public/css/style.css");

        $this->view('search', []);
    }
}

?>