<?php
use config\AppConfig;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Users</title>
    <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<body class="gen-body">
    <?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>
    <div class="main-content first">
        <div class="gen-header cluster-h">
            <h2>List of all users</h2>
            <div class="pusher"></div>
            <button class="btn btn-yellow circular-btn" id="add-user-button" onclick="addUserPrompt()">Add User</button>
        </div>

        <table id="user-table" class="admin-tb">
            <!-- TODO: Pagination -->
            <thead>
                <tr>
                <th class="admin-tb-c col-1">Id</th>
                <th class="admin-tb-c col-20">Username</th>
                <th class="admin-tb-c col-20">Email</th>
                <th class="admin-tb-c col-20">Name</th>
                <th class="admin-tb-c col-50">Bio</th>
                <th class="admin-tb-c col-1">Admin</th>
                <th class="admin-tb-c admin-tb-edge col-2">Action</th>
                </tr>
            </thead>
            <tbody id="user-entries" class="admin-tb-body">
            <?php foreach ($userdata as $user): ?>
            <tr>
                <td class="admin-tb-e"><?= $user['user_id'] ?></td>
                <td class="admin-tb-e"><?= $user['username'] ?></td>
                <td class="admin-tb-e"><?= $user['email'] ?></td>
                <td class="admin-tb-e"><?= $user['name'] ?></td>
                <td class="admin-tb-e"><?= $user['bio'] ?></td>
                <td class="admin-tb-e"><?= $user['admin'] ?></td>
                <td class="admin-tb-e admin-tb-cent">
                <button class="btn btn-sm btn-grey" style="flex:1" data-user-id ="<?= $user['user_id'] ?>" onclick="editUserPrompt(<?= $user['user_id'] ?>)">Edit</button>
                <div style="width: 5px;"></div>
                <button class="btn btn-sm btn-red" style="flex:1" data-user-id ="<?= $user['user_id'] ?>" onclick="deleteUserPrompt(<?=$user['user_id']?>)">Delete</button>
            </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
        <div id="page-buttons">
            <?php
                $data = [
                    'pagelen' => intval(ceil($userlen / $pagelen)),
                    'currentpage' => $currentpage,
                    'clickfunction' => 'changePage',
                ];
                extract($data);
                include '../app/components/PageIndex.php';
            ?>
        </div>
    </div>
    <?php if(file_exists($FOOTER)) include_once($FOOTER);?>
    
    <div id="usermodal" class="fullscreen centered modal">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Submit User</h5>
                <span id="close-user" class="close"
                    onclick="document.getElementById('usermodal').style.display = 'none'";
                >&times;</span>
            </div>
            <form class="modal-body">
                <input id="user-id-input" hidden>
                <div class="input-bar" style="margin: 15px 0;">
                    <input required id="email-input" name="email-input" type="email" class="input" placeholder="Email">
                </div>
                <div class="input-bar" style="margin: 15px 0;">
                    <input required id="username-input" name="username-input" type="text" class="input" placeholder="username">
                </div>
                <div class="input-bar" style="margin: 15px 0;">
                    <input required id="password-input" name="password-input" type="password" class="input" placeholder="Password">
                </div>
                <div class="input-bar" style="margin: 15px 0;">
                    <input required id="name-input" name="name-input" type="text" class="input" placeholder="Full name">
                </div>
                <textarea id="bio-input" type="text" class="long-form" placeholder="Enter Bio"></textarea>
                <div style="height: 15px;"></div>
                <div class="cluster-h" style="min-width:100%;padding: 5px 0">
                    <input id="admin-input" name="admin" type="checkbox"  value="0"/>
                    <label for="admin" class="input">Admin</label>
                    <div class="pusher"></div>
                    <button id="submit-user" type="button" class="btn btn-yellow circular-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
    
    <?php include "../app/components/ConfirmModal.php"?>

    <script defer type="text/javascript" src="/public/js/adminuser.js"></script>
</body>
</html> 