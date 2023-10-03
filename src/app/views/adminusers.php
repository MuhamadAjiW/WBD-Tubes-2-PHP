<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Users</title>
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
                <h2>List of all Users</h2>
                <button class="admin-buttons add-button" id="add-user-button" onclick="location.href='/adduser'">Add User</button>
            </div>
            
            <table class="user-table">
                <thead>
                    <tr>
                    <th class="user-column">Username</th>
                    <th class="user-column">Email</th>
                    <th class="user-column">Name</th>
                    <th class="user-column">Bio</th>
                    <th class="user-column" colspan="2">Action</th>
                    </tr>
                </thead>
                <tr>
                    <td>Senvis</td>
                    <td>13521127@std.stei.itb.ac.id</td>
                    <td>Marcel Ryan Antony</td>
                    <td>Suka kulineran gann</td>
                    <td><button class="admin-buttons edit-button" id="edit-user-button">Edit</button>
                    <td><button class="admin-buttons delete-button" id="user-delete-button1">Delete</button>            
                </tr>
                <tr>
                    <td>Senvis</td>
                    <td>13521127@std.stei.itb.ac.id</td>
                    <td>Marcel Ryan Antony</td>
                    <td>Suka kulineran gann</td>
                    <td><button class="admin-buttons edit-button" id="edit-user-button">Edit</button>
                    <td><button class="admin-buttons delete-button" id="user-delete-button2">Delete</button>            
                </tr>
                <tr>
                    <td>Senvis</td>
                    <td>13521127@std.stei.itb.ac.id</td>
                    <td>Marcel Ryan Antony</td>
                    <td>Suka kulineran gann</td>
                    <td><button class="admin-buttons edit-button" id="edit-user-button">Edit</button>
                    <td><button class="admin-buttons delete-button" id="user-delete-button3">Delete</button>            
                </tr>
                
            </table>
        </div>

        <div class="delete-modal">
            <div class="delete-modal-content">
                <div class="delete-container">
                    <h1 class = "delete-modal-title">Delete User</h1>
                    <p class = "delete-modal-text">Are you sure you want to delete this user?</p>

                    <div class="delete-modal-buttons">
                        <button type="button" class="delete-modal-btn" id="cancel-delete-btn">Cancel</button>
                        <button type="button" class="delete-modal-btn" id="modal-delete-user-btn">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript" src="../../public/js/admin.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html>

<script> // Modal for book deletion
    // Get the modal
    var deletemodal = document.getElementsByClassName("delete-modal")[0];
    
    // Get the open modal button
    document.addEventListener("click", function() {
        if (event.target.classList.toString() == "admin-buttons delete-button") {
            deletemodal.style.display = "block";
        }
    })

    // Get the delete button
    var deletebtn = document.getElementById("delete-user-btn");

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