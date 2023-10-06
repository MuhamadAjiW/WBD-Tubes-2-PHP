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
            <!-- TODO: Pagination -->
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




<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Books</title>
    <link rel="stylesheet" href="/public/css/adminpage.css"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script type="text/javascript" src="/public/js/deletebook.js"></script>
    <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<body>
    <?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>

    <div class="main-content">
        <div class="page-container">
            <div class="page-header">
                <h2>List of all Books</h2>
                <button class="admin-buttons add-button" id="add-book-button" onclick="location.href='/admin/addbook'">Add Book</button>
            </div>
            <table class="book-table">
                <thead>
                    <tr>
                    <th class="book-column">Book ID</th>
                    <th class="book-column">Title</th>
                    <th class="book-column">Release date</th>
                    <th class="book-column">Author</th>
                    <th class="book-column" colspan="2">Action</th>
                    </tr>
                </thead>
                <?php foreach ($bookdata as $book): ?>
                    <tr>
                        <td><?= $book['book_id'] ?></td>
                        <td><?= $book['title'] ?></td>
                        <td><?= $book['release_date'] ?></td>
                        <td><?= $book['name'] ?></td>
                        <td><button class="admin-buttons edit-button" data-book-id="<?= $book['book_id'] ?>" onclick="editBookURL(<?= $book['book_id'] ?>)">Edit</button></td>
                        <td><button class="admin-buttons delete-button" data-book-id="<?= $book['book_id'] ?>">Delete</button></td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="delete-modal">
            <div class="delete-modal-content">
                <div class="delete-container">
                    <h1 class = "delete-modal-title">Delete Book</h1>
                    <p class = "delete-modal-text">Are you sure you want to delete this book?</p>

                    <div class="delete-modal-buttons">
                        <button type="button" class="delete-modal-btn" id="cancel-delete-btn">Cancel</button>
                        <button type="button" class="delete-modal-btn" id="modal-delete-book-btn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<script>
    function editBookURL(bookID) {
        const editURL = `/admin/editbook?book_id=${bookID}`;

        window.location.href = editURL;
    }
</script>

<script> // Modal for book deletion
    // Get the modal
    var deletemodal = document.getElementsByClassName("delete-modal")[0];
    
    // Get the open modal button
    document.addEventListener("click", function() {
        if (event.target.classList.toString() == "admin-buttons delete-button") {
            deletemodal.style.display = "block";
            var bookID = event.target.getAttribute("data-book-id");

            document.getElementById("modal-delete-book-btn").setAttribute("data-book-id", bookID);
        }
    })


    // Get the delete button
    var deletebtn = document.getElementById("modal-delete-book-btn");

    // Get the cancel button
    var cancelbtn = document.getElementById("cancel-delete-btn");

    cancelbtn.onclick = function() {
        deletemodal.style.display = "none";
    }

    // ntar diganti kalau udah jadi
    deletebtn.onclick = function() {
        deleteBook(document.getElementById("modal-delete-book-btn").getAttribute("data-book-id"));
        deletemodal.style.display = "none";
    }

</script> -->