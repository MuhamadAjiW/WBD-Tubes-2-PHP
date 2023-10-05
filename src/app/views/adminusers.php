<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Users</title>
    <link rel="stylesheet" href="../../public/css/adminpage.css"></link>
    <script type="text/javascript" src="../../public/js/deleteuser.js"></script>
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
                <button class="admin-buttons add-button" id="add-user-button" onclick="location.href='/admin/adduser'">Add User</button>
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
                <?php foreach($userdata as $user): ?>
                    <tr>
                        <td><?= $user['username'] ?></td>
                        <td><?= $user['email'] ?></td>
                        <td><?= $user['name'] ?></td>
                        <td><?= $user['bio'] ?></td>
                        <td><button class="admin-buttons edit-button" data-user-id="<?= $user['user_id'] ?>" onclick="editUserURL(<?= $user['user_id'] ?>)">Edit</button></td>
                        <td><button class="admin-buttons delete-button" data-user-id="<?= $user['user_id'] ?>">Delete</button></td>
                   </tr>
                <?php endforeach; ?>
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

</body>
</html>

<script>
    function editUserURL(userID) {
        const editURL = `/admin/edituser?user_id=${userID}`;

        window.location.href = editURL;
    }
</script>

<script> // Modal for book deletion
    // Get the modal
    var deletemodal = document.getElementsByClassName("delete-modal")[0];
    
    // Get the open modal button
    document.addEventListener("click", function() {
        if (event.target.classList.toString() == "admin-buttons delete-button") {
            deletemodal.style.display = "block";

            var userID = event.target.getAttribute('data-user-id');

            document.getElementById("modal-delete-user-btn").setAttribute('data-user-id', userID);
        }
    })

    // Get the delete button
    var deletebtn = document.getElementById("modal-delete-user-btn");

    // Get the cancel button
    var cancelbtn = document.getElementById("cancel-delete-btn");
    

    cancelbtn.onclick = function() {
        deletemodal.style.display = "none";
    }

    // ntar diganti kalau udah jadi
    deletebtn.onclick = function() {
        deleteUser(document.getElementById("modal-delete-user-btn").getAttribute("data-user-id"));

        deletemodal.style.display = "none";
    }

</script>