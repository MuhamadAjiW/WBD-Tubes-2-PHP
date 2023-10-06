<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <link rel="stylesheet" href="../../public/css/adminpage.css"></link>
    <script type="text/javascript" src="../../public/js/edituser.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<body>
    <?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>

    <div class="main-content" id="admin-form-main-content">
        <div class="page-container-admin-form">
            <div class="admin-form-title">
                Edit User Form
            </div>
            <form action="javascript:;" onsubmit="return submitEditUserForm()" id="form-edit-user" data-user-id = <?= $userdata['user_id'] ?>>
                <div class="admin-form-row">
                    <div class="admin-form-input">
                        <input type="text" required id="edit-user-input-name" value="<?= $userdata['name'] ?>">
                        <div class="underline"></div>
                        <label for="">Name</label>
                    </div>
                    <div class="admin-form-input">
                        <input type="text" required id="edit-user-input-username" value="<?= $userdata['username'] ?>">
                        <div class="underline"></div>
                        <label for="">Username</label>
                    </div>
                </div>
                <div class="admin-form-row">
                    <div class="admin-form-input">
                        <input type="text" required id="edit-user-input-email" value="<?= $userdata['email'] ?>">
                        <div class="underline"></div>
                        <label for="">Email Address</label>
                    </div>
                    <div class="admin-form-input">
                        <input type="password" id="edit-user-input-password">
                        <div class="underline"></div>
                        <label for="">Password (Leave blank for no change)</label>
                    </div>
                </div>
                <div class="admin-form-row" id="admin-form-row-textarea">
                    <div class="admin-form-input admin-form-input-textarea">
                        <textarea rows="8" cols="80" id="edit-user-input-bio" required ><?= $userdata['bio'] ?></textarea>
                        <br />
                        <label for="">Write your bio</label>
                        <br />
                    </div>
                </div>
                <div class="admin-form-row" id="admin-form-row-checkbox">
                    <input type="checkbox" value="admin" class="add-user-form-checkbox" id="edit-user-input-admin" <?= $userdata['admin'] ? 'checked' : ''?>>
                    <label for="">Admin?</label>
                </div>
                <div class="admin-form-buttons">
                    <button type="button" class="admin-form-cancel-btn" onclick="location.href='/admin/users'">Cancel</button>
                    <input type="submit" class="admin-form-submit-btn" name="edit-user">
                </div>
            </form>
        </div>
    </div>
</body>
</html> 