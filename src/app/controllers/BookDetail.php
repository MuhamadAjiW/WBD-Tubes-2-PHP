<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use Exception;

class BookDetail extends Controller{
    public function index(){
        $middleware = $this->middleware('AuthMiddleware');
        $middleware->check(false, "/login");

        $this->addRel("stylesheet", "/public/css/topbar.css");
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/bookdetail.css");

        if(!isset($_GET['bid'])) Router::NotFound();

        $book_id = $_GET['bid'];
        if(!isset($_GET['bid'])){
            Router::NotFound();
        } else{
            try{
                if(!intval($_GET['bid'])){
                    Router::NotFound();
                }
                if($_GET['bid'] < 1){
                    Router::NotFound();
                }
                $book_id = $_GET['bid'];
            }catch(Exception){
                Router::NotFound();
            }
        }

        $bookmodel = $this->model('BookModel');
        $usermodel = $this->model('UserModel');
        $reviewmodel = $this->model('ReviewModel');

        $book_data = $bookmodel->fetchBookByID($book_id);
        
        $author_id = $book_data['author_id'];
        $author_data = $usermodel->fetchUserByID($author_id);
        unset($author_data['password']);
        
        $reviews = $reviewmodel->fetchReviewData($book_id);
        $review_data = $reviews[0];
        $review_count = $reviews[1];

        $this->view('BookDetail', ['book_data' => $book_data, 'author_data' => $author_data, 'review_data' => $review_data, 'review_count' => $review_count]);
    }

    public function updateReviews(){
        $reviewmodel = $this->model('ReviewModel');

        $book_id = $_GET['bid'];
        $offset = $_GET['offset'];

        $reviews = $reviewmodel->fetchReviewData($book_id, $offset)[0];

        foreach ($reviews as $review) {
            extract($review);
            include "../app/components/ReviewEntry.php";
        }
    }
}

?>