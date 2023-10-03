<?php

namespace app\models;

use app\core\Database;
use config\AppConfig;

class BookModel{
    private $database;

    public function __construct(){
        $this->database = new Database();
    }

    public function addBook(
        $title,
        $author_id,
        $genre,
        $release_date,
        $word_count,
        $duration,
        $graphic_cntn,
        $image_path,
        $audio_path
    ){
        $query = "INSERT INTO books (title, author_id, genre, release_date, word_count, duration, graphic_cntn, image_path, audio_path)
        VALUES (:title, :author_id, :genre, :release_date, :word_count, :duration, :graphic_cntn, :image_path, :audio_path)";

        $this->database->query($query);
        $this->database->bind('title', $title);
        $this->database->bind('author_id', $author_id);
        $this->database->bind('genre', $genre);
        $this->database->bind('release_date', $release_date);
        $this->database->bind('word_count', $word_count);
        $this->database->bind('duration', $duration);
        $this->database->bind('graphic_cntn', $graphic_cntn);
        $this->database->bind('image_path', $image_path);
        $this->database->bind('audio_path', $audio_path);

        $this->database->execute();
    }

    public function fetchBookByID($book_id){
        $query = "SELECT * FROM books LIMIT 1 OFFSET :offset";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        
        return $this->database->fetch();
    }
    public function fetchBookByRow($row){
        $query = "SELECT * FROM books JOIN users
                    ON books.author_id = users.user_id
                    LIMIT 1 OFFSET :offset";

        $this->database->query($query);
        $this->database->bind('offset', $row);
        
        return $this->database->fetch();
    }
    public function fetchBooksAll(){
        $query = "SELECT * FROM books";
        $this->database->query($query);
        return $this->database->fetchAll();
    }
    public function fetchBooksPaged($page){
        $query = "SELECT * FROM books";
        $this->database->query($query);
        $this->database->execute();
        $totalbooks = $this->database->rowCount();

        $query = "SELECT * FROM books JOIN users
                    ON books.author_id = users.user_id
                    ORDER BY books.title LIMIT :limit OFFSET :offset";
        $this->database->query($query);
        $this->database->bind('limit', AppConfig::ENTRIES_PER_PAGE);
        $this->database->bind('offset', ($page - 1) * AppConfig::ENTRIES_PER_PAGE);
        
        return [$this->database->fetchAll(), $totalbooks];
    }

    public function fetchBookIDByAuthorNTitle($author_id, $title) {
        $query = "SELECT book_id FROM books WHERE author_id = :author_id AND title = :title";
        $this->database->query($query);
        $this->database->bind('author_id', $author_id);
        $this->database->bind('title', $title);

        return $this->database->fetch();
    }

    public function fetchBooksByAuthor($author_id){
        //uncomment kalo sekiranya perlu
        
        $query = "SELECT * FROM books WHERE author_id = :author_id";
        // $this->database->bind('author_id', $author_id);
        // $this->database->query($query);
        // $this->database->execute();
        // $totalbooks = $this->database->rowCount();

        // $query = "SELECT * FROM books WHERE author_id = :author_id ORDER BY title ASC LIMIT :amount";
        
        // $this->database->query($query);
        $this->database->bind('author_id', $author_id);
        // $this->database->bind('amount', $amount);
        
        $result = $this->database->fetchAll();
        // return [$result, $totalbooks];
        return $result;
    }
    public function fetchBooksBySearch(
        $search,
        $sort = 'title',
        $genre = 'all',
        $page = 1
    ){
        if ($genre === 'all'){
            $query = "SELECT * FROM books b JOIN user u ON b.author_id = u.user_id
                        WHERE (b.title LIKE :search or u.name LIKE :search)";
            
            $this->database->query($query);
            $this->database->bind('sort', $sort);
            $this->database->bind('search', '%' . $search . '%');
            
            $this->database->execute();
            $totalbooks = $this->database->rowCount();

            $query = "SELECT * FROM books b JOIN user u ON b.author_id = u.user_id
                        WHERE (b.title LIKE :search or u.name LIKE :search)
                        ORDER BY :sort LIMIT :limit OFFSET :offset";
        } else{
            $query = "SELECT * FROM books JOIN user u ON b.author_id = u.user_id
                        WHERE (b.title LIKE :search or u.name LIKE :search) and genre = :genre";
            
            $this->database->query($query);
            $this->database->bind('sort', $sort);
            $this->database->bind('search', '%' . $search . '%');
            $this->database->bind('genre', $genre);
            
            $this->database->execute();
            $totalbooks = $this->database->rowCount();

            $query = "SELECT * FROM books JOIN user u ON b.author_id = u.user_id
                        WHERE (b.title LIKE :search or u.name LIKE :search) and genre = :genre
                        ORDER BY :sort LIMIT :limit OFFSET :offset";
        }

        
        $this->database->query($query);
        $this->database->query($query);
        $this->database->bind('limit', AppConfig::ENTRIES_PER_PAGE);
        $this->database->bind('offset', ($page - 1) * AppConfig::ENTRIES_PER_PAGE);
        $this->database->bind('sort', $sort);
        $this->database->bind('search', '%' . $search . '%');
        if ($genre !== 'all') $this->database->bind('genre', $genre);
        
        $result = $this->database->fetchAll();

        return [$result, $totalbooks];
    }

    public function updateBookTitle($book_id, $title){
        $query = 'UPDATE books SET title = :title WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('title', $title);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();
    }
    public function updateBookSynopsis($book_id, $synopsis){
        $query = 'UPDATE books SET synopsis = :synopsis WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('synopsis', $synopsis);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();
    }
    public function updateBookAuthor($book_id, $author_id){
        $query = 'UPDATE books SET author_id = :author_id WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('author_id', $author_id);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();
    }
    public function updateBookGenre($book_id, $genre){
        $query = 'UPDATE books SET genre = :genre WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('genre', $genre);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();
    }
    public function updateBookRelease($book_id, $release_date){
        $query = 'UPDATE books SET release_date = :release_date WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('release_date', $release_date);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();
    }
    public function updateBookWord($book_id, $word_count){
        $query = 'UPDATE books SET word_count = :word_count WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('word_count', $word_count);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();
    }
    public function updateBookDuration($book_id, $duration){
        $query = 'UPDATE books SET duration = :duration WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('duration', $duration);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();
    }
    public function updateBookGraphic($book_id, $graphic_cntn){
        $query = 'UPDATE books SET graphic_cntn = :graphic_cntn WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('graphic_cntn', $graphic_cntn);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();
    }
    public function updateBookImgPath($book_id, $image_path){
        $query = 'UPDATE books SET image_path = :image_path WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('image_path', $image_path);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();
    }
    public function updateBookAudiopath($book_id, $audio_path){
        $query = 'UPDATE books SET audio_path = :audio_path WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('audio_path', $audio_path);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();
    }

    public function deleteBookById($book_id){
        $query = 'DELETE FROM books WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();
    }
}

?>