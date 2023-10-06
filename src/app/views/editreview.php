<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Review</title>
    <link rel="stylesheet" href="../../public/css/adminpage.css"></link>
    <script type="text/javascript" src="../../public/js/editreview.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<body>
    <?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>

    <div class="main-content" id="admin-form-main-content">
        <div class="page-container-admin-form">
            <div class="admin-form-title">
                Edit Review Form
            </div>
            <form action="javascript:;" onsubmit="return submitEditReviewForm()" id="form-edit-review" data-review-user-id = <?= $reviewdata['user_id'] ?> data-review-book-id = <?= $reviewdata['book_id'] ?>>
                <div class="admin-form-row">
                    <div class="admin-form-input">
                        <input type="text" id = "edit-review-input-username" required name="username" value="<?= $reviewdata['username'] ?>">
                        <div class="underline"></div>
                        <label for="">Username</label>
                    </div>
                    <div class="admin-form-input">
                        <input type="text" id = "edit-review-input-title" required name="title" value="<?= $reviewdata['title'] ?>">
                        <div class="underline"></div>
                        <label for="">Title</label>
                    </div>
                </div>
                <div class="admin-form-row">
                    <div class="admin-form-input">
                        <input type="number" id = "edit-review-input-rating" required name="rating" min="1" max="5" value="<?= $reviewdata['rating'] ?>">
                        <div class="underline"></div>
                        <label for="">Rating</label>
                    </div>
                </div>
                <div class="admin-form-row" id="admin-form-row-textarea">
                    <div class="admin-form-input admin-form-input-textarea">
                        <textarea rows="8" cols="80" id = "edit-review-input-reviewtext" required name="reviewtext"><?= $reviewdata['reviewtext'] ?></textarea>
                        <br />
                        <label for="">Write your review</label>
                        <br />
                    </div>
                </div>
                <div class="admin-form-buttons" id = "edit-review-form-buttons">
                    <button type="button" class="admin-form-cancel-btn" onclick="location.href='/admin/reviews'">Cancel</button>
                    <input type="submit" class="admin-form-submit-btn" id = "submit-button-edit-review" name="edit-review">
                </div>
            </form>
        </div>
    </div>
</body>
</html>