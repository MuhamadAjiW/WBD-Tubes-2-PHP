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
            <td><button class="admin-buttons edit-button" id="edit-review-button">Edit</button>
            <td><button class="admin-buttons" id="delete-button">Delete</button>    
        </tr>

        <tr>
            <td>Senvis</td>
            <td>Aku Suka Kamu</td>
            <td>4.5</td>
            <td>Mantep bukunyaa keren</td>
            <td><button class="admin-buttons edit-button" id="edit-review-button">Edit</button>
            <td><button class="admin-buttons" id="delete-button">Delete</button>    
        </tr>

        <tr>
            <td>Senvis</td>
            <td>Aku Suka Kamu</td>
            <td>4.5</td>
            <td>Mantep bukunyaa keren</td>
            <td><button class="admin-buttons edit-button" id="edit-review-button">Edit</button>
            <td><button class="admin-buttons" id="delete-button">Delete</button>    
        </tr>

        <tr>
            <td>Senvis</td>
            <td>Aku Suka Kamu</td>
            <td>4.5</td>
            <td>Mantep bukunyaa keren</td>
            <td><button class="admin-buttons edit-button" id="edit-review-button">Edit</button>
            <td><button class="admin-buttons" id="delete-button">Delete</button>    
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
                <button type="button" class="delete-modal-btn" id="delete-review-btn">Delete</button>
            </div>
        </div>
    </div>
</div>

<script> // Modal for book deletion
    // Get the modal
    var deletemodal = document.getElementsByClassName("delete-modal")[0];
    
    // Get the open modal button
    var openmodalbtn = document.getElementById("delete-button");

    // Get the delete button
    var deletebtn = document.getElementById("delete-review-btn");

    // Get the cancel button
    var cancelbtn = document.getElementById("cancel-delete-btn");
    
    openmodalbtn.onclick = function() {
        deletemodal.style.display = "block";
    }

    cancelbtn.onclick = function() {
        deletemodal.style.display = "none";
    }

    // ntar diganti kalau udah jadi
    deletebtn.onclick = function() {
        deletemodal.style.display = "none";
    }

</script>