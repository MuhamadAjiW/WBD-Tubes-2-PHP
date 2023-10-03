<?php

namespace app\controllers;

use app\core\Controller;

class AdminBooks extends Controller{
    public function index(){
        $bookmodel = $this->model('BookModel');
        $bookdata = $bookmodel->fetchAllBooksForAdmin();

        $this->view('AdminBooks', ['bookdata' => $bookdata]);
    }

    public function fetch() {

    }
}

?>