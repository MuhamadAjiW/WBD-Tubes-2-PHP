<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Review</title>
    <link rel="stylesheet" href="../../public/css/adminpage.css"></link>
    <script type="text/javascript" src="../../public/js/addreview.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body >

    <?php
        include __DIR__ . "/../components/adminsidebar.php";
    ?>

    <div class="main-content" id="admin-form-main-content">
        <div class="page-container-admin-form">
            <div class="admin-form-title">
                Add Review Form
            </div>
            <form action="javascript:;" onsubmit="return submitAddReviewForm()">
                <div class="admin-form-row">
                    <div class="admin-form-input">
                        <input type="text" id = "add-review-input-username" required name="username">
                        <div class="underline"></div>
                        <label for="">Username</label>
                    </div>
                    <div class="admin-form-input">
                        <input type="text" id = "add-review-input-title" required name="title">
                        <div class="underline"></div>
                        <label for="">Title</label>
                    </div>
                </div>
                <div class="admin-form-row">
                    <div class="admin-form-input">
                        <input type="number" id = "add-review-input-rating" required name="rating" min="1" max="5">
                        <div class="underline"></div>
                        <label for="">Rating</label>
                    </div>
                </div>
                <div class="admin-form-row" id="admin-form-row-textarea">
                    <div class="admin-form-input admin-form-input-textarea">
                        <textarea rows="8" cols="80" id = "add-review-input-reviewtext" required name="reviewtext"></textarea>
                        <br />
                        <label for="">Write your review</label>
                        <br />
                    </div>
                </div>
                <div class="admin-form-buttons" id = "add-review-form-buttons">
                    <button type="button" class="admin-form-cancel-btn" onclick="location.href='/admin/reviews'">Cancel</button>
                    <input type="submit" class="admin-form-submit-btn" id = "submit-button-add-review" name="add-review">
                </div>
            </form>
        </div>
    </div>
</body>
</html> 