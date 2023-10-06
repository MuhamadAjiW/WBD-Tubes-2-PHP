<?php
use config\AppConfig;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reviews</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<body class="gen-body">
    <?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>
    <div class="main-content first">
        <div class="gen-header cluster-h">
            <h2>List of all Reviews</h2>
            <div class="pusher"></div>
            <button class="btn btn-yellow circular-btn" id="add-review-button" onclick="addReviewPrompt()">Add Review</button>
        </div>

        <table id="review-table" class="admin-tb">
            <!-- TODO: Pagination -->
            <thead>
                <tr>
                <th class="admin-tb-c col-20">Username</th>
                <th class="admin-tb-c col-20">Book Title</th>
                <th class="admin-tb-c col-1">Rating</th>
                <th class="admin-tb-c col-50">Review</th>
                <th class="admin-tb-c admin-tb-edge col-2">Action</th>
                </tr>
            </thead>
            <tbody id="review-entries" class="admin-tb-body">
            <?php foreach ($reviewdata as $review): ?>
            <tr>
                <td class="admin-tb-e"><?= $review['username'] ?></td>
                <td class="admin-tb-e"><?= $review['title'] ?></td>
                <td class="admin-tb-e"><?= $review['rating'] ?></td>
                <td class="admin-tb-e"><?= $review['reviewtext'] ?></td>
                <td class="admin-tb-e admin-tb-cent">
                <button class="btn btn-sm btn-grey" style="flex:1" data-review-book-id ="<?= $review['book_id'] ?>" data-review-user-id = "<?= $review['user_id'] ?>" onclick="editReviewPrompt(<?= $review['user_id'] ?>, <?= $review['book_id']?>)">Edit</button>
                <div style="width: 5px;"></div>
                <button class="btn btn-sm btn-red" style="flex:1" data-review-book-id ="<?= $review['book_id'] ?>" data-review-user-id = "<?= $review['user_id'] ?>" onclick="deleteReviewPrompt(<?=$review['user_id']?>,<?=$review['book_id']?>)">Delete</button>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div id="page-buttons">
            <?php
                $data = [
                    'pagelen' => intval(ceil($reviewlen / $pagelen)),
                    'currentpage' => $currentpage,
                    'clickfunction' => 'changePage',
                ];
                extract($data);
                include '../app/components/PageIndex.php';
            ?>
        </div>
    </div>
    <?php if(file_exists($FOOTER)) include_once($FOOTER);?>
    
    <div id="reviewmodal" class="fullscreen centered modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit Review</h5>
                <span id="close-review" class="close"
                    onclick="document.getElementById('reviewmodal').style.display = 'none'";
                >&times;</span>
            </div>
            <form class="modal-body">
                <label for="userid">User ID:</label>
                <input required id="userid-input" name="userid" type="number" class="form-input">
                <label for="bookid">Book ID:</label>
                <input required id="bookid-input" name="bookid" type="number" class="form-input">
                <div style="height: 15px;"></div>
                <input id="username" type="hidden" name="uid">
                <input id="book_id" type="hidden" name="bid">
                <textarea id="form-review" type="text" class="long-form" placeholder="Enter Review"></textarea>
                <div class="cluster-h" style="min-width:100%;padding: 5px 0">
                    <label for="ratingval">Score:</label>
                    <input required id="ratingval" name="ratingval" type="number"  class="form-input" placeholder="1-5" min="1" max="5">
                    <div class="pusher"></div>
                    <button id="submit-review" type="button" class="btn btn-yellow circular-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
    
    <?php include "../app/components/ConfirmModal.php"?>

    <script type="text/javascript" src="/public/js/adminreview.js"></script>
</body>
</html> 