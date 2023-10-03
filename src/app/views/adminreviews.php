<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Reviews</title>
    <link rel="stylesheet" href="../../public/css/adminpage.css"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body>

    <?php
        include __DIR__ . "/../components/adminsidebar.php";
    ?>

    <div class="main-content">
        <div class="page-container">
            <div class="page-header">
                <h2>List of all Reviews</h2>
                <button class="admin-buttons add-button" id="add-review-button">Add Review</button>
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
                    <td><button class="admin-buttons edit-button" data-review-book-id ="<?= $review['book_id'] ?>" data-review-user-id = "<?= $review['user_id'] ?>">Edit</button>
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

        <div class="add-modal">
            <div class="add-modal-content">
                <div class="modal-header">
                    <span id="close-add-modal" class="close">&times;</span>
                    <h5 class="modal-title">Add Review</h5>
                </div>
                <form class="modal-body">
                    <div class="first-modal-section">
                        <div class="form-title">
                            <span class="form-title">Username</span>
                            <span class="form-title">Title</span>
                            <span class="form-title" id="add-modal-rating">Rating</span>
                        </div>
                        <div class="form-input">
                            <input type="text" class="form-input" id="form-name-input" placeholder="Enter Name" required/>
                            <input type="text" class="form-input" id="form-book-input" placeholder="Enter Book Title" required/>
                            <input type="number" class="form-input" id="form-add-rating-input" placeholder="1-5" min="1" max="5" required>
                        </div>
                    </div>
                    <textarea type="text" class="reviewer-form" id="form-review" placeholder="Enter Your Review" required></textarea>
                    <button type="submit" class="submit-review-btn" id="submit-add-modal">Add Review</button>
                </form>
            </div>
        </div>

        <div class="edit-modal">
            <div class="edit-modal-content">
                <div class="modal-header">
                    <span id="close-edit-modal" class="close">&times;</span>
                    <h5 class="modal-title">Edit Review</h5>
                </div>
                <form class="modal-body">
                    <div class="first-modal-section">
                        <div class="form-title">
                            <span class="form-title">Rating</span>
                        </div>
                        <div class="form-input">
                            <input type="number" class="form-input" id="form-rating-input" placeholder="1-5" min="1" max="5">
                        </div>
                    </div>
                    <textarea type="text" class="reviewer-form" id="form-reviewtext-input" placeholder="Enter Your Review"></textarea>
                    <button type="submit" class="submit-review-btn" id="submit-edit-modal">Save Review</button>
                </form>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="../../public/js/admin.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html> 

<script> // Modal for review deletion
    // Get the modal
    var deletemodal = document.getElementsByClassName("delete-modal")[0];
    
    // Get the open modal button
    document.addEventListener("click", function() {
        if (event.target.classList.toString() == "admin-buttons delete-button") {
            deletemodal.style.display = "block";

            var bookID = event.target.getAttribute("data-review-book-id");
            var userID = event.target.getAttribute("data-review-user-id");
        }
    })

    // Get the delete button
    var deletebtn = document.getElementById("delete-review-btn");

    // Get the cancel button
    var cancelbtn = document.getElementById("cancel-delete-btn");
    
    // openmodalbtn.onclick = function() {
    //     deletemodal.style.display = "block";
    // }

    cancelbtn.onclick = function() {
        deletemodal.style.display = "none";
    }

    // ntar diganti kalau udah jadi
    deletebtn.onclick = function() {
        deletemodal.style.display = "none";
    }

</script>

<script> // Modal for adding review
    // Get modal
    var addmodal = document.getElementsByClassName("add-modal")[0];
    
    // Get open modal button
    var openbtnaddmodal = document.getElementById("add-review-button");

    console.log(openbtnaddmodal)

    // Get close button
    var closebtnaddmodal = document.getElementById("close-add-modal");

    // Get submit button
    var submitbtnaddmodal = document.getElementById("submit-add-modal");
    
    openbtnaddmodal.onclick = function() {
        addmodal.style.display = "block";
    }

    closebtnaddmodal.onclick = function() {
        addmodal.style.display = "none";
    }

    submitbtnaddmodal.onclick = function() {
        
        // Validate the required fields
        var nameInput = document.getElementById("form-name-input");
        var bookInput = document.getElementById("form-book-input");
        var ratingInput = document.getElementById("form-add-rating-input");
        var reviewtextInput = document.getElementById("form-reviewtext-input");

        if (nameInput.value.trim() === "" || bookInput.value.trim() === "" || ratingInput.value.trim() === "" || reviewtextInput.value.trim() === "") {
            alert("Please fill in all required fields");
        }

        else {
            addmodal.style.display = "none";
        }
    }
    
</script>

<script> // Modal for editing review
    // Get modal
    var editmodal = document.getElementsByClassName("edit-modal")[0];
    
    // Get open modal button
    document.addEventListener("click", function() {
        if (event.target.classList.toString() == "admin-buttons edit-button") {
            editmodal.style.display = "block";
        }
    })

    // Get close button
    var closebtneditmodal = document.getElementById("close-edit-modal");

    // Get submit button
    var submitbtneditmodal = document.getElementById("submit-edit-modal");
    
    // openbtneditmodal.onclick = function() {
    //     editmodal.style.display = "block";
    // }

    closebtneditmodal.onclick = function() {
        editmodal.style.display = "none";
    }

    submitbtneditmodal.onclick = function() {
        // Validate the required fields
        var nameInput = document.getElementById("form-name-input");
        var bookInput = document.getElementById("form-book-input");
        var ratingInput = document.getElementById("form-add-rating-input");
        var reviewtextInput = document.getElementById("form-reviewtext-input");

        if (nameInput.value.trim() === "" || bookInput.value.trim() === "" || ratingInput.value.trim() === "" || reviewtextInput.value.trim() === "") {
            alert("Please fill in all required fields");
        }

        else {
            editmodal.style.display = "none";
        }
    }
    
</script>