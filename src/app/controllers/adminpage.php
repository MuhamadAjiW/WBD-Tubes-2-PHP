<?php

namespace app\controllers;

use app\core\Controller;

class AdminPage extends Controller{
    public function index(){
        $this->view('AdminPage', ['name' => 'Hello!']);
    }
}

?>