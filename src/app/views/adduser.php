<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="../../public/css/adminpage.css"></link>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
</head>
<body >

    <?php
        include __DIR__ . "/../components/adminsidebar.php";
    ?>

    <div class="main-content" id="admin-form-main-content">
        <div class="page-container-admin-form">
            <div class="admin-form-title">
                Add User Form
            </div>
            <form>
                <div class="admin-form-row">
                    <div class="admin-form-input">
                        <input type="text" required>
                        <div class="underline"></div>
                        <label for="">Name</label>
                    </div>
                    <div class="admin-form-input">
                        <input type="text" required>
                        <div class="underline"></div>
                        <label for="">Username</label>
                    </div>
                </div>
                <div class="admin-form-row">
                    <div class="admin-form-input">
                        <input type="text" required>
                        <div class="underline"></div>
                        <label for="">Email Address</label>
                    </div>
                    <div class="admin-form-input">
                        <input type="password" required>
                        <div class="underline"></div>
                        <label for="">Password</label>
                    </div>
                </div>
                <div class="admin-form-row" id="admin-form-row-textarea">
                    <div class="admin-form-input admin-form-input-textarea">
                        <textarea rows="8" cols="80" required></textarea>
                        <br />
                        <label for="">Write your bio</label>
                        <br />
                    </div>
                </div>
                <div class="admin-form-row" id="admin-form-row-checkbox">
                    <input type="checkbox" value="admin" class="add-user-form-checkbox">
                    <label for="">Admin?</label>
                </div>
                <div class="admin-form-buttons">
                    <button type="button" class="admin-form-cancel-btn" onclick="location.href='adminusers'">Cancel</button>
                    <input type="submit" class="admin-form-submit-btn">
                </div>
            </form>
        </div>
    </div>


    <script type="text/javascript" src="../../public/js/admin.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>
</html> 