<?php

namespace app\models;

use app\core\Database;
use config\AppConfig;

class ReviewModel{
    private $database;

    public function __construct(){
        $this->database = new Database();
    }

    public function addReview(
        $book_id,
        $user_id,
        $rating,
        $reviewtext
    ){
        $query = "INSERT INTO reviews (book_id, user_id, rating, reviewtext)
        VALUES(:book_id, :user_id, :rating, :reviewtext) ";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        $this->database->bind('user_id', $user_id);
        $this->database->bind('rating', $rating);
        $this->database->bind('reviewtext', $reviewtext);

        $this->database->execute();

        return $this->database->rowCount();
    }

    public function fetchReviewByBookID($book_id) {
        $query = "SELECT * FROM reviews WHERE book_id = :book_id";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);

        return $this->database->fetchall();
    }
    
    public function fetchReviewByUserID($user_id) {
        $query = "SELECT * FROM reviews WHERE user_id = :user_id";

        $this->database->query($query);
        $this->database->bind('user_id', $user_id);

        return $this->database->fetchall();
    }

    public function fetchReviewByBookAndUserID($book_id, $user_id) {
        $query = "SELECT * FROM reviews
                    WHERE book_id = :book_id AND user_id = :user_id";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        $this->database->bind('user_id', $user_id);

        return $this->database->fetch();
    }

    public function fetchReviewData($book_id, $page=1, $pagesize = AppConfig::REVIEWS_PER_LOAD) {
        $query = "SELECT book_id, name, rating, reviewtext
                    FROM reviews JOIN users ON users.user_id = reviews.user_id
                    WHERE book_id = :book_id";
        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();
        $totalreviews = $this->database->rowCount();
        
        $query = "SELECT book_id, name, rating, reviewtext
                     FROM reviews JOIN users ON users.user_id = reviews.user_id
                     WHERE book_id = :book_id
                     LIMIT :limit OFFSET :offset";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        $this->database->bind('limit', $pagesize);
        $this->database->bind('offset', ($page - 1) * $pagesize);
        $reviewdata = $this->database->fetchall();

        return [$reviewdata, $totalreviews];
    }

    public function fetchReviewsAll() {
        $query = "SELECT u.user_id, book_id, username, title, rating, reviewtext
        FROM reviews r
        NATURAL JOIN books b
        INNER JOIN users u ON u.user_id = r.user_id";

        $this->database->query($query);
        
        return $this->database->fetchAll();
    }

    public function fetchReviewByUserNBookID($book_id, $user_id) {
        $query = "SELECT u.user_id, b.book_id, u.username, b.title, r.rating, r.reviewtext FROM reviews r
        INNER JOIN users u ON r.user_id = u.user_id
        INNER JOIN books b ON b.book_id = r.book_id
        WHERE r.user_id = :user_id AND r.book_id = :book_id";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        $this->database->bind('user_id', $user_id);

        return $this->database->fetch();
    }

    public function updateReview($book_id, $user_id, $reviewtext, $rating) {
        $query = "UPDATE reviews SET reviewtext=:reviewtext, rating=:rating WHERE book_id=:book_id AND user_id=:user_id";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        $this->database->bind('user_id', $user_id);
        $this->database->bind('reviewtext', $reviewtext);
        $this->database->bind('rating', $rating);
        $this->database->execute();
    }

    public function updateReviewText($book_id, $user_id, $reviewtext) {
        $query = "UPDATE reviews SET reviewtext=:reviewtext WHERE book_id=:book_id AND user_id=:user_id";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        $this->database->bind('user_id', $user_id);
        $this->database->bind('reviewtext', $reviewtext);
        $this->database->execute();
    }

    public function updateReviewRating($book_id, $user_id, $rating) {
        $query = "UPDATE reviews SET rating=:rating WHERE book_id=:book_id AND user_id=:user_id";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        $this->database->bind('user_id', $user_id);
        $this->database->bind('rating', $rating);
        $this->database->execute();
    }

    public function deleteReview($book_id, $user_id) {
        $query = "DELETE FROM reviews WHERE book_id=:book_id AND user_id=:user_id";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        $this->database->bind('user_id', $user_id);
        $this->database->execute();

        return $this->database->rowCount();
    }
}

?>