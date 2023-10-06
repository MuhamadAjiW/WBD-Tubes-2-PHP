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
        $this->router->addRoute('/admin/addreview', 'app/controllers/AddReview', 'index', ['GET']);
        $this->router->addRoute('/admin/edituser', 'app/controllers/EditUser', 'index', ['GET']);
        $this->router->addRoute('/admin/editbook', 'app/controllers/EditBook', 'index', ['GET']);
        $this->router->addRoute('/admin/editreview', 'app/controllers/EditReview', 'index', ['GET']);
        $this->router->addRoute('/admin', 'app/controllers/AdminPage', 'index', ['GET']);
        $this->router->addPost('/admin/adduser', 'app/controllers/AddUser', 'add', ['POST']);
        $this->router->addPost('/admin/addreview', 'app/controllers/AddReview', 'add', ['POST']);
        $this->router->addPost('/admin/users', 'app/controllers/AdminUsers', 'delete', ['POST']);
        $this->router->addPost('/admin/edituser', 'app/controllers/EditUser', 'edit', ['POST']);
        $this->router->addPost('/admin/reviews', 'app/controllers/AdminReviews', 'delete', ['POST']);
        $this->router->addPost('/admin/editreview', 'app/controllers/EditReview', 'edit', ['POST']);
        $this->router->addPost('/admin/books', 'app/controllers/AdminBooks', 'delete', ['POST']);
        $this->router->addPost('/admin/addbook', 'app/controllers/AddBook', 'add', ['POST']);
        $this->router->addPost('/admin/editbook', 'app/controllers/EditBook', 'edit', ['POST']);

        $this->router->addRoute('/profile', 'app/controllers/Profile', 'index', ['GET']);
        $this->router->addRoute('/detail', 'app/controllers/BookDetail', 'index', ['GET']);

        $this->router->addRoute('/api/search', 'app/controllers/Search', 'serve', ['GET']);
        $this->router->addRoute('/api/searchsm', 'app/controllers/TopBar', 'search', ['GET']);
        $this->router->addRoute('/api/homelist', 'app/controllers/Home', 'updatelist', ['GET']);
        $this->router->addRoute('/api/bookdetailrvw', 'app/controllers/BookDetail', 'moreReviews', ['GET']);
        $this->router->addRoute('/api/editreview', 'app/controllers/BookDetail', 'editReview', ['POST']);
        $this->router->addRoute('/api/addreview', 'app/controllers/BookDetail', 'addReview', ['POST']);
    }
}
?>