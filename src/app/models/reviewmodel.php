<?php

namespace app\models;

use app\core\Database;

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
        VALUES(:book_id, :user_id, :rating, :review) ";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        $this->database->bind('user_id', $user_id);
        $this->database->bind('rating', $rating);
        $this->database->bind('reviewtext', $reviewtext);

        $this->database->execute();
    }

    public function fetchReviewByBookID($book_id) {
        $query = "SELECT * FROM reviews WHERE book_id = :book_id";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);

        return $this->database->fetch();
    }

    public function fetchReviewsAll() {
        $query = "SELECT user_id, book_id, username, title, rating, reviewtext
        FROM reviews r
        NATURAL JOIN books b
        INNER JOIN users u ON u.user_id = b.author_id";

        $this->database->query($query);
        
        return $this->database->fetchAll();
    }

    public function fetchReviewByUserNBookID($book_id, $user_id) {
        $query = "SELECT * FROM reviews WHERE user_id = :user_id AND book_id = :book_id";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        $this->database->bind('user_id', $user_id);

        return $this->database->fetch();
    }

    public function updateReviewText($book_id, $user_id, $reviewtext) {
        $query = "UPDATE books SET reviewtext=:reviewtext WHERE book_id=:book_id AND user_id=:user_id";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        $this->database->bind('user_id', $user_id);
        $this->database->bind('reviewtext', $reviewtext);
        $this->database->execute();
    }

    public function updateReviewRating($book_id, $user_id, $rating) {
        $query = "UPDATE books SET rating=:rating WHERE book_id=:book_id AND user_id=:user_id";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        $this->database->bind('user_id', $user_id);
        $this->database->bind('rating', $rating);
        $this->database->execute();
    }

    public function deleteReview($book_id, $user_id) {
        $query = "DELETE FROM books WHERE book_id=:book_id AND user_id=:user_id";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        $this->database->bind('user_id', $user_id);
        $this->database->execute();
    }
}

?>