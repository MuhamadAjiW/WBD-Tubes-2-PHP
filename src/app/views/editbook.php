<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Book</title>
    <link rel="stylesheet" href="../../public/css/adminpage.css"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script type="text/javascript" src="../../public/js/editbook.js"></script>
</head>
<body >

    <?php
        include __DIR__ . "/../components/adminsidebar.php";
    ?>

    <div class="main-content" id="admin-form-main-content">
        <div class="page-container-admin-form" id="admin-book-form-container">
            <div class="admin-form-title">
                Edit Book Form
            </div>
            <form action="javascript:;" onsubmit="return submitEditBookForm()">
                <div class="admin-form-row">
                    <div class="admin-form-input">
                        <input type="text" required id="edit-book-input-title" value="<?= $bookdata['title'] ?>">
                        <div class="underline"></div>
                        <label for="">Title</label>
                    </div>
                    <div class="admin-form-input">
                        <input type="text" required id="edit-book-input-author" value="<?= $bookdata['username'] ?>">
                        <div class="underline"></div>
                        <label for="">Author Name</label>
                    </div>
                </div>
                <div class="admin-form-row">
                    <div class="admin-form-input">
                        <input type="text" required id="edit-book-input-genre" value="<?= $bookdata['genre'] ?>">
                        <div class="underline"></div>
                        <label for="">Genre</label>
                    </div>
                    <div class="admin-form-input">
                        <input type="date" required id="edit-book-input-date" value="<?= $bookdata['release_date'] ?>">
                        <div class="underline"></div>
                        <label for="">Release Date</label>
                    </div>
                </div>
                <div class="admin-form-row">
                    <div class="admin-form-input">
                        <input type="number" required id="edit-book-input-wordcount" value=<?= $bookdata['word_count'] ?>>
                        <div class="underline"></div>
                        <label for="">Word Count</label>
                    </div>
                    <div class="admin-form-input">
                        <input type="number" required id="edit-book-input-duration" value=<?= $bookdata['duration'] ?>>
                        <div class="underline"></div>
                        <label for="">Duration in minutes</label>
                    </div>
                </div>
                <div class="admin-form-row" id="admin-form-row-textarea">
                    <div class="admin-form-input admin-form-input-textarea">
                        <textarea rows="8" cols="80" required id="edit-book-input-synopsis"><?= $bookdata['synopsis'] ?></textarea>
                        <br />
                        <label for="">Book synopsis</label>
                        <br />
                    </div>
                </div>
                <div class="admin-form-row admin-form-row-file">
                    <div class="admin-form-input-file">
                        <label for="">Insert book cover</label>
                        <input type="file" accept="image/*" required id="edit-book-input-image">
                        <div class="underline"></div>
                    </div>
                    <div class="admin-form-input-file">
                        <label for="">Insert audio file</label>
                        <input type="file" accept="audio/*" required id="edit-book-input-audio">
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="admin-form-row" id="admin-form-row-checkbox">
                    <input type="checkbox" value="graphic" class="add-book-form-checkbox" id="edit-book-input-graphic" <?= $bookdata['graphic_cntn'] ? 'checked' : ''?>>
                    <label for="">Contains graphic content?</label>
                </div>
                <div class="admin-form-buttons">
                    <button type="button" class="admin-form-cancel-btn" onclick="location.href='/admin/books'">Cancel</button>
                    <input type="submit" class="admin-form-submit-btn" name="edit-booK">
                </div>
            </form>
        </div>
    </div>
</body>
</html> 