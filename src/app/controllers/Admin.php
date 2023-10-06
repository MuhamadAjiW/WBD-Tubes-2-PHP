<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use config\AppConfig;
use Exception;

class Admin extends Controller{
    private $data;
    
    public function __construct(){
        parent::__construct();
        $middleware = $this->middleware('AuthMiddleware');
        $middleware->check(false, "/error/404");
        $this->addRel("stylesheet", "/public/css/topbar.css");
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/bookdetail.css");
        $this->addRel("stylesheet", "/public/css/admin.css");
        $this->data['inadminpage'] = true;
    }

    public function bookView(){
        $bookmodel = $this->model('BookModel');
        
        
        $this->data['bookdata'] = $bookmodel->fetchAllBooksForAdmin();
        
        $this->view('AdminBooks', $this->data);
    }
    
    public function userView(){
        $usermodel = $this->model('UserModel');
        $currentpage = $this->getPage();
        $result = $usermodel->fetchUsersPaged($currentpage, AppConfig::ENTRIES_PER_ADMIN_PAGE);
        $usertable = $result[0];
        $userlen = $result[1];

        $this->data['userdata'] = $usertable;
        $this->data['userlen'] = $userlen;
        $this->data['currentpage'] = $currentpage;
        $this->data['pagelen'] = AppConfig::ENTRIES_PER_ADMIN_PAGE;
        
        $this->view('AdminUsers', $this->data);
    }

    public function reviewView(){        
        $reviewmodel = $this->model('ReviewModel');
        $currentpage = $this->getPage();
        $result = $reviewmodel->fetchReviewsPaged($currentpage, AppConfig::ENTRIES_PER_ADMIN_PAGE);
        $reviewtable = $result[0];
        $reviewlen = $result[1];

        $this->data['reviewdata'] = $reviewtable;
        $this->data['reviewlen'] = $reviewlen;
        $this->data['currentpage'] = $currentpage;
        $this->data['pagelen'] = AppConfig::ENTRIES_PER_ADMIN_PAGE;

        
        $this->view('AdminReviews', $this->data);
    }

    public function updateBookList(){

    }

    public function updateUserList(){
        $usermodel = $this->model('UserModel');
        $currentpage = $this->getPage();
        $result = $usermodel->fetchUsersPaged($currentpage, AppConfig::ENTRIES_PER_ADMIN_PAGE);
        $usertable = $result[0];
        $userlen = $result[1];

        foreach ($usertable as $user){
            echo '<tr>';
            echo '<td class="admin-tb-e col-1">' . $user['user_id'] . '</td>';
            echo '<td class="admin-tb-e col-20">' . $user['username'] . '</td>';
            echo '<td class="admin-tb-e col-20">' . $user['email'] . '</td>';
            echo '<td class="admin-tb-e col-20">' . $user['name'] . '</td>';
            echo '<td class="admin-tb-e col-50">' . $user['bio'] . '</td>';
            echo '<td class="admin-tb-e col-1">' . $user['admin'] . '</td>';
            echo '<td class="admin-tb-e admin-tb-cent">';
            echo '<button class="btn btn-sm btn-grey" style="flex:1" data-user-id ="'. $user['user_id'] . '" onclick="editUserPrompt(' . $user['user_id'] . ')">Edit</button>';
            echo '<div style="width: 5px;"></div>';
            echo '<button class="btn btn-sm btn-red" style="flex:1" data-user-id ="'. $user['user_id'] . '" onclick="deleteUserPrompt(' . $user['user_id'] . ')">Delete</button>';
            echo '<tr>';
        }
        echo '<SPLIT></SPLIT>';

        $data = [
            'pagelen' => intval(ceil($userlen / AppConfig::ENTRIES_PER_ADMIN_PAGE)),
            'currentpage' => $currentpage,
            'clickfunction' => 'changePage',
        ];
        extract($data);
        include '../app/components/PageIndex.php';     
    }

    public function updateReviewList(){
        $reviewmodel = $this->model('ReviewModel');
        $currentpage = $this->getPage();
        $result = $reviewmodel->fetchReviewsPaged($currentpage, AppConfig::ENTRIES_PER_ADMIN_PAGE);
        $reviewtable = $result[0];
        $reviewlen = $result[1];

        foreach ($reviewtable as $review){
            echo '<tr>';
            echo '<td class="admin-tb-e col-20">' . $review['username'] . '</td>';
            echo '<td class="admin-tb-e col-20">' . $review['title'] . '</td>';
            echo '<td class="admin-tb-e col-1">' . $review['rating'] . '</td>';
            echo '<td class="admin-tb-e col-50">' . $review['reviewtext'] . '</td>';
            echo '<td class="admin-tb-e admin-tb-cent">';
            echo '<button class="btn btn-sm btn-grey" style="flex:1" data-review-book-id ="'. $review['book_id'] . '" data-review-user-id = "' . $review['user_id'] . '" onclick="editReviewPrompt(' . $review['user_id'] . ',' . $review['book_id'] . ')">Edit</button>';
            echo '<div style="width: 5px;"></div>';
            echo '<button class="btn btn-sm btn-red" style="flex:1" data-review-book-id ="'. $review['book_id'] . '" data-review-user-id = "' . $review['user_id'] . '" onclick="deleteReviewPrompt(' . $review['user_id'] . ',' . $review['book_id'] . ')">Delete</button>';
            echo '<tr>';
        }
        echo '<SPLIT></SPLIT>';

        $data = [
            'pagelen' => intval(ceil($reviewlen / AppConfig::ENTRIES_PER_ADMIN_PAGE)),
            'currentpage' => $currentpage,
            'clickfunction' => 'changePage',
        ];
        extract($data);
        include '../app/components/PageIndex.php';        
    }
    
    private function getPage(){
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
        return intval($page);
    }
}

?>