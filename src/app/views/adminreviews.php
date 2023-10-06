<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reviews</title>
    <link rel="stylesheet" href="../../public/css/adminpage.css"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <script type="text/javascript" src="../../public/js/adminreview.js"></script>
    <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<body>
    <?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>

    <div class="main-content">
        <div class="page-container">
            <div class="page-header">
                <h2>List of all Reviews</h2>
                <button class="admin-buttons add-button" id="add-review-button" onclick="location.href='/admin/addreview'">Add Review</button>
            </div>

            <table class="review-table">
                <thead>
                    <tr>
                    <th class="review-column">Username</th>
                    <th class="review-column">Book Title</th>
                    <th class="review-column">Rating</th>
                    <th class="review-column">Review</th>
                    <th class="review-column" colspan="2">Action</th>
                    </tr>
                </thead>
                <?php foreach ($reviewdata as $review): ?>
                <tr>
                    <td><?= $review['username'] ?></td>
                    <td><?= $review['title'] ?></td>
                    <td><?= $review['rating'] ?></td>
                    <td><?= $review['reviewtext'] ?></td>
                    <td><button class="admin-buttons edit-button" data-review-book-id ="<?= $review['book_id'] ?>" data-review-user-id = "<?= $review['user_id'] ?>" onclick="editReviewURL(<?= $review['user_id'] ?>, <?= $review['book_id']?>)">Edit</button>
                    <td><button class="admin-buttons delete-button" data-review-book-id ="<?= $review['book_id'] ?>" data-review-user-id = "<?= $review['user_id'] ?>">Delete</button>    
                </tr>
                <?php endforeach; ?>
            </table>
        </div>

        <div class="delete-modal">
            <div class="delete-modal-content">
                <div class="delete-container">
                    <h1 class = "delete-modal-title">Delete Review</h1>
                    <p class = "delete-modal-text">Are you sure you want to delete this review?</p>

                    <div class="delete-modal-buttons">
                        <button type="button" class="delete-modal-btn" id="cancel-delete-btn">Cancel</button>
                        <button type="button" class="delete-modal-btn" id="modal-delete-review-btn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html> 

<script>
    function editReviewURL(userID, bookID) {
        const editURL = `/admin/editreview?user_id=${userID}&book_id=${bookID}`;

        window.location.href = editURL;
    }
</script>

<script> // Modal for review deletion
    // Get the modal
    var deletemodal = document.getElementsByClassName("delete-modal")[0];
    
    // Get the open modal button
    document.addEventListener("click", function() {
        if (event.target.classList.toString() == "admin-buttons delete-button") {
            deletemodal.style.display = "block";

            var bookID = event.target.getAttribute("data-review-book-id");
            var userID = event.target.getAttribute("data-review-user-id");

            document.getElementById("modal-delete-review-btn").setAttribute("data-review-book-id", bookID);
            document.getElementById("modal-delete-review-btn").setAttribute("data-review-user-id", userID);
        }
    })

    // Get the delete button
    var deletebtn = document.getElementById("modal-delete-review-btn");

    // Get the cancel button
    var cancelbtn = document.getElementById("cancel-delete-btn");


    cancelbtn.onclick = function() {
        deletemodal.style.display = "none";
    }

    // ntar diganti kalau udah jadi
    deletebtn.onclick = function() {
        deleteReview(document.getElementById("modal-delete-review-btn").getAttribute("data-review-book-id"), document.getElementById("modal-delete-review-btn").getAttribute("data-review-user-id"));
        deletemodal.style.display = "none";
    }

</script>