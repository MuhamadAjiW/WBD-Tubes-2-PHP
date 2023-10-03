<?php

namespace app\controllers;

use app\core\Controller;

class Error404 extends Controller{
    public function index(){
        header("HTTP/1.0 404 Not Found");
        $this->view('Error404', ['name' => 'hai!']);
    }
}

?>