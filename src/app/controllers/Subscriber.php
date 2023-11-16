<?php 
namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Router;
use app\core\Sessions;
use app\util\RESTUtil;
use app\util\SOAPUtil;
use config\AppConfig;
use Exception;
use util;

class Subscriber extends Controller{
    private $rest;
    private $soap;

    public function __construct() {
        parent::__construct();
        $this->rest = new RESTUtil();
        $this->soap = new SOAPUtil();
    }

    public function index($data=[]){
        // $authorBook = $this->model("BookModel");
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/topbar.css");
        $data = $this->rest->sendRequest("/api/authors", Request::GET_METHOD, null);
        $this->view("Subscriber", $data);
    }
    
    public function subscriber(){
        if(isset($_POST["subscribe_button"])){
            $user = $_SESSION['user_id'];
            $authorSubscribe = $_POST["user_number"];
            $author = $this->model("UserModel");
            $author = $author->fetchUserIDByUsername($authorSubscribe);
            $data = ["user_id" => $user, "author_id" => $author['user_id']];
            $this->soap->sendRequest("api/subscribe", "SubcriptionService", "subscribeRequest", $data);
            
        }
        
    }
}
?>