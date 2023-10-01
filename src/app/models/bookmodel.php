<?php

namespace app\models;

use app\core\Database;

class BookModel{
    private $database;

    public function __construct(){
        $this->database = new Database();
    }

    public function addBook(
        $title,
        $author_id,
        $genre,
        $release_date,
        $word_count,
        $duration,
        $graphic_cntn,
        $image_path,
        $audio_path
    ){

    }
}

?>