<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use Exception;

class Review extends Controller{

    public function __construct(){
        parent::__construct();
        $middleware = $this->middleware('AuthMiddleware');
        $middleware->check(false, "/error/404");
    }

    //TODO: Messages and validation
    public function getReview(){
        try{
            $reviewmodel = $this->model('ReviewModel');
            
            $user_id = $_GET['uid'];
            $book_id = $_GET['bid'];

            try{                
                $reviewData = $reviewmodel->fetchReviewByBookAndUserID($book_id, $user_id);
                if (!empty($reviewData)) {
                    header('Content-Type: application/json');
                    echo json_encode($reviewData);

                    http_response_code(200);
                } else {
                    http_response_code(404);
                }
            } catch(Exception){
                http_response_code(400);
                exit;
            }            
        } catch (Exception){
            http_response_code(500);
        }
    }

    public function addReview(){
        try{
            $reviewmodel = $this->model('ReviewModel');
            
            parse_str(file_get_contents("php://input"), $vars);

            $user_id = $vars['uid'];
            $book_id = $vars['bid'];
            $rating = $vars['rating'];
            $review = $vars['review'];

            try{                
                $reviewmodel->addReview($book_id, $user_id, $rating, $review);
            } catch(Exception){
                http_response_code(400);
                exit;
            }

            http_response_code(200);
        } catch (Exception){
            http_response_code(500);
        }
    }

    public function editReview(){
        try{
            $reviewmodel = $this->model('ReviewModel');
    
            parse_str(file_get_contents("php://input"), $vars);

            $user_id = $vars['uid'];
            $book_id = $vars['bid'];
            $rating = $vars['rating'];
            $review = $vars['review'];

            try{
                $reviewmodel->updateReview($book_id, $user_id, $review, $rating);
            } catch(Exception){
                http_response_code(400);
                exit;
            }

            http_response_code(200);
        } catch (Exception){
            http_response_code(500);
        }
    }

    public function deleteReview(){
        try{
            $reviewmodel = $this->model('ReviewModel');
    
            parse_str(file_get_contents("php://input"), $vars);

            $user_id = $vars['uid'];
            $book_id = $vars['bid'];

            try{
                $reviewmodel->deleteReview($book_id, $user_id);
            } catch(Exception){
                http_response_code(400);
                exit;
            }

            http_response_code(200);
        } catch (Exception){
            http_response_code(500);
        }
    }
}

?>