<?php

namespace app\controllers;

use app\core\Controller;

class AdminReviews extends Controller{
    public function index(){
        $reviewmodel = $this->model('ReviewModel');
        $reviewdata = $reviewmodel->fetchReviewsAll();

        $this->view('AdminReviews', ['reviewdata' => $reviewdata]);
    }

    public function delete() {
        if (isset($_POST['user_id']) && isset($_POST['book_id'])) {
            $reviewmodel = $this->model("ReviewModel");

            $rows = $reviewmodel->deleteReview($_POST['book_id'], $_POST['user_id']);

            if ($rows) {
                http_response_code(200);
                echo json_encode(array("message" => "Delete review success"));

            } else {
                http_response_code(500);
                echo json_encode(array("message" => "Delete review failed"));
            }
        }
        else {
            http_response_code(400);
            echo json_encode(array("message" => "Bad request."));
        }
    }
}

?>