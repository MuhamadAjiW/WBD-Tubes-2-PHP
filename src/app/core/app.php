<?php

namespace app\core;

class App{
    private $router;
    private $database;

    public function __construct(){
        $this->database = new Database();
        $this->router = new Router();
        $this->initRoutes();

        $this->router->handleRoute();
    }

    public function initRoutes(){
        $this->router->addRoute('/', 'app/controllers/Home', 'index', ['GET']);
        $this->router->addRoute('/login', 'app/controllers/Login', 'index', ['GET']);
    }
}
?>