<?php

namespace app\controllers;

use app\core\Controller;

class AdminPage extends Controller{
    public function index(){
        $middleware = $this->middleware('AuthMiddleware');
        $middleware->check(false, "/error/404");

        $this->addRel("stylesheet", "/public/css/topbar.css");
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/bookdetail.css");
        
        $this->view('AdminPage', ['inadminpage' => true]);
    }
}

?>