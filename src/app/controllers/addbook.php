<?php

namespace app\controllers;

use app\core\Controller;

class AddBook extends Controller{
    public function index(){
        $this->view('AddBook', ['name' => 'Hello!']);
    }
}

?>