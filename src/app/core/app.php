<?php

namespace app\core;

class App {
    private $router;

    public function __construct(){
        $this->router = new Router();
        $this->initRoutes();
        $this->router->handleRoute();
    }

    public function initRoutes(){
        $this->router->redirect_permanent('/', '/home');

        $this->router->addRoute('/home', 'app/controllers/Home', 'index', ['GET']);
        $this->router->addRoute('/search', 'app/controllers/Search', 'index', ['GET']);
        $this->router->addRoute('/search', 'app/controllers/Search', 'serve', ['POST']);
        $this->router->addRoute('/login', 'app/controllers/Login', 'index', ['GET']);
        $this->router->addPost('/login', 'app/controllers/Login', 'login');
        $this->router->addRoute('/detail', 'app/controllers/BookDetail', 'index', ['GET']);
        $this->router->addRoute('/register', 'app/controllers/Register', 'index', ['GET']);
        $this->router->addPost('/register', 'app/controllers/Register', 'register');
        $this->router->addRoute('/adminusers', 'app/controllers/AdminUsers', 'index', ['GET']);
        $this->router->addRoute('/adminbooks', 'app/controllers/AdminBooks', 'index', ['GET']);
        $this->router->addRoute('/adminreviews', 'app/controllers/AdminReviews', 'index', ['GET']);
        $this->router->addRoute('/addbook', 'app/controllers/AddBook', 'index', ['GET']);
        $this->router->addRoute('/adduser', 'app/controllers/AddUser', 'index', ['GET']);
    }
}
?>