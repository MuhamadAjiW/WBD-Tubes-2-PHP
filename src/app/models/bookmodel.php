<?php

namespace app\models;

use app\core\Database;

class BookModel{
    private $database;

    public function __construct(){
        $this->database = new Database();
    }
}

?>