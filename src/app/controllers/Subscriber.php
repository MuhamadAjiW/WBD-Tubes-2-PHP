<?php 
namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\core\Router;
use app\util\RESTUtil;
use app\util\SOAPUtil;

class Subscriber extends Controller{
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
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/topbar.css");
        $data = $this->rest->sendRequest("/api/authors", Request::GET_METHOD, null);

        $params = [
            "user_id" => $_SESSION["user_id"],
        ];
        $subInfo = $this->soap->sendRequest("/api/subscribe", "SubscriptionService", "getSubscriptionsByUser", $params);
        
        var_dump($subInfo);
        echo "<br><br><br>";
        // var_dump($data);
        if(isset($subInfo['data'])){
            foreach ($data['data'] as &$authorData) {
                foreach ($subInfo['data'] as $subsData) {
                    if ($authorData['author_id'] == $subsData['author_id']) {
                        $authorData['status'] = $subsData['status'];
                    }
                }
            }
        }

        // echo "<br><br><br>";
        // var_dump($data);

        $this->view("Subscriber", $data);
    }
    
    public function subscriber(){
        if(isset($_POST["subscribe_button"])){
            $user = $_SESSION['user_id'];
            $author_id = $_POST["author_id"];
            $data = ["user_id" => $user, "author_id" => $author_id];
            $this->soap->sendRequest("/api/subscribe", "SubcriptionService", "subscribeRequest", $data);
            
            Router::redirect("/subscribe");
        }
        
    }
}
?>