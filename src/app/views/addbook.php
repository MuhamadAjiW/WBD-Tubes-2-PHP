<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Book</title>
    <link rel="stylesheet" href="../../public/css/adminpage.css"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body >

    <?php
        include __DIR__ . "/../components/adminsidebar.php";
    ?>

    <div class="main-content" id="admin-form-main-content">
        <div class="page-container-admin-form" id="admin-book-form-container">
            <div class="admin-form-title">
                Add Book Form
            </div>
            <form action="javascript:;" enctype="multipart/form-data" onsubmit="return submitAddBookForm()">
                <div class="admin-form-row">
                    <div class="admin-form-input">
                        <input type="text" required id="add-book-form-title">
                        <div class="underline"></div>
                        <label for="">Title</label>
                    </div>
                    <div class="admin-form-input">
                        <input type="text" required id="add-book-form-username">
                        <div class="underline"></div>
                        <label for="">Author Name</label>
                    </div>
                </div>
                <div class="admin-form-row">
                    <div class="admin-form-input">
                        <input type="text" required id="add-book-form-genre">
                        <div class="underline"></div>
                        <label for="">Genre</label>
                    </div>
                    <div class="admin-form-input">
                        <input type="date" required id="add-book-form-date">
                        <div class="underline"></div>
                        <label for="">Release Date</label>
                    </div>
                </div>
                <div class="admin-form-row">
                    <div class="admin-form-input">
                        <input type="number" min="1" max="5" required id="add-book-form-wordcount">
                        <div class="underline"></div>
                        <label for="">Word Count</label>
                    </div>
                    <div class="admin-form-input">
                        <input type="number" required id="add-book-form-duration">
                        <div class="underline"></div>
                        <label for="">Duration in minutes</label>
                    </div>
                </div>
                <div class="admin-form-row" id="admin-form-row-textarea">
                    <div class="admin-form-input admin-form-input-textarea">
                        <textarea rows="8" cols="80" required id="add-book-form-synopsis"></textarea>
                        <br />
                        <label for="">Book synopsis</label>
                        <br />
                    </div>
                </div>
                <div class="admin-form-row admin-form-row-file">
                    <div class="admin-form-input-file">
                        <label for="">Insert book cover</label>
                        <input type="file" accept="image/*" required id="add-book-form-image">
                        <div class="underline"></div>
                    </div>
                    <div class="admin-form-input-file">
                        <label for="">Insert audio file</label>
                        <input type="file" accept="audio/*" required id="add-book-form-audio">
                        <div class="underline"></div>
                    </div>
                </div>
                <div class="admin-form-row" id="admin-form-row-checkbox">
                    <input type="checkbox" value="admin" class="add-book-form-checkbox" id="add-book-form-graphic">
                    <label for="">Contains graphic content?</label>
                </div>
                <div class="admin-form-buttons">
                    <button type="button" class="admin-form-cancel-btn" onclick="location.href='/admin/books'">Cancel</button>
                    <input type="submit" class="admin-form-submit-btn" name="add-book">
                </div>
            </form>
        </div>
    </div>


    <script type="text/javascript" src="../../public/js/addbook.js"></script>
</body>
</html> 