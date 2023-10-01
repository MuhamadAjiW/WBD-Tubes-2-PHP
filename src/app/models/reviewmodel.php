<?php

namespace app\models;

use app\core\Database;

class ReviewModel{
    private $database;

    public function __construct(){
        $this->database = new Database();
    }

    public function addReview(
        $book_id,
        $user_id,
        $rating,
        $reviewtext
    ){

    }
}

?>