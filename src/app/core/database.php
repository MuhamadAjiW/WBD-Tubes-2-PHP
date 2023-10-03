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
        } catch(Exception $e){
            throw new Exception('Failed initializing tables' . $e->getMessage());
        }
    }

    public function query($query){
        try{
            $this->loaded_query = $this->connection->prepare($query);
        } catch(Exception $e){
            throw new Exception('Failed preparing query: ' . $e->getMessage());
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
        } catch(Exception $e){
            throw new Exception('Failed binding query: ' . $e->getMessage());
        }
    }

    public function execute(){
        try{
            $this->loaded_query->execute();
        } catch(Exception $e){
            throw new Exception('Failed executing query: ' . $e->getMessage());
        }
    }

    public function fetch(){
        try{
            $this->execute();
            return $this->loaded_query->fetch(PDO::FETCH_ASSOC);
        } catch(Exception){
            throw new Exception('Error: Failed fetching query');
        }
    }

    public function fetchAll(){
        try{
            $this->execute();
            $this->loaded_query->fetchAll(PDO::FETCH_ASSOC);
        } catch(Exception $e){
            throw new Exception('Failed fetching query: ' . $e->getMessage());
        }
    }
}

?>