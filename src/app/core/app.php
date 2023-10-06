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
        $this->router->redirect_permanent('/admin', '/admin/books');

        $this->router->addRoute('/home', 'app/controllers/Home', 'index', ['GET']);
        $this->router->addRoute('/search', 'app/controllers/Search', 'index', ['GET']);
        $this->router->addRoute('/login', 'app/controllers/Login', 'index', ['GET']);
        $this->router->addPost('/login', 'app/controllers/Login', 'login');
        $this->router->addGet('/logout', 'app/controllers/Login', 'logout');
        
        $this->router->addRoute('/register', 'app/controllers/Register', 'index', ['GET']);
        $this->router->addPost('/register', 'app/controllers/Register', 'register');
        
        $this->router->addRoute('/admin/books', 'app/controllers/Admin', 'bookView', ['GET']);
        $this->router->addRoute('/admin/users', 'app/controllers/Admin', 'userView', ['GET']);
        $this->router->addRoute('/admin/reviews', 'app/controllers/Admin', 'reviewView', ['GET']);

        $this->router->addRoute('/admin/addbook', 'app/controllers/AddBook', 'index', ['GET']);
        $this->router->addRoute('/admin/editbook', 'app/controllers/EditBook', 'index', ['GET']);
        $this->router->addPost('/admin/users', 'app/controllers/AdminUsers', 'delete', ['POST']);
        $this->router->addPost('/admin/reviews', 'app/controllers/AdminReviews', 'delete', ['POST']);
        $this->router->addPost('/admin/books', 'app/controllers/AdminBooks', 'delete', ['POST']);
        $this->router->addPost('/admin/addbook', 'app/controllers/AddBook', 'add', ['POST']);
        $this->router->addPost('/admin/editbook', 'app/controllers/EditBook', 'edit', ['POST']);

        $this->router->addRoute('/profile', 'app/controllers/Profile', 'index', ['GET']);
        $this->router->addRoute('/detail', 'app/controllers/BookDetail', 'index', ['GET']);

        $this->router->addRoute('/api/search', 'app/controllers/Search', 'serve', ['GET']);
        $this->router->addRoute('/api/searchsm', 'app/controllers/TopBar', 'search', ['GET']);
        $this->router->addRoute('/api/homelist', 'app/controllers/Home', 'updatelist', ['GET']);
        $this->router->addRoute('/api/bookdetail/getMore', 'app/controllers/BookDetail', 'moreReviews', ['GET']);
        $this->router->addRoute('/api/admin/booklist', 'app/controllers/Admin', 'updateBookList', ['GET']);
        $this->router->addRoute('/api/admin/userlist', 'app/controllers/Admin', 'updateUserList', ['GET']);
        $this->router->addRoute('/api/admin/reviewlist', 'app/controllers/Admin', 'updateReviewList', ['GET']);

        $this->router->addRoute('/api/review/get', 'app/controllers/Review', 'getReview', ['GET']);
        $this->router->addRoute('/api/review/edit', 'app/controllers/Review', 'editReview', ['POST']);
        $this->router->addRoute('/api/review/add', 'app/controllers/Review', 'addReview', ["PUT"]);
        $this->router->addRoute('/api/review/delete', 'app/controllers/Review', 'deleteReview', ['DELETE']);
        
        $this->router->addRoute('/api/book/get', 'app/controllers/Book', 'getBook', ['GET']);
        $this->router->addRoute('/api/book/edit', 'app/controllers/Book', 'editBook', ['POST']);
        $this->router->addRoute('/api/book/add', 'app/controllers/Book', 'addBook', ["PUT"]);
        $this->router->addRoute('/api/book/delete', 'app/controllers/Book', 'deleteBook', ['DELETE']);
        
        $this->router->addRoute('/api/user/get', 'app/controllers/User', 'getUser', ['GET']);
        $this->router->addRoute('/api/user/edit', 'app/controllers/User', 'editUser', ['POST']);
        $this->router->addRoute('/api/user/add', 'app/controllers/User', 'addUser', ["PUT"]);
        $this->router->addRoute('/api/user/delete', 'app/controllers/User', 'deleteUser', ['DELETE']);
    }
}
?>