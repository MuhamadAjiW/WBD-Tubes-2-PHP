<?php

namespace app\controllers;

use app\core\Controller;

class BookDetail extends Controller{
    public function index(){
        $this->view('BookDetail', ['name' => 'Hello!']);
    }
}

?>