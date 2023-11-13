<?php

use app\core\App;
use app\util\RESTUtil;
use app\util\SOAPUtil;

// use app\core\Seeder;

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function autoLoad($class_name){
    $class_path =  __DIR__ . "/../";
    $class_file = str_replace('\\', '/', $class_name);
    $class = $class_path . '/' . $class_file . '.php';
    
    if(file_exists($class)){
        require_once($class);
    }
}
spl_autoload_register('autoload');

// $seeder = new Seeder;
// $seeder->seedBooks();
$app = new App;


// TODO: Delete later
echo "Testing connections:\n\n";
$rest = new SOAPUtil();
$rest->testRequest();
?>
