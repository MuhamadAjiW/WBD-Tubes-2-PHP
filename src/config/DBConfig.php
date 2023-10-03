<?php

namespace config;

class DBConfig{
    public static function getHost() {
        return getenv('POSTGRES_HOST');
    }
    public static function getName() {
        return getenv('POSTGRES_DB');
    }
    public static function getPort() {
        return getenv('POSTGRES_PORT');
    }
    public static function getUser() {
        return getenv('POSTGRES_USER');
    }
    public static function getPassword() {
        return getenv('POSTGRES_PASSWORD');
    }

    public const USER_TABLE_INIT =
    "CREATE TABLE IF NOT EXISTS users (
        user_id         SERIAL          PRIMARY KEY,
        email           VARCHAR(256)    UNIQUE NOT NULL,
        username        VARCHAR(256)    UNIQUE NOT NULL,
        password        VARCHAR(256)    NOT NULL,
        name            VARCHAR(256)    NOT NULL,
        bio             VARCHAR(2048)   DEFAULT '' NOT NULL,
        admin           BOOLEAN         DEFAULT FALSE NOT NULL
    );";

    public const BOOK_TABLE_INIT =
    "CREATE TABLE IF NOT EXISTS books (
        book_id         SERIAL          PRIMARY KEY,
        title           VARCHAR(256)    NOT NULL,
        synopsis        VARCHAR(2048)   DEFAULT '' NOT NULL,
        author_id       INT             NOT NULL,
        genre           VARCHAR(256)    NOT NULL,
        release_date    DATE            NOT NULL,
        word_count      INT             NOT NULL,
        duration        INT             NOT NULL,
        graphic_cntn    BOOLEAN         NOT NULL,
        image_path      VARCHAR(256)    NOT NULL,
        audio_path      VARCHAR(256)    NOT NULL,
        FOREIGN KEY (author_id) REFERENCES users(user_id)
                                            ON DELETE CASCADE
                                            ON UPDATE CASCADE
    );";

    public const REVIEW_TABLE_INIT =
    "CREATE TABLE IF NOT EXISTS reviews (
        book_id         INT,
        user_id         INT,
        rating          INT             NOT NULL CHECK (rating BETWEEN 1 AND 5),
        reviewtext      VARCHAR(2048)   DEFAULT '' NOT NULL,
        PRIMARY KEY (book_id, user_id),
        FOREIGN KEY (user_id) REFERENCES users(user_id) 
                                            ON DELETE CASCADE
                                            ON UPDATE CASCADE,
        FOREIGN KEY (book_id) REFERENCES books(book_id) 
                                            ON DELETE CASCADE
                                            ON UPDATE CASCADE
    );";
}

?>