<?php 
namespace app\controllers;
use app\core\Controller;
use app\core\Router;
use app\core\Sessions;
use config\AppConfig;
use Exception;

class Subscriber extends Controller{
    public function index($data=[]){
        $authorBook = $this->model("BookModel");
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/topbar.css");
        $data = $authorBook->getAuthor();
        $this->view('Subscriber', $data);
    }
    
    public function subscriber(){
        echo"AWW";
    }
}
?>