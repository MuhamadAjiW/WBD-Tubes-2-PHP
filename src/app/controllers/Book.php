<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Router;
use Exception;

class Book extends Controller{
    //TODO: Messages and validation

    public function addBook(){

    }

    public function editBook(){

    }

    public function deleteBook() {
        if (isset($_POST['book_id'])) {
            $bookmodel = $this->model("BookModel");

            $rows = $bookmodel->deleteBookById($_POST['book_id']);

            $image_path = $bookmodel->fetchImagePathByID($_POST['book_id']);
            $audio_path = $bookmodel->fetchAudioPathByID($_POST['book_id']);
            
            $rm_img = __DIR__ . '/../..' . $image_path['image_path'];
            $rm_audio = __DIR__ . '/../..' . $audio_path['audio_path'];

            if ($rows) {
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
    }
}

?>