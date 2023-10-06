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

        $self_review = $reviewmodel->fetchReviewByBookAndUserID($book_id, $_SESSION['user_id']);

        $this->view('BookDetail', ['book_data' => $book_data, 'author_data' => $author_data, 'review_data' => $review_data, 'review_count' => $review_count, 'self_review' => $self_review]);
    }

    public function moreReviews(){
        try{
            $reviewmodel = $this->model('ReviewModel');
    
            $book_id = $_GET['bid'];
            $offset = $_GET['offset'];
    
            $reviews = $reviewmodel->fetchReviewData($book_id, $offset)[0];
    
            foreach ($reviews as $review) {
                extract($review);
                include "../app/components/ReviewEntry.php";
            }
        } catch (Exception){
            http_response_code(500);
        }
    }

    public function addReview(){
        try{
            $reviewmodel = $this->model('ReviewModel');
            
            parse_str(file_get_contents("php://input"), $vars);

            $book_id = $vars['bid'];
            $rating = $vars['rating'];
            $review = $vars['review'];
            $user_id = $_SESSION['user_id'];

            $reviewmodel->addReview($book_id, $user_id, $rating, $review);

            http_response_code(200);
        } catch (Exception){
            http_response_code(500);
        }
    }

    public function editReview(){
        try{
            $reviewmodel = $this->model('ReviewModel');
    
            parse_str(file_get_contents("php://input"), $vars);

            $book_id = $vars['bid'];
            $rating = $vars['rating'];
            $review = $vars['review'];
            $user_id = $_SESSION['user_id'];

            $reviewmodel->updateReview($book_id, $user_id, $review, $rating);

            http_response_code(200);
        } catch (Exception){
            http_response_code(500);
        }
    }

    public function deleteReview(){
        try{
            $reviewmodel = $this->model('ReviewModel');
    
            parse_str(file_get_contents("php://input"), $vars);

            $book_id = $vars['bid'];
            $user_id = $_SESSION['user_id'];

            $reviewmodel->deleteReview($book_id, $user_id);

            http_response_code(200);
        } catch (Exception){
            http_response_code(500);
        }
    }
}

?>