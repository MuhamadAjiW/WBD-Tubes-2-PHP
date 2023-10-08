<?php

namespace app\models;

use app\core\Database;
use app\core\Router;
use config\AppConfig;

class BookModel{
    private $database;

    public function __construct(){
        $this->database = new Database();
    }

    public function addBook(
        $title,
        $synopsis,
        $author_id,
        $genre,
        $release_date,
        $word_count,
        $duration,
        $graphic_cntn,
        $image_path,
        $audio_path
    ){
        $query = "INSERT INTO books (title, synopsis, author_id, genre, release_date, word_count, duration, graphic_cntn, image_path, audio_path)
        VALUES (:title, :synopsis, :author_id, :genre, :release_date, :word_count, :duration, :graphic_cntn, :image_path, :audio_path)";

        $this->database->query($query);
        $this->database->bind('title', $title);
        $this->database->bind('synopsis', $synopsis);
        $this->database->bind('author_id', $author_id);
        $this->database->bind('genre', $genre);
        $this->database->bind('release_date', $release_date);
        $this->database->bind('word_count', $word_count);
        $this->database->bind('duration', $duration);
        $this->database->bind('graphic_cntn', $graphic_cntn);
        $this->database->bind('image_path', $image_path);
        $this->database->bind('audio_path', $audio_path);

        $this->database->execute();

        return $this->database->rowCount();
    }

