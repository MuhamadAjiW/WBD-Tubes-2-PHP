<?php

namespace app\core;

class App{
    private $router;
    private $database;

    public function __construct(){
        $this->router = new Router();
        $this->database = new Database();

        $this->initRoutes();
        $this->router->handleRoute();
    }

    public function initRoutes(){
        $this->router->addRoute('/', 'app/controllers/Home', 'index', ['GET']);
        $this->router->addRoute('/home', 'app/controllers/Home', 'index', ['GET']);
        $this->router->addRoute('/login', 'app/controllers/Login', 'index', ['GET']);
        $this->router->addRoute('/detail', 'app/controllers/BookDetail', 'index', ['GET']);
    }
}
?>