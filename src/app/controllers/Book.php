<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use Exception;

class Book extends Controller{
    public function __construct(){
        parent::__construct();
        $middleware = $this->middleware('AuthMiddleware');
        $middleware->check(true, "/error/404");
    }

    //TODO: Messages and validation
    public function getBook(){
        try{
            if (isset($_GET['bid'])) {
                $bookmodel = $this->model('BookModel');
                
                $book_id = $_GET['bid'];
                try{
                    $bookData = $bookmodel->fetchBookByID($book_id);
                    if (!empty($bookData)) {
                        header('Content-Type: application/json');
                        
                        http_response_code(200);
                        echo json_encode($bookData);
                    } else {
                        http_response_code(404);
                        echo json_encode(array("message" => "Book does not exist"));
                        exit;
                    }
                } catch(Exception){
                    http_response_code(500);
                    echo json_encode(array("message" => "Fetch book failed"));
                    exit;
                }            
            }
            else{
                http_response_code(400);
                echo json_encode(array("message" => "Bad request"));
                exit;    
            }

        } catch (Exception){
            http_response_code(500);
            echo json_encode(array("message" => "Fetch book failed"));
            exit;
        }
    }

    //TODO: Validate inputs
    public function addBook(){
        if (isset($_POST['title']) && isset($_POST['synopsis']) && isset($_POST['username']) && isset($_POST['genre']) && isset($_POST['release_date']) && isset($_POST['duration']) && isset($_POST['word_count']) && isset($_POST['graphic_cntn']) && isset($_FILES['image_file']) && isset($_FILES['audio_file'])) {
            $img_dir = __DIR__ . "/../../storage/images/";
            $target_img_dir = $img_dir . basename($_FILES["image_file"]["name"]);
            $saved_img_dir = "/storage/images/" . basename($_FILES["image_file"]["name"]);

            $audio_dir = __DIR__ . "/../../storage/audio/";
            $target_audio_dir = $audio_dir. basename($_FILES["audio_file"]["name"]);
            $saved_audio_dir = "/storage/audio/" . basename($_FILES["audio_file"]["name"]);

            if ($_FILES["image_file"]['size'] > 10000000) {
                http_response_code(500);
                echo json_encode(array("message" => "Image file too large"));
            } 
            
            else if ($_FILES["audio_file"]['size'] > 10000000) {
                http_response_code(500);
                echo json_encode(array("message" => "Audio file too large"));
            } 
            
            else {
                $bookmodel = $this->model("BookModel");
                $usermodel = $this->model("UserModel");

                $usernameexist = $usermodel->checkUsernameExists($_POST['username']);

                if (count($usernameexist) > 0) {
                    $user = $usermodel->fetchUserIDByUsername($_POST['username']);

                    $bookexist = $bookmodel->checkBookExistsByTitleNAuthor($_POST['title'], $user['user_id']);

                    if (empty($bookexist)) {
                        $rows = $bookmodel->addBook($_POST['title'], $_POST['synopsis'], $user['user_id'], $_POST['genre'], $_POST['release_date'], intval($_POST['word_count']), intval($_POST['duration']), $_POST['graphic_cntn'], $saved_img_dir, $saved_audio_dir);

                        $move_image = move_uploaded_file($_FILES['image_file']['tmp_name'], $target_img_dir);
                        $move_audio = move_uploaded_file($_FILES['audio_file']['tmp_name'], $target_audio_dir);

                        if ($rows) {
                            http_response_code(200);
                            echo json_encode(array("message" => "Add book success", "redirect" => "/admin/books"));
                        } else {
                            http_response_code(500);
                            echo json_encode(array("message" => "Add book failed"));
                        }
                    } else {
                        http_response_code(409);
                        echo json_encode(array("message" => "Book already exist"));
                    }

                }
                else {
                    http_response_code(409);
                    echo json_encode(array("message" => "Username doesn't exist"));
                }
            }
        } 
        else {
            http_response_code(400);
            echo json_encode(array("message" => "Bad request."));
        }
    }

