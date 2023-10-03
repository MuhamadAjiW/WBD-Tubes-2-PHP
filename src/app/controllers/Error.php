<?php

namespace app\controllers;

use app\core\Controller;

class Error extends Controller{
    public function not_found(){
        header("HTTP/1.0 404 Not Found");
        $this->view('errors/Error404', ['message' => 'sori kamu nyasar']);
    }

    public function not_implemented(){
        header("HTTP/1.0 501 Not Found");
        $this->view('errors/Error501', ['message' => 'sori page ini belom diimplement']);
    }
}

?>