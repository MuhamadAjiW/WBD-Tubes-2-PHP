<?php

namespace app\controllers;

use app\core\Controller;

class AdminReviews extends Controller{
    public function index(){
        $this->view('AdminReviews', ['name' => 'Hello!']);
    }
}

?>