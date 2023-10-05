<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use config\AppConfig;
use Exception;

class Home extends Controller{
    public function fetch(){
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
        return [$bookmodel->fetchBooksPaged($page, AppConfig::ENTRIES_PER_PAGE), $page];
    }

    public function fetchFeatured($booklen){
        $currentDate = date("Y-m-d");
        $year = intval(date("Y", strtotime($currentDate)));
        $month = intval(date("m", strtotime($currentDate)));
        $day = intval(date("d", strtotime($currentDate)));
        $featurednumber =  @abs((intval(AppConfig::FEATURED_SEED * $year) * cos($month) * sin($day)) % $booklen);
        
        $bookmodel = $this->model('BookModel');
        return $bookmodel->fetchBookByRow($featurednumber);
    }

    public function index(){
        $middleware = $this->middleware('AuthMiddleware');
        $middleware->check();
        
        $this->addRel("stylesheet", "/public/css/topbar.css");
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/home.css");

        $result = $this->fetch();
        $bookdata = $result[0];
        $page = $result[1];
        $booktable = $bookdata[0];
        $booklen = $bookdata[1];

        $featuredbook = $this->fetchFeatured($booklen);

        if(empty($booktable)) Router::NotFound();

        $this->view('Home', ['booktable' => $booktable, 'booklen' => $booklen, 'bookfeatured' => $featuredbook, 'currentpage' => intval($page)]);
    }

    public function updateList(){
        $updateresult = $this->fetch();
        $bookdata = $updateresult[0];
        $currentpage = intval($updateresult[1]);
        $booktable = $bookdata[0];
        $booklen = $bookdata[1];

        echo "<h2>Book List</h2>";
        echo "<div class='book-list'>";
        echo '<div class="book-grid">';
        foreach ($booktable as $bookdata) {
            extract($bookdata);
            include '../app/components/BookGridEntry.php';
        }
        echo '</div>';
        $data = [
            'pagelen' => intval(ceil($booklen / AppConfig::ENTRIES_PER_PAGE)),
            'currentpage' => $currentpage,
            'clickfunction' => 'changePage',
        ];
        extract($data);
        include '../app/components/PageIndex.php';
    }
}

?>