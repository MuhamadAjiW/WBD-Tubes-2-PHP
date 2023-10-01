<?php

namespace app\core;

use config\DBConfig;
use Exception;
use PDO;

class PDOStatic{
    private static $pdoinstance;
    private $connection;

    private function __construct(){
        $dsn = "pgsql:host=" . DBConfig::getHost() . ";port=" . DBConfig::getPort() . ";dbname=" . DBConfig::getName();
        $option = [
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ];

        try{
            $this->connection = new PDO($dsn, DBConfig::getUser(), DBConfig::getPassword(), $option);
        } catch(Exception){
            throw new Exception('Error: Failed creating a connection');
        }
    }

    public static function getInstance(){
        if(!isset(self::$pdoinstance)){
            self::$pdoinstance = new PDOStatic;
        }
        return self::$pdoinstance;
    }

    public function __destruct(){
        $this->connection = null;
    }

    public function getConnection(){
        return $this->connection;
    }
}

?>