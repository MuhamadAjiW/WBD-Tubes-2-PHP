<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use Exception;

class BookDetail extends Controller{
    public function index(){
        $middleware = $this->middleware('AuthMiddleware');
        $middleware->check(false, "/login");

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


        $allreviews = $reviewmodel->fetchReviewByBookID($book_id);
        $rating_avg = 0;

        $total_ratings = 0;
        $count = count($allreviews);
        foreach ($allreviews as $review) {
            $total_ratings += $review['rating'];
        }
        if ($count > 0) {
            $rating_avg = $total_ratings / $count;
        } else {
            $rating_avg = 0;
        }        
        $rating_avg = number_format($rating_avg, 2);        

        $self_review = $reviewmodel->fetchReviewByBookAndUserID($book_id, $_SESSION['user_id']);
        
        $this->addRel("stylesheet", "/public/css/topbar.css");
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/bookdetail.css");
        $this->view('BookDetail', ['book_data' => $book_data, 'author_data' => $author_data, 'review_data' => $review_data, 'review_count' => $review_count, 'self_review' => $self_review, 'rating_avg' => $rating_avg]);
    }

    public function moreReviews(){
        try{
            $reviewmodel = $this->model('ReviewModel');
    
            $book_id = $_GET['bid'];
            if(!isset($_GET['offset'])){
                $offset = 1;
            } else{
                try{
                    if(!intval($_GET['offset'])){
                        http_response_code(400);
                    }
                    if($_GET['offset'] < 1){
                        http_response_code(400);
                    }
                    $offset = $_GET['offset'];
                }catch(Exception){
                    http_response_code(400);
                }
            }
    
            $reviews = $reviewmodel->fetchReviewData($book_id, $offset)[0];
    
            foreach ($reviews as $review) {
                extract($review);
                include "../app/components/ReviewEntry.php";
            }
            http_response_code(200);
            
        } catch (Exception){
            http_response_code(500);
        }
    }
}

?>