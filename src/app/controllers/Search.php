<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use config\AppConfig;
use Exception;

class Search extends Controller{
    public function search(){
        $bookmodel = $this->model("BookModel");

        $query = '';
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

        $query = isset($_GET['q'])? $_GET['q'] : '';
        $sort = isset($_GET['sort'])? $_GET['sort'] : 'title';
        $genre = isset($_GET['genre'])? $_GET['genre'] : 'all';
        $desc = isset($_GET['desc'])? $_GET['desc'] : '';
        $not_graphic_cntn = isset($_GET['hgcntn'])? $_GET['hgcntn'] : '';

        switch ($desc) {
            case 'true':
                $desc = true;
                break;
            case 'false':
                $desc = false;
                break;
            case '':
                $desc = false;
                break;
            default:
                Router::NotFound();
        }
        switch ($not_graphic_cntn) {
            case 'true':
                $not_graphic_cntn = true;
                break;
            case 'false':
                $not_graphic_cntn = false;
                break;
            case '':
                $not_graphic_cntn = false;
                break;
            default:
                Router::NotFound();
        }
        $querydata = [
            'query' => $query,
            'sort' => $sort,
            'desc' => $desc,
            'genre' => $genre,
            'not_graphic_cntn' => $not_graphic_cntn,
            'page' => $page
        ];
        $bookdata = $bookmodel->fetchBooksBySearch(
            $query,
            $sort,
            $desc,
            $genre,
            $not_graphic_cntn,
            $page,
            AppConfig::ENTRIES_MAIN_SEARCH
        );

        return [$bookdata, $querydata];
    }
    public function getBookGenres(){
        $bookmodel = $this->model("BookModel");
        return $bookmodel->fetchBookGenres();
    }

    public function index(){
        // $middleware = $this->middleware('TestMiddleware');        
        $this->addRel("stylesheet", "/public/css/topbar.css");
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/search.css");
        
        $result = $this->search();
        $bookdata = $result[0];
        $querydata = $result[1];
        $booktable = $bookdata[0];
        $booklen = $bookdata[1];

        $genres = $this->getBookGenres();

        $this->view('Search', ['booktable' => $booktable, 'booklen' => $booklen, 'currentpage' => intval($querydata['page']), 'querydata' => $querydata, 'genrelist' => $genres]);
    }

    public function serve(){
        // $middleware = $this->middleware('TestMiddleware');
        $result = $this->search();
        $bookdata = $result[0];
        $booktable = $bookdata[0];
        $booklen = $bookdata[1];
        $currentpage = intval($_GET['page']);

        echo "<h2>Search Result</h2>";
        echo "<div class='book-list'>";
        echo "<div class='book-grid'>";
        foreach ($booktable as $bookdata) {
            extract($bookdata);
            include '../app/components/BookGridEntry.php';
        }
        echo "</div>";
        $data = [
            'pagelen' => intval(ceil($booklen / AppConfig::ENTRIES_MAIN_SEARCH)),
            'currentpage' => $currentpage,
            'clickfunction' => 'changePage',
        ];
        extract($data);
        include '../app/components/PageIndex.php';
    }
}

?>