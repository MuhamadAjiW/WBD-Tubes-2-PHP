<?php

namespace app\controllers;

use app\core\Controller;

class Search extends Controller{
    public function index(){
        // $middleware = $this->middleware('TestMiddleware');        
        $this->addRel("stylesheet", "/public/css/topbar.css");
        $this->addRel("stylesheet", "/public/css/style.css");

        $this->view('search', []);
    }

    public function serve(){
        $bookmodel = $this->model("BookModel");

        if(isset($_POST['q'])){
            $query = $_POST['q'];
            if($query === '') {
                json_encode(["error" => "No query"]);
            }
            else{                
                $results = $bookmodel->fetchBooksBySimpleSearch($query);
                if(!empty($results)){
                    echo json_encode($results);
                } else{
                    echo json_encode(["error" => "No results"]);
                }
            }
        }
        else{
            echo json_encode(["error" => "No query"]);
        }
    }
}

?>