    public function editBook(){
        if (isset($_POST['bid']) && isset($_POST['title']) && isset($_POST['synopsis']) && isset($_POST['username']) && isset($_POST['genre']) && isset($_POST['release_date']) && isset($_POST['duration']) && isset($_POST['word_count']) && isset($_POST['graphic_cntn'])) {
            $book_id = $_POST['bid'];
            $wimage = isset($_FILES['image_file']);
            $waudio = isset($_FILES['audio_file']);

            if($wimage){
                $img_dir = __DIR__ . "/../../storage/images/";
                $target_img_dir = $img_dir . basename($_FILES["image_file"]["name"]);
                $saved_img_dir = "/storage/images/" . basename($_FILES["image_file"]["name"]);
                if ($_FILES["image_file"]['size'] > 10000000) {
                    http_response_code(500);
                    echo json_encode(array("message" => "Image file too large"));
                } 
            }
            if($waudio){
                $audio_dir = __DIR__ . "/../../storage/audio/";
                $target_audio_dir = $audio_dir. basename($_FILES["audio_file"]["name"]);
                $saved_audio_dir = "/storage/audio/" . basename($_FILES["audio_file"]["name"]);
                if ($_FILES["audio_file"]['size'] > 10000000) {
                    http_response_code(500);
                    echo json_encode(array("message" => "Audio file too large"));
                } 
            }

            $bookmodel = $this->model("BookModel");
            $usermodel = $this->model("UserModel");
            $usernameexist = $usermodel->checkUsernameExists($_POST['username']);

            if (count($usernameexist) > 0) {
                $user = $usermodel->fetchUserIDByUsername($_POST['username']);

                $bookexist = $bookmodel->checkBookExistsByTitleNAuthor($_POST['title'], $user['user_id']);

                if (!empty($bookexist)) {
                    $rows = $bookmodel->updateBookData($book_id, $_POST['title'], $_POST['synopsis'], $user['user_id'], $_POST['genre'], $_POST['release_date'], intval($_POST['word_count']), intval($_POST['duration']), $_POST['graphic_cntn']);

                    if ($rows) {
                        if($wimage){
                            $image_path = $bookmodel->fetchImagePathByID($book_id);
                            $rm_img = __DIR__ . '/../..' . $image_path['image_path'];
                            unlink($rm_img);
                            $move_image = move_uploaded_file($_FILES['image_file']['tmp_name'], $target_img_dir);
                            $bookmodel->updateBookImgPath($book_id, $saved_img_dir);
                        }
                        if($waudio){
                            $audio_path = $bookmodel->fetchAudioPathByID($book_id);
                            $rm_audio = __DIR__ . '/../..' . $audio_path['audio_path'];
                            unlink($rm_audio);
                            $move_audio = move_uploaded_file($_FILES['audio_file']['tmp_name'], $target_audio_dir);
                            $bookmodel->updateBookAudioPath($book_id, $saved_audio_dir);
                        }
                        http_response_code(200);
                        echo json_encode(array("message" => "Edit book success", "redirect" => "/admin/books"));
                    } else {
                        http_response_code(500);
                        echo json_encode(array("message" => "Edit book failed"));
                    }
                } else {
                    http_response_code(404);
                    echo json_encode(array("message" => "Book does not exist"));
                }

            }
            else {
                http_response_code(409);
                echo json_encode(array("message" => "Username doesn't exist"));
            }
        } 
        else {
            http_response_code(400);
            echo json_encode(array("message" => "Bad request."));
        }
    }

    public function deleteBook() {
        try{
            parse_str(file_get_contents("php://input"), $vars);
            $book_id = $vars['bid'];
            if (isset($book_id)) {
                $bookmodel = $this->model("BookModel");
    
                
                $image_path = $bookmodel->fetchImagePathByID($book_id);
                $audio_path = $bookmodel->fetchAudioPathByID($book_id);
                
                $rm_img = __DIR__ . '/../..' . $image_path['image_path'];
                $rm_audio = __DIR__ . '/../..' . $audio_path['audio_path'];
                
                echo($rm_img);
                echo($rm_audio);
                
                $rows = $bookmodel->deleteBookById($book_id);
                if (!empty($rows)) {
                    if (file_exists($rm_img)) {
                        unlink($rm_img);
                    }
    
                    if (file_exists($rm_audio)) {
                        unlink($rm_audio);
                    }
                    http_response_code(200);
                    echo json_encode(array("message" => "Delete book success"));
    
                } else {
                    http_response_code(500);
                    echo json_encode(array("message" => "Delete book failed"));
                }
            } else {
                http_response_code(400);
                echo json_encode(array("message" => "Bad request."));
            }

        } catch(Exception){
            http_response_code(400);
            echo json_encode(array("message" => "Bad request."));
        }
    }
}

?>