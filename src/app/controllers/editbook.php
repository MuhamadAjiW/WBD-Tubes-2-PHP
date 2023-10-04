<?php

namespace app\controllers;

use app\core\Controller;

class EditBook extends Controller{
    public function index(){
        $this->view('EditBook', ['name' => 'Hello!']);
    }
}

?>