<?php

namespace app\controllers;

use app\core\Controller;

class Error404 extends Controller{
    public function index(){
        $this->view('Error404');
    }
}

?>