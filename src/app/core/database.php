<?php

class InitTables{
    public const USER_TABLE =
    "CREATE TABLE IF NOT EXISTS user (
        user_id         INT             AUTO_INCREMENT          PRIMARY KEY,
        email           VARCHAR(256)    UNIQUE NOT NULL,
        username        VARCHAR(256)    UNIQUE NOT NULL,
        password        VARCHAR(256)    NOT NULL,
        name            VARCHAR(256)    NOT NULL,
        admin           BOOLEAN         DEFAULT FALSE NOT NULL
    );";

    public const BOOK_TABLE =
    "CREATE TABLE IF NOT EXISTS book (
        book_id         INT             AUTO_INCREMENT          PRIMARY KEY,
        title           VARCHAR(256)    NOT NULL,
        author          VARCHAR(256)    NOT NULL,
        genre           VARCHAR(256)    NOT NULL,
        release_date    DATE            NOT NULL,
        duration        INT             NOT NULL,
        image_path      VARCHAR(256)    NOT NULL,
        audio_path      VARCHAR(256)    NOT NULL
    );";

    public const REVIEW_TABLE =
    "CREATE TABLE IF NOT EXISTS review (
        book_id         INT,
        user_id         INT,
        PRIMARY KEY (book_id, user_id),
        FOREIGN KEY (user_id) REFERENCES user(user_id),
        FOREIGN KEY (book_id) REFERENCES book(book_id)
    );";
}

class Database{
    private $connection;
    private $loaded_query;

    public function __construct(){
        $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME;
        
        try{
            $this->connection = new PDO($dsn, DB_USER, DB_PASSWORD);
        } catch(Exception){
            error_log('Error: Failed creating a connection');
        }

        try{
            $this->connection->exec(InitTables::USER_TABLE);
            $this->connection->exec(InitTables::BOOK_TABLE);
            $this->connection->exec(InitTables::REVIEW_TABLE);
        } catch(Exception){
            error_log('Error: Failed initializing tables');
        }
    }

    public function query($query){
        try{
            $this->loaded_query = $this->connection->prepare($query);
        } catch(Exception){
            error_log('Error: Failed preparing query');
        }
    }

    public function bind($param, $value, $type = null){
        try{
            if(is_null($type)){
                switch(true){
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_INT;
                        break;
                }
            }
            $this->$loaded_query->bindValue($param, $value, $type);
        } catch(Exception){
            error_log('Error: Failed binding query');
        }
    }

    public function execute(){
        try{
            $this->loaded_query->execute();
        } catch(Exception){
            error_log('Error: Failed executing query');
        }
    }

    public function fetch(){
        try{
            $this->execute();
            $this->loaded_query->fetch(PDO::FETCH_ASSOC);
        } catch(Exception){
            error_log('Error: Failed fetching query');
        }
    }

    public function fetchAll(){
        try{
            $this->execute();
            $this->loaded_query->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception){
            error_log('Error: Failed fetching query');
        }
    }
}

?>