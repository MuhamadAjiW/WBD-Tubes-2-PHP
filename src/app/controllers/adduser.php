<?php

namespace app\controllers;

use app\core\Controller;

class AddUser extends Controller{
    public function index(){
        $this->view('AddUser', ['name' => 'Hello!']);
    }
}

?>