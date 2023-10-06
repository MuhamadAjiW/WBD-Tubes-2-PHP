<?php

namespace app\controllers;

use app\core\Controller;

class AddBook extends Controller{
    public function index(){
        $this->addRel("stylesheet", "/public/css/topbar.css");
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/bookdetail.css");
        
        $this->view('AddBook', ['inadminpage' => true]);
    }

    public function add() {
        
        if (isset($_POST['title']) && isset($_POST['synopsis']) && isset($_POST['username']) && isset($_POST['genre']) && isset($_POST['release_date']) && isset($_POST['duration']) && isset($_POST['word_count']) && isset($_POST['graphic_cntn']) && isset($_FILES['image_file']) && isset($_FILES['audio_file'])) {
            $img_dir = __DIR__ . "/../../storage/images/";
            $target_img_dir = $img_dir . basename($_FILES["image_file"]["name"]);
            $saved_img_dir = "/storage/images/" . basename($_FILES["image_file"]["name"]);
            

            // PATH FOR DOCKER
            $img_real_dir = 'var/www/html/storage/images/' . $_FILES['image_file']['name'];
            $audio_real_dir = 'var/www/html/storage/audio/' . $_FILES['audio_file']['name'];


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

                    if (count($bookexist) <= 0) {
                        $rows = $bookmodel->addBook($_POST['title'], $user['user_id'], $_POST['genre'], $_POST['release_date'], $_POST['word_count'], $_POST['duration'], $_POST['graphic_cntn'], $saved_img_dir, $saved_audio_dir);

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
}

?>