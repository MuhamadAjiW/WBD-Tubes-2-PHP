<?php

use app\core\App;

function autoLoad($class_name){
    $class_path = __DIR__;
    $class_file = str_replace('\\', '/', $class_name);
    $class = $class_path . '/' . $class_file . '.php';
    
    echo "autoloading: " . $class_name . "<br>";
    if(file_exists($class)){
        require_once($class);
    }
}
spl_autoload_register('autoload');

$app = new App;

?>
