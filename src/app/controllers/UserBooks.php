<?php 
namespace app\controllers;
use app\core\Controller;
use app\core\Router;
use app\core\Sessions;
use config\AppConfig;
use Exception;
use util;

class UserBooks extends Controller{
    public function index($data=[]){
        $infoBook = $this->model("BookModel");
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/topbar.css");
        $author = $_SESSION["user_id"];
        $authorName = $this->model("UserModel");
        $this->view("UserBooks", $data);

        
    }
    
    public function userbook(){
    
        
    }
}
?>