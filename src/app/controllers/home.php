<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use config\AppConfig;
use Exception;

class Home extends Controller{
    public function index(){
        // $middleware = $this->middleware('TestMiddleware');        
        $this->addRel("stylesheet", "/public/css/topbar.css");
        $this->addRel("stylesheet", "/public/css/style.css");
        $this->addRel("stylesheet", "/public/css/home.css");

        if(!isset($_GET['page'])){
            $page = 1;
        } else{
            try{
                if(!intval($_GET['page'])){
                    Router::NotFound();
                }
                if($_GET['page'] < 1){
                    Router::NotFound();
                }
                $page = $_GET['page'];
            }catch(Exception){
                Router::NotFound();
            }
        }
        $bookmodel = $this->model('BookModel');
        $bookdata = $bookmodel->fetchBooksPaged($page);
        $booktable = $bookdata[0];
        $booklen = $bookdata[1];

        $currentDate = date("Y-m-d");
        $year = intval(date("Y", strtotime($currentDate)));
        $month = intval(date("m", strtotime($currentDate)));
        $day = intval(date("d", strtotime($currentDate)));
        $featurednumber =  @abs((intval(AppConfig::FEATURED_SEED * $year) * cos($month) * sin($day)) % $booklen);
        $featuredbook = $bookmodel->fetchBookByRow($featurednumber);

        if(empty($booktable)) Router::NotFound();

        $this->view('Home', ['booktable' => $booktable, 'booklen' => $booklen, 'bookfeatured' => $featuredbook, 'currentpage' => intval($page)]);
    }
}

?>