<?php
namespace app\controllers;

use app\core\Controller;

class TopBar extends Controller{
    public function search(){
        $bookmodel = $this->model("BookModel");
        if(isset($_GET['qtopbar'])){
            $query = $_GET['qtopbar'];
            $results = $bookmodel->fetchBooksBySimpleSearch($query);

            foreach ($results as $bookdata) {
                extract($bookdata);
                include "../app/components/BookEntrySmall.php";
            }
        }
        else{
            echo "no query";
        }
    }
}

?>