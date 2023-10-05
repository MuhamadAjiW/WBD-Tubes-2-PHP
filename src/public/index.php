<?php

use app\core\App;

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

$app = new App;
echo "<br><br><br><br><br>";
echo "<br>";
var_dump($_POST);
echo "<br>";
var_dump($_SESSION);
echo "<br>";
var_dump($_COOKIE);

?>
