<?php

namespace app\util;

use app\models\BookModel;

class Seeder {
    public function seedBooks() {
        $bookModel = new BookModel;

        $genres = [
            "Romance",
            "Fiksi",
            "Non-Fiksi",
            "Sci-fi",
            "Misteri",
            "Self-Improvement",
            "Fantasy",
            "Biografi"
        ];

        for ($i = 0; $i < 10000; $i++) {
            
            $title = "Title $i";
            $synopsis = "This is a dummy synopsis content for book Title $i.";
            $author_id = random_int(1,8);
            $genre = $genres[random_int(0,7)];
            $release_date = date("Y-m-d H:i:s");
            $word_count = random_int(1000,10000);
            $duration = random_int(100,1000);

            $graphic_cntn = false;
            $graphic_cntn_seed = random_int(0,2);
            if($graphic_cntn_seed === 1) $graphic_cntn = true;

            $data_idx = 11 + $i;
            $image_path = "/storage/images/image$data_idx.jpg";
            $audio_path = "/storage/audio/audio$data_idx.mp3";

            $bookModel->addBook($title, $synopsis, $author_id, $genre, $release_date, $word_count, $duration, $graphic_cntn, $image_path, $audio_path);
        }
    }
}