<?php

namespace app\controllers;

use app\core\Controller;

class AdminUsers extends Controller{
    public function index(){
        $this->view('AdminUsers', ['name' => 'Hello!']);
    }
}

?>