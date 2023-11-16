<?php 
namespace app\controllers;
use app\core\Controller;
use app\core\Request;
use app\core\Router;
use app\util\RESTUtil;
use app\util\SOAPUtil;
use config\RESTConfig;
use Exception;

class UserBooks extends Controller{
    private $rest;
    private $soap;

    public function __construct() {
        parent::__construct();
        $middleware = $this->middleware('AuthMiddleware');
        $middleware->check(false, "/login");

        $this->rest = new RESTUtil();
        $this->soap = new SOAPUtil();
    }

    public function index($data=[]){
        if(!isset($_GET['aid'])) Router::NotFound();

        $author_id = $_GET['aid'];
        if(!isset($_GET['aid'])){
            Router::NotFound();
        } else{
            try{
                if(!intval($_GET['aid'])){
                    Router::NotFound();
                }
                if($_GET['aid'] < 1){
                    Router::NotFound();
                }
                $author_id = $_GET['aid'];
            }catch(Exception){
                Router::NotFound();
            }
        }

        $params = [
            "user_id" => $_SESSION["user_id"],
            "author_id" => $author_id,
        ];

        $subInfo = $this->soap->sendRequest("/api/subscribe", "SubscriptionService", "getSubscriptionsOne", $params);

        if(!isset($subInfo['valid']) || !$subInfo['valid'] || !($subInfo['data'][0]['status'] === 'ACCEPTED')){
            Router::NotFound();
        }

        $bookData = $this->rest->sendRequest("/api/authors/" . $author_id ."/books", Request::GET_METHOD, null);
        $authorData = $this->rest->sendRequest("/api/authors/" . $author_id, Request::GET_METHOD, null);

        if(!isset($bookData['valid']) || !$bookData['valid'] ||
            !isset($authorData['valid']) || !$authorData['valid']
        ){
            Router::InternalError();
        }
        if(!empty($bookData['data'])){
            foreach ($bookData['data'] as $key => &$value) {
                $value['image_path'] = RESTConfig::getURLsecondary() . "/" . $value['image_path'];
                $value['release_date'] = date('Y-m-d', strtotime($value['release_date']));
            }
        }

        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/topbar.css");
        $this->view("UserBooks", ["bookData" => $bookData['data'], "authorData" => $authorData['data']]);
    }    
}
?>