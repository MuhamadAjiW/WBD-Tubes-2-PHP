<?php

namespace app\controllers;

use app\core\Controller;

class BookDetail extends Controller{
    public function index(){
        $middleware = $this->middleware('AuthMiddleware');
        $middleware->check(false, "/login");

        $this->addRel("stylesheet", "/public/css/topbar.css");
        $this->addRel("stylesheet", "/public/css/style.css");
        $this->addRel("stylesheet", "/public/css/bookdetail.css");


        $this->view('BookDetail', ['name' => 'Hello!']);
    }
}

?>