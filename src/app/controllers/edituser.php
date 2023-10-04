<?php

namespace app\controllers;

use app\core\Controller;

class EditUser extends Controller{
    public function index(){
        $this->view('EditUser', ['name' => 'Hello!']);
    }
}

?>