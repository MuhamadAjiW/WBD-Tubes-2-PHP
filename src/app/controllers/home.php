<?php

namespace app\controllers;

use app\core\Controller;

class Home extends Controller{
    public function index(){
        $middleware = $this->middleware('TestMiddleware');
        
        $this->view('Home', ['name' => 'Hello!']);
        $usermodel = $this->model("UserModel");
    }
}

?>