    public function fetchBookByID($book_id){
        $query = "SELECT book_id, title, synopsis, b.author_id, genre, 
        release_date, word_count, duration, graphic_cntn, image_path, audio_path,
        username, name
        FROM books b
        INNER JOIN users u ON u.user_id = b.author_id
        WHERE book_id =:book_id";

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
    public function fetchBooksPaged($page = 1, $pagesize = AppConfig::ENTRIES_PER_PAGE){
        $query = "SELECT * FROM books";
        $this->database->query($query);
        $this->database->execute();
        $totalbooks = $this->database->rowCount();

        $query = "SELECT * FROM books JOIN users
                    ON books.author_id = users.user_id
                    ORDER BY books.title LIMIT :limit OFFSET :offset";
        $this->database->query($query);
        $this->database->bind('limit', $pagesize);
        $this->database->bind('offset', ($page - 1) * $pagesize);
        
        return [$this->database->fetchAll(), $totalbooks];
    }

    public function fetchBookIDByAuthorNTitle($author_id, $title) {
        $query = "SELECT book_id FROM books WHERE author_id = :author_id AND title = :title";
        $this->database->query($query);
        $this->database->bind('author_id', $author_id);
        $this->database->bind('title', $title);

        return $this->database->fetch();
    }

    public function fetchAllBooksForAdmin() {
        $query = "SELECT book_id, title, release_date, name FROM books b
        INNER JOIN users u ON u.user_id = b.author_id";

        $this->database->query($query);

        return $this->database->fetchAll();
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

    public function fetchBookGenres(){
        $query = "SELECT DISTINCT genre FROM books";
        $this->database->query($query);
        $result = $this->database->fetchAll();
        return $result;
    }

    public function fetchBooksBySimpleSearch($search){
        $query = "SELECT * FROM books b JOIN users u ON b.author_id = u.user_id
                    WHERE (b.title ILIKE :search or u.name ILIKE :search)
                    ORDER BY title LIMIT :limit";

        
        $this->database->query($query);
        $this->database->bind('limit', AppConfig::ENTRIES_SMALL_SEARCH);
        $this->database->bind('search', '%' . $search . '%');
        
        $result = $this->database->fetchAll();

        return $result;
    }
    public function fetchBooksBySearch(
        $search,
        $sort = 'title',
        $desc = false,
        $genre = 'all',
        $not_graphic_cntn = false,
        $page = 1,
        $pagesize = AppConfig::ENTRIES_PER_PAGE
    ){
        $available_sort = [
            'title',
            'genre',
            'rating_avg',
            'name',
            'release_date'
        ];

        if(!in_array($sort, $available_sort)){
            Router::NotFound();
        }

        $query = "SELECT * FROM books b JOIN users u ON b.author_id = u.user_id
                        WHERE (b.title ILIKE :search or u.name ILIKE :search)";
        if($genre !== 'all') $query = $query . " AND genre = :genre";
        
        $this->database->query($query);
        $this->database->bind('search', '%' . $search . '%');
        if($genre !== 'all') $this->database->bind('genre', $genre);
        
        $this->database->execute();
        $totalbooks = $this->database->rowCount();

        $query = "SELECT * FROM books b
                    JOIN users u ON b.author_id = u.user_id
                    JOIN
                        (SELECT b.book_id, AVG(rating) as rating_avg
                            FROM books b JOIN reviews r ON b.book_id = r.book_id
                            GROUP BY b.book_id) r_avg
                        ON b.book_id = r_avg.book_id
                    WHERE (b.title ILIKE :search or u.name ILIKE :search)";

        if($genre !== 'all') $query = $query . " AND genre = :genre";
        if($not_graphic_cntn) $query = $query . " AND graphic_cntn = FALSE";

        if($desc) $query = $query . " ORDER BY $sort DESC LIMIT :limit OFFSET :offset";
        else $query = $query . " ORDER BY $sort LIMIT :limit OFFSET :offset";

        // b.title, u.name, r_avg.rating_avg
        $this->database->query($query);
        $this->database->bind('limit', $pagesize);
        $this->database->bind('offset', ($page - 1) * $pagesize);
        $this->database->bind('search', '%' . $search . '%');
        if ($genre !== 'all') $this->database->bind('genre', $genre);
        
        $result = $this->database->fetchAll();

        return [$result, $totalbooks];
    }

    public function updateBookData(
        $book_id,
        $title,
        $synopsis,
        $author_id,
        $genre,
        $release_date,
        $word_count,
        $duration,
        $graphic_cntn
    ){
        $query = 'UPDATE books
                    SET
                        title = :title,
                        synopsis = :synopsis,
                        author_id = :author_id,
                        genre = :genre,
                        release_date = :release_date,
                        word_count = :word_count,
                        duration = :duration,
                        graphic_cntn = :graphic_cntn
                    WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('title', $title);
        $this->database->bind('synopsis', $synopsis);
        $this->database->bind('author_id', $author_id);
        $this->database->bind('genre', $genre);
        $this->database->bind('release_date', $release_date);
        $this->database->bind('word_count', $word_count);
        $this->database->bind('duration', $duration);
        $this->database->bind('graphic_cntn', $graphic_cntn);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();

        return $this->database->rowCount();
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

        return $this->database->rowCount();
    }
    public function updateBookAuthor($book_id, $author_id){
        $query = 'UPDATE books SET author_id = :author_id WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('author_id', $author_id);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();

        return $this->database->rowCount();
    }
    public function updateBookGenre($book_id, $genre){
        $query = 'UPDATE books SET genre = :genre WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('genre', $genre);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();

        return $this->database->rowCount();
    }
    public function updateBookRelease($book_id, $release_date){
        $query = 'UPDATE books SET release_date = :release_date WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('release_date', $release_date);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();

        return $this->database->rowCount();
    }
    public function updateBookWord($book_id, $word_count){
        $query = 'UPDATE books SET word_count = :word_count WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('word_count', $word_count);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();

        return $this->database->rowCount();
    }
    public function updateBookDuration($book_id, $duration){
        $query = 'UPDATE books SET duration = :duration WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('duration', $duration);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();

        return $this->database->rowCount();
    }
    public function updateBookGraphic($book_id, $graphic_cntn){
        $query = 'UPDATE books SET graphic_cntn = :graphic_cntn WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('graphic_cntn', $graphic_cntn);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();

        return $this->database->rowCount();
    }
    public function updateBookImgPath($book_id, $image_path){
        $query = 'UPDATE books SET image_path = :image_path WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('image_path', $image_path);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();

        return $this->database->rowCount();
    }
    public function updateBookAudiopath($book_id, $audio_path){
        $query = 'UPDATE books SET audio_path = :audio_path WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('audio_path', $audio_path);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();

        return $this->database->rowCount();
    }

    public function deleteBookById($book_id){
        $query = 'DELETE FROM books WHERE book_id = :book_id';

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);
        $this->database->execute();

        return $this->database->rowCount();
    }

    public function checkBookExistsByTitle($title) {
        $query = 'SELECT title FROM books WHERE title=:title';

        $this->database->query($query);
        $this->database->bind('title', $title);
        
        $rows = $this->database->fetchAll();

        return $rows;
    }

    public function fetchBookIDByTitle($title) {
        $query = 'SELECT book_id FROM books WHERE title=:title';

        $this->database->query($query);
        $this->database->bind('title', $title);

        return $this->database->fetch();
    }

    public function fetchImagePathByID($book_id) {
        $query = "SELECT image_path FROM books WHERE book_id=:book_id";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);

        return $this->database->fetch();
    }

    public function fetchAudioPathByID($book_id) {
        $query = "SELECT audio_path FROM books WHERE book_id=:book_id";

        $this->database->query($query);
        $this->database->bind('book_id', $book_id);

        return $this->database->fetch();
    }

    public function checkBookExistsByTitleNAuthor($title, $author_id) {
        $query = "SELECT * FROM books WHERE title=:title AND author_id = :author_id";

        $this->database->query($query);
        $this->database->bind('title', $title);
        $this->database->bind('author_id', $author_id);

        return $this->database->fetch();
    }
}

?>