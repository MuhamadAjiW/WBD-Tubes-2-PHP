<?php

class BookModel{
    private $database;

    public function __construct(){
        $this->database = new Database();
    }
}

?>