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
            if (isset($_GET['bid']) && isset($_GET['uid'])) {
                $reviewmodel = $this->model('ReviewModel');
                $usermodel = $this->model("UserModel");
                $bookmodel = $this->model("BookModel");    

                $user_id = $_GET['uid'];
                $book_id = $_GET['bid'];

                $bookexist = $bookmodel->fetchBookByID($book_id);
                $userexist = $usermodel->fetchUserByID($user_id);

                if(count($bookexist) < 1){
                    http_response_code(409);
                    echo json_encode(array("message" => "Book does not exist"));
                    exit;
                }
                if(count($userexist) < 1){
                    http_response_code(409);
                    echo json_encode(array("message" => "User does not exist"));
                    exit;
                }
    
                try{                
                    $reviewData = $reviewmodel->fetchReviewByBookAndUserID($book_id, $user_id);
                    if (!empty($reviewData)) {
                        header('Content-Type: application/json');
                        
                        http_response_code(200);
                        echo json_encode($reviewData);
                        echo json_encode(array("message" => "Fetch review success"));
                        exit;
                    } else {
                        http_response_code(404);
                        echo json_encode(array("message" => "Review does not exist"));
                        exit;
                    }
                } catch(Exception){
                    http_response_code(500);
                    echo json_encode(array("message" => "Fetch review failed"));
                    exit;
                }
            }
            else{
                http_response_code(400);
                echo json_encode(array("message" => "Bad request"));
                exit;    
            }
        } catch (Exception){
            http_response_code(500);
            echo json_encode(array("message" => "Fetch review failed"));
            exit;
        }
    }

    public function addReview(){
        try{
            
            $reviewmodel = $this->model('ReviewModel');
            $usermodel = $this->model("UserModel");
            $bookmodel = $this->model("BookModel");    
                
            parse_str(file_get_contents("php://input"), $vars);
            
            $user_id = $vars['uid'];
            $book_id = $vars['bid'];
            $rating = $vars['rating'];
            $review = $vars['review'];
            if (isset($vars['bid']) && isset($vars['uid']) && isset($vars['rating']) && isset($vars['review'])) {

                $bookexist = $bookmodel->fetchBookByID($book_id);
                $userexist = $usermodel->fetchUserByID($user_id);

                if(count($bookexist) < 1){
                    http_response_code(409);
                    echo json_encode(array("message" => "Book doesn't exist"));
                    exit;
                }
                if(count($userexist) < 1){
                    http_response_code(409);
                    echo json_encode(array("message" => "User doesn't exist"));
                    exit;
                }
                
                try{                
                    $rows = $reviewmodel->addReview($book_id, $user_id, $rating, $review);

                    if ($rows){
                        http_response_code(200);
                        echo json_encode(array("message" => "Add review success", "redirect" => "/admin/reviews"));
                        exit;
                    }
                    else{
                        http_response_code(500);
                        echo json_encode(array("message" => "Add review failed"));
                        exit;
                    }

                } catch(Exception){
                    http_response_code(500);
                    echo json_encode(array("message" => "Add review failed"));
                    exit;
                }
            }
            else{                
                http_response_code(400);
                echo json_encode(array("message" => "Bad request"));
                exit;
            }
        } catch (Exception){
            http_response_code(500);
            echo json_encode(array("message" => "Add review failed"));
            exit;
        }
    }

    public function editReview(){
        try{
            $reviewmodel = $this->model('ReviewModel');
            $usermodel = $this->model("UserModel");
            $bookmodel = $this->model("BookModel");
            
            parse_str(file_get_contents("php://input"), $vars);
            
            $user_id = $vars['uid'];
            $book_id = $vars['bid'];
            $rating = $vars['rating'];
            $review = $vars['review'];
            if (isset($vars['bid']) && isset($vars['uid']) && isset($vars['rating']) && isset($vars['review'])) {
    
                $bookexist = $bookmodel->fetchBookByID($book_id);
                $userexist = $usermodel->fetchUserByID($user_id);
                $reviewexist = $reviewmodel->fetchReviewByBookAndUserID($book_id, $user_id);
    
                if(count($bookexist) < 1){
                    http_response_code(409);
                    echo json_encode(array("message" => "Book doesn't exist"));
                    exit;
                }
                if(count($userexist) < 1){
                    http_response_code(409);
                    echo json_encode(array("message" => "User doesn't exist"));
                    exit;
                }
                if(count($reviewexist) < 1){
                    http_response_code(409);
                    echo json_encode(array("message" => "Review doesn't exist"));
                    exit;
                }
    
                try{
                    $rows = $reviewmodel->updateReview($book_id, $user_id, $review, $rating);

                    if ($rows){
                        http_response_code(200);
                        echo json_encode(array("message" => "Edit review success"));
                        exit;
                    }
                    else{
                        http_response_code(500);
                        echo json_encode(array("message" => "Edit review failed"));
                        exit;    
                    }
                } catch(Exception){
                    http_response_code(500);
                    echo json_encode(array("message" => "Edit review failed"));
                    exit;
                }
    
            }

        } catch (Exception){
            http_response_code(500);
            echo json_encode(array("message" => "Edit review failed"));
            exit;
        }
    }

    public function deleteReview(){
        try{
            $reviewmodel = $this->model('ReviewModel');
            $usermodel = $this->model("UserModel");
            $bookmodel = $this->model("BookModel");
            
            parse_str(file_get_contents("php://input"), $vars);
            
            if (isset($vars['uid']) && isset($vars['bid'])) {
                $user_id = $vars['uid'];
                $book_id = $vars['bid'];

                $bookexist = $bookmodel->fetchBookByID($book_id);
                $userexist = $usermodel->fetchUserByID($user_id);
                $reviewexist = $reviewmodel->fetchReviewByBookAndUserID($book_id, $user_id);
    
                if(count($bookexist) < 1){
                    http_response_code(409);
                    echo json_encode(array("message" => "Book doesn't exist"));
                    exit;
                }
                if(count($userexist) < 1){
                    http_response_code(409);
                    echo json_encode(array("message" => "User doesn't exist"));
                    exit;
                }
                if(count($reviewexist) < 1){
                    http_response_code(409);
                    echo json_encode(array("message" => "Review doesn't exist"));
                    exit;
                }
    
                try{
                    $reviewmodel->deleteReview($book_id, $user_id);

                    http_response_code(200);
                    echo json_encode(array("message" => "Delete review success"));
                    exit;
                } catch(Exception){
                    http_response_code(500);
                    echo json_encode(array("message" => "Delete review failed"));
                    exit;
                }
            }
        } catch (Exception){
            http_response_code(500);
            echo json_encode(array("message" => "Delete review failed"));
            exit;
        }
    }
}

?>