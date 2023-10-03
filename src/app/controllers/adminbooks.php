<?php

namespace app\controllers;

use app\core\Controller;

class AdminBooks extends Controller{
    public function index(){
        $this->view('AdminBooks', ['name' => 'Hello!']);
    }
}

?>