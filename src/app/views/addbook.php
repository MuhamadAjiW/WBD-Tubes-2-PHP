<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/css/adminpage.css"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"></link>
    <title>Add Book</title>
</head>
<body>

    <?php
        include __DIR__ . "/adminsidebar.php";
    ?>

    <div class="main-content" id="add-book-form-main-content">
        <form class="page-container-add-book-form">
            <div class="page-header">
                <h1>Add Book Form</h1>
            </div>

            <div class="page-body">
                <div class="form-container">
                    <input type="text" class="add-book-form" id="add-book-title-form" placeholder="Enter Book Title">
                    <input type="text" class="add-book-form" id="add-book-author-form" placeholder="Enter Book Author">
                    <input type="text" class="add-book-form" id="add-book-genre-form" placeholder="Enter Book Genre">
                    <textarea type="text" class="add-book-form" id="add-book-synopsis-form" placeholder="Enter Book Synopsis"></textarea>
                    <label>
                        Enter release date: 
                        <input type="date" class="add-book-form" id="add-book-date-form">
                    </label>
                    <label>
                        Enter book word count: 
                        <input type="number" class="add-book-form" id="add-book-word-form">
                    </label>
                    <label>
                        Enter duration in minutes: 
                        <input type="number" class="add-book-form" id="add-book-duration-form">
                    </label>
                    <div class = "add-book-form" id="graphic-content-section">
                        Contains graphic content:<br>
                        <input type="radio" name="graphic-content" value="Yes">
                        <label for="yes">Yes</label><br>
                        <input type="radio" name="graphic-content" value="No">
                        <label for="no">No</label>
                    </div>
                    <label>
                        Insert image:
                        <input type="file" class="add-book-form" id="add-book-image-form" accept="image/*">
                    </label>
                    <label>
                        Insert audio:
                        <input type="file" class="add-book-form" id="add-book-audio-form" accept="audio/*">
                    </label>
                    <div class="add-book-form-buttons">
                        <button type="button" class="add-book-form-buttons" id="cancel-add-book-btn" onclick="showBooks(); resetBackground();">Cancel</button>
                        <button type="submit" class="add-book-form-buttons" id="add-new-book-btn" onclick="showBooks(); resetBackground();">Add New Book</button>
                    </div>
                </div>
            </div>
        </form>
    </div>


</body>
</html>