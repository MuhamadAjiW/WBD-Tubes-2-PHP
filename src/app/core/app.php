<?php

namespace app\core;

class App{
    private $router;

    public function __construct(){
        $this->router = new Router();
        $this->initRoutes();
        $this->router->handleRoute();
    }

    public function initRoutes(){
        $this->router->redirect('/', '/home');
        $this->router->addRoute('/home', 'app/controllers/Home', 'index', ['GET']);
        $this->router->addRoute('/login', 'app/controllers/Login', 'index', ['GET']);
        $this->router->addPost('/login', 'app/controllers/Login', 'login');
        $this->router->addRoute('/detail', 'app/controllers/BookDetail', 'index', ['GET']);
    }
}
?>