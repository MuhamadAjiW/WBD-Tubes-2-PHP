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
        include "./adminsidebar.php";
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
                    <th class="review-column">Reviewer's Name</th>
                    <th class="review-column">Book Title</th>
                    <th class="review-column">Rating</th>
                    <th class="review-column">Review</th>
                    <th class="review-column" colspan="2">Action</th>
                    </tr>
                </thead>

                <tr>
                    <td>Senvis</td>
                    <td>Aku Suka Kamu</td>
                    <td>4.5</td>
                    <td>Mantep bukunyaa keren</td>
                    <td><button class="admin-buttons edit-button" id="edit-review-button1">Edit</button>
                    <td><button class="admin-buttons delete-button" id="delete-review-button1">Delete</button>    
                </tr>

                <tr>
                    <td>Senvis</td>
                    <td>Aku Suka Kamu</td>
                    <td>4.5</td>
                    <td>Mantep bukunyaa keren</td>
                    <td><button class="admin-buttons edit-button" id="edit-review-button2">Edit</button>
                    <td><button class="admin-buttons delete-button" id="delete-review-button2">Delete</button>    
                </tr>

                <tr>
                    <td>Senvis</td>
                    <td>Aku Suka Kamu</td>
                    <td>4.5</td>
                    <td>Mantep bukunyaa keren</td>
                    <td><button class="admin-buttons edit-button" id="edit-review-button3">Edit</button>
                    <td><button class="admin-buttons delete-button" id="delete-review-button3">Delete</button>    
                </tr>

                <tr>
                    <td>Senvis</td>
                    <td>Aku Suka Kamu</td>
                    <td>4.5</td>
                    <td>Mantep bukunyaa keren</td>
                    <td><button class="admin-buttons edit-button" id="edit-review-button4">Edit</button>
                    <td><button class="admin-buttons delete-button" id="delete-review-button4">Delete</button>    
                </tr>
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
                <div class="modal-body">
                    <div class="first-modal-section">
                        <div class="form-title">
                            <span class="form-title">Name</span>
                            <span class="form-title">Title</span>
                            <span class="form-title">Rating</span>
                        </div>
                        <div class="form-input">
                            <input type="text" name="reviewer_name" class="form-input" id="form-name-input" placeholder="Enter Name"/>
                            <input type="text" name="new-book-title" class="form-input" id="form-book-input" placeholder="Enter Book Title"/>
                            <input type="number" name="reviewer_rating" class="form-input" id="form-rating-input" placeholder="1-5" min="1" max="5">
                        </div>
                    </div>
                    <textarea type="text" name="reviewer_text" class="reviewer-form" id="form-review" placeholder="Enter Your Review"></textarea>
                    <button type="submit" class="submit-review-btn" id="submit-add-modal">Add Review</button>
                </div>
            </div>
        </div>

        <div class="edit-modal">
            <div class="edit-modal-content">
                <div class="modal-header">
                    <span id="close-edit-modal" class="close">&times;</span>
                    <h5 class="modal-title">Edit Review</h5>
                </div>
                <div class="modal-body">
                    <div class="first-modal-section">
                        <div class="form-title">
                            <span class="form-title">Name</span>
                            <span class="form-title">Title</span>
                            <span class="form-title">Rating</span>
                        </div>
                        <div class="form-input">
                            <input type="text" name="reviewer_name" class="form-input" id="form-name-input" placeholder="Enter Name"/>
                            <input type="text" name="new-book-title" class="form-input" id="form-book-input" placeholder="Enter Book Title"/>
                            <input type="number" name="reviewer_rating" class="form-input" id="form-rating-input" placeholder="1-5" min="1" max="5">
                        </div>
                    </div>
                    <textarea type="text" name="reviewer_text" class="reviewer-form" id="form-review" placeholder="Enter Your Review"></textarea>
                    <button type="submit" class="submit-review-btn" id="submit-edit-modal">Save Review</button>
                </div>
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
        addmodal.style.display = "none";
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
        editmodal.style.display = "none";
    }
    
</script>