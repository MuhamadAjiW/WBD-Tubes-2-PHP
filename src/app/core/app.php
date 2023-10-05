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
        $this->router->addRoute('/login', 'app/controllers/Login', 'index', ['GET']);
        $this->router->addPost('/login', 'app/controllers/Login', 'login');
        $this->router->addGet('/logout', 'app/controllers/Login', 'logout');
        
        $this->router->addRoute('/register', 'app/controllers/Register', 'index', ['GET']);
        $this->router->addPost('/register', 'app/controllers/Register', 'register');
        
        $this->router->addRoute('/admin/users', 'app/controllers/AdminUsers', 'index', ['GET']);
        $this->router->addRoute('/admin/books', 'app/controllers/AdminBooks', 'index', ['GET']);
        $this->router->addRoute('/admin/reviews', 'app/controllers/AdminReviews', 'index', ['GET']);
        $this->router->addRoute('/admin/addbook', 'app/controllers/AddBook', 'index', ['GET']);
        $this->router->addRoute('/admin/adduser', 'app/controllers/AddUser', 'index', ['GET']);
        $this->router->addRoute('/admin/edituser', 'app/controllers/EditUser', 'index', ['GET']);
        $this->router->addRoute('/admin/editbook', 'app/controllers/EditBook', 'index', ['GET']);
        $this->router->addRoute('/admin', 'app/controllers/AdminPage', 'index', ['GET']);
        $this->router->addPost('/admin/adduser', 'app/controllers/AddUser', 'add', ['POST']);

        $this->router->addRoute('/profile', 'app/controllers/Profile', 'index', ['GET']);
        $this->router->addRoute('/detail', 'app/controllers/BookDetail', 'index', ['GET']);

        $this->router->addRoute('/api/search', 'app/controllers/Search', 'serve', ['GET']);
        $this->router->addRoute('/api/searchsm', 'app/controllers/TopBar', 'search', ['GET']);
        $this->router->addRoute('/api/homelist', 'app/controllers/Home', 'updatelist', ['GET']);
    }
}
?>