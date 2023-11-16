<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Router;
use app\util\RESTUtil;
use app\util\SOAPUtil;
use config\RESTConfig;
use Exception;

class BookDetailPremium extends Controller{
    private $rest;
    private $soap;

    public function __construct() {
        parent::__construct();
        $middleware = $this->middleware('AuthMiddleware');
        $middleware->check(false, "/login");

        $this->rest = new RESTUtil();
        $this->soap = new SOAPUtil();
    }

    public function index(){
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

        $bookData = $this->rest->sendRequest("/api/books/" . $book_id, Request::GET_METHOD, null);
        if(!isset($bookData['valid']) || !$bookData['valid']){
            Router::InternalError();
        }
        
        $params = [
            "user_id" => $_SESSION["user_id"],
            "author_id" => $bookData["data"]['author_id'],
        ];
        
        $subInfo = $this->soap->sendRequest("/api/subscribe", "SubscriptionService", "getSubscriptionsOne", $params);
        
        if(!isset($subInfo['valid']) || !$subInfo['valid'] || !($subInfo['data'][0]['status'] === 'ACCEPTED')){
            Router::NotFound();
        }
        
        $authorData = $this->rest->sendRequest("/api/authors/" . $bookData["data"]['author_id'], Request::GET_METHOD, null);
        
        if(!isset($authorData['valid']) || !$authorData['valid']){
            Router::InternalError();
        }
        
        $bookData['data']['image_path'] = RESTConfig::getURLsecondary() . "/" . $bookData['data']['image_path'];
        $bookData['data']['audio_path'] = RESTConfig::getURLsecondary() . "/" . $bookData['data']['audio_path'];
        $bookData['data']['release_date'] = date('Y-m-d', strtotime($bookData['data']['release_date']));

        $this->addRel("stylesheet", "/public/css/topbar.css");
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/bookdetail.css");
        $this->view('BookDetailPremium', ['book_data' => $bookData["data"], 'author_data' => $authorData["data"]]);
    }
}

?>

