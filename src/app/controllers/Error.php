<?php

namespace app\controllers;

use app\core\Controller;

class Error extends Controller{
    public function not_found(){
        header("HTTP/1.0 404 Not Found");
        $this->view('Error404', ['name' => 'hai!']);
    }

    public function not_implemented(){
        header("HTTP/1.0 501 Not Found");
        $this->view('Error501', ['name' => 'sori']);
    }
}

?>