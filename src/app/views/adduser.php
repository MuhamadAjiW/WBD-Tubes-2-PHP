<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    <link rel="stylesheet" href="../../public/css/adminpage.css"></link>
    <script type="text/javascript" src="../../public/js/adduser.js"></script>
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
            <form action="javascript:;" onsubmit="return submitUserForm()">
                <div class="admin-form-row">
                    <div class="admin-form-input">
                        <input type="text" id = "add-user-input-name" required name="name">
                        <div class="underline"></div>
                        <label for="">Name</label>
                    </div>
                    <div class="admin-form-input">
                        <input type="text" id = "add-user-input-username" required name="username">
                        <div class="underline"></div>
                        <label for="">Username</label>
                    </div>
                </div>
                <div class="admin-form-row">
                    <div class="admin-form-input">
                        <input type="text" id = "add-user-input-email" required name="email">
                        <div class="underline"></div>
                        <label for="">Email Address</label>
                    </div>
                    <div class="admin-form-input">
                        <input type="password" id = "add-user-input-password" required name="password">
                        <div class="underline"></div>
                        <label for="">Password</label>
                    </div>
                </div>
                <div class="admin-form-row" id="admin-form-row-textarea">
                    <div class="admin-form-input admin-form-input-textarea">
                        <textarea rows="8" cols="80" id = "add-user-input-bio" required name="bio"></textarea>
                        <br />
                        <label for="">Write your bio</label>
                        <br />
                    </div>
                </div>
                <div class="admin-form-row" id="admin-form-row-checkbox">
                    <input type="checkbox" value="admin" id = "add-user-input-admin" class="add-user-form-checkbox">
                    <label for="">Admin?</label>
                </div>
                <div class="admin-form-buttons">
                    <button type="button" class="admin-form-cancel-btn" onclick="location.href='/admin/users'">Cancel</button>
                    <input type="submit" class="admin-form-submit-btn" name="add-user">
                </div>
            </form>
        </div>
    </div>
</body>
</html> 