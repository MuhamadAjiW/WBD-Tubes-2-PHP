<?php

namespace app\controllers;

use app\core\Controller;

class AdminUsers extends Controller{
    public function index(){
        $usermodel = $this->model('UserModel');
        $userdata = $usermodel->fetchAllUsers();

        $this->view('AdminUsers', ['userdata' => $userdata]);
    }
}

?>