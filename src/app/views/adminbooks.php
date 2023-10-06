<?php
use config\AppConfig;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Books</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<body class="gen-body">
    <?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>
    <div class="main-content first">
        <div class="gen-header cluster-h">
            <h2>List of all books</h2>
            <div class="pusher"></div>
            <button class="btn btn-yellow circular-btn" id="add-book-button" onclick="addBookPrompt()">Add Book</button>
        </div>

        <table id="book-table" class="admin-tb">
            <thead>
                <tr>
                <th class="admin-tb-c col-1">Id</th>
                <th class="admin-tb-c col-20">Title</th>
                <th class="admin-tb-c col-20">Author</th>
                <th class="admin-tb-c col-20">Word Count</th>
                <th class="admin-tb-c col-20">Duration</th>
                <th class="admin-tb-c col-20">Release Date</th>
                <th class="admin-tb-c admin-tb-edge col-2">Action</th>
                </tr>
            </thead>
            <tbody id="book-entries" class="admin-tb-body">
            <?php foreach ($bookdata as $book): ?>
            <tr>
                <td class="admin-tb-e"><?= $book['book_id'] ?></td>
                <td class="admin-tb-e"><?= $book['title'] ?></td>
                <td class="admin-tb-e"><?= $book['name'] ?></td>
                <td class="admin-tb-e"><?= $book['word_count'] ?></td>
                <td class="admin-tb-e"><?= $book['duration'] ?></td>
                <td class="admin-tb-e"><?= $book['release_date'] ?></td>
                <td class="admin-tb-e admin-tb-cent">
                <button class="btn btn-sm btn-grey" style="flex:1" data-book-id ="<?= $book['book_id'] ?>" onclick="editBookPrompt(<?= $book['book_id'] ?>)">Edit</button>
                <div style="width: 5px;"></div>
                <button class="btn btn-sm btn-red" style="flex:1" data-book-id ="<?= $book['book_id'] ?>" onclick="deleteBookPrompt(<?=$book['book_id']?>)">Delete</button>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div id="page-buttons">
            <?php
                $data = [
                    'pagelen' => intval(ceil($booklen / $pagelen)),
                    'currentpage' => $currentpage,
                    'clickfunction' => 'changePage',
                ];
                extract($data);
                include '../app/components/PageIndex.php';
            ?>
        </div>
    </div>
    <?php if(file_exists($FOOTER)) include_once($FOOTER);?>
    
    <div id="bookmodal" class="fullscreen centered modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Book</h5>
                <span id="close-book" class="close"
                    onclick="document.getElementById('bookmodal').style.display = 'none'";
                >&times;</span>
            </div>
            <form class="modal-body">
                <input id="book-id-input" hidden>
                <div class="cluster-h" style="width:100%;">
                    <div class="input-bar" style="margin: 15px 0;flex:1;">
                        <input required id="title-input" name="title-input" type="text" class="input" style="flex:1;" placeholder="Title">
                    </div>
                    <div class="input-bar" style="margin: 15px 0;flex:1;">
                        <input required id="username-input" name="username-input" type="text" class="input" style="flex:1;" placeholder="Author Username">
                    </div>
                </div>
                <div class="cluster-h" style="width:100%;">
                    <div class="input-bar" style="margin: 15px 0;flex:1;">
                        <input required id="genre-input" name="genre-input" type="text" class="input" style="flex:1;" placeholder="Genre">
                    </div>
                    <div class="input-bar" style="margin: 15px 0;flex:1;">
                        <input required id="release-input" name="release-input" type="date" class="input" style="flex:1;" placeholder="Release Date">
                    </div>
                </div>
                <div class="cluster-h" style="width:100%;">
                    <div class="input-bar" style="margin: 15px 0;flex:1;">
                        <input required id="word-count-input" name="word-count-input" type="text" class="input" style="flex:1;" placeholder="Word Count">
                    </div>
                    <div class="input-bar" style="margin: 15px 0;flex:1;">
                        <input required id="duration-input" name="duration-input" type="text" class="input" style="flex:1;" placeholder="Duration in minutes">
                    </div>
                </div>
                <textarea required id="synopsis-input" type="text" class="long-form" placeholder="Enter Synopsis"></textarea>
                <div style="height: 15px;"></div>
                <div>
                    <label for="">Insert book cover</label>
                    <div>
                        <input type="file" accept="image/*" required id="add-book-form-image">
                    </div>
                    <div style="height:15px"></div>
                    <label for="">Insert audio file</label>
                    <div>
                        <input type="file" accept="audio/*" required id="add-book-form-audio">
                    </div>
                </div>
                <div class="cluster-h" style="min-width:100%;padding: 5px 0">
                    <input id="gc-input" name="gc-input" type="checkbox"  value="0"/>
                    <label for="gc-input" class="input">Graphic Content</label>
                    <div class="pusher"></div>
                    <button id="submit-book" type="button" class="btn btn-yellow circular-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
    
    <?php include "../app/components/ConfirmModal.php"?>

    <script type="text/javascript" src="/public/js/adminbook.js"></script>
</body>
</html> 
