<?php 
namespace app\controllers;
use app\core\Controller;
use app\core\Router;
use app\core\Sessions;
use config\AppConfig;
use Exception;
use util;

class Subscriber extends Controller{
    public function index($data=[]){
        $authorBook = $this->model("BookModel");
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/topbar.css");
        $requestRest = $this->model("RESTUtil");
        $data = $requestRest->sendRequest("/api/authors", Request::GET_METHOD);
        $this->view("Subscriber", $data);
    }
    
    public function subscriber(){
        if(isset($_POST["subscribe_button"])){
            $requestSoap = $this->model("SOAPUtil");
            $user = $_SESSION['user_id'];
            $authorSubscribe = $_POST["user_number"];
            $author = $this->model("UserModel");
            $author = $author->fetchUserIDByUsername($authorSubscribe);
            $data = ["user_id" => $user, "author_id" => $author['user_id']];
            $requestSoap->sendRequest("api/subscribe", "SubcriptionService", "subscribeRequest", $data);
            
        }
        
    }
}
?>