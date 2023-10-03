<?php

namespace app\controllers;

use app\core\Controller;

class AdminReviews extends Controller{
    public function index(){
        $reviewmodel = $this->model('ReviewModel');
        $reviewdata = $reviewmodel->fetchReviewsAll();

        $this->view('AdminReviews', ['reviewdata' => $reviewdata]);
    }
}

?>