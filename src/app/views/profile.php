<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profile User Baca.a</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<div class="user">
  <img
          src="https://www.theventuretours.com/wp-content/uploads/2020/03/avatar-icon-png-1-1024x1024.png"
          alt="Gambar User"
          width="250"
          height="250"
        />
</div>
<?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>
<img class="sty-bckgrnd" src="/storage/assets/logo.svg" alt="Stylized Background">
<body class="fullscreen centered">
  <section class="auth-container">
    <form class="form-container" action="/profile" method="POST">
      <h1>Profile User</h1> 
      <div class="input-container">
        <div class="input-bar-profile">
          <input type="email" id="email" name="email" class="input" value=<?php echo $email;?> />
          <span>Email </span>
        </div>
        <div class="input-bar-profile">
          <input type="name" id="username" name="username" class="input" value=<?php echo $username;?> />
          <span>Username </span>
        </div>
        <div class="input-bar-profile">
          <input type="name" id="name" name="name" class="input" value=<?php echo $name;?> />
          <span>Name </span>
        </div>
        <div class="input-bar-profile">
          <input type="text" id="bio" name="bio" class="input" value=<?php echo $bio;?> />
          <span>Bio </span>
        </div>
        <div class="input-bar-profile">
          <input type="text" id="admin" name="admin" class="input" value=<?php echo $admin;?> />
          <span>Admin </span>
        </div>
      <button class="btn btn-red auth-submit" type="button" id="edit-button" name="buttoneditprofile">Edit Profile</button>
      <button class="btn btn-red auth-submit" type="button" id="logout-button" name="buttonlogout">Log Out</button>
    </form>
  </section>
</body>
<!-- TODO: fix submission and edition -->
<div id="editprofilemodal" class="fullscreen centered modal">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Profile</h5>
        </div>
        <form class="modal-body" action="/profile" method="POST">
        <div class="input-bar-profile">
        <input type="email" id="emailprofile" name="emailprofile" class="input" placeholder="Email" required/>
        </div>
        <div class="input-bar-profile">
        <input type="text" id="usernameprofile" name="usernameprofile" class="input" placeholder="Username" required/>
        </div>
        <div class="input-bar-profile">
        <input type="text" id="nameprofile" name="nameprofile" class="input" placeholder="Name" required/> 
        </div>
        <div class="input-bar-profile">
        <input type="text" id="bioprofile" name="bioprofile" class="input" placeholder="Bio" required/> 
        </div>  
            <div class="cluster-h" style="min-width:100%;padding: 5px 0">
                <div class="pusher"></div>
                <button id="submit-edit-profile" name="submit-edit-profile" type="submit" class="btn btn-yellow submit-review-btn">Submit</button>
                <button id="cancel-edit-profile" name="cancel-edit-profile" type="submit" class="btn btn-yellow submit-review-btn">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- TODO: fix submission and edition -->
<div id="logoutmodal" class="fullscreen centered modal">
    <div class="modal-content">
        <div class="modal-header">
        </div>
        <form class="modal-body" action="/login" method="POST">
        <p>Hai, Do you really want to logout?</p>
            <div class="cluster-h" style="min-width:100%;padding: 5px 0">
                <div class="pusher"></div>
                <button id="submit-edit-logout" name="submit-edit-logout" type="submit" class="btn btn-yellow submit-review-btn">Yes</button>
                <button id="cancel-edit-logout" name="cancel-edit-logout" type="submit" class="btn btn-yellow submit-review-btn">No</button>
            </div>
        </form>
    </div>
</div>

<script src="/public/js/profile.js"></script>


