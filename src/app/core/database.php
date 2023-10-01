<?php

namespace app\core;

use config\DBConfig;
use Exception;
use PDO;

class Database{
    private $connection;
    private $loaded_query;

    public function __construct(){
        $this->connection = PDOStatic::getInstance()->getConnection();
        
        try{
            $this->connection->exec(DBConfig::USER_TABLE_INIT);
            $this->connection->exec(DBConfig::BOOK_TABLE_INIT);
            $this->connection->exec(DBConfig::REVIEW_TABLE_INIT);
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
            $this->loaded_query->bindValue($param, $value, $type);
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