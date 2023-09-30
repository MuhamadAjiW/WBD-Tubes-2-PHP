<?php

class App{
    private $database;
    public function __construct(){
        echo TEST;
        echo DB_HOST;
        echo DB_NAME;
        echo DB_PORT;
        echo DB_USER;
        echo DB_PASSWORD;
        $this->database = new Database();
    }
}
?>