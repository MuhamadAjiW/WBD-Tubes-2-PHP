<!DOCTYPE html>
<html lang="en">
<head>
  <title>Profile User Baca.a</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>
<img class="sty-bckgrnd" src="/storage/assets/logo.svg" alt="Stylized Background">
<body class="fullscreen centered">
  <div class="user">
    <img
            class="profile-image"
            src="https://www.theventuretours.com/wp-content/uploads/2020/03/avatar-icon-png-1-1024x1024.png"
            alt="Gambar User"
            width="250"
            height="250"
          />
  </div>
  <section class="auth-container">
    <form class="form-container" action="/profile" method="POST">
      <h1>Profile User</h1> 
      <div class="input-container">
        <label for="email">Email </label>
        <div class="input-bar">
          <input type="email" id="email-input" name="email-input" class="input" value=<?php echo $email;?> />
        </div>
        <label for="username">Username </label>
        <div class="input-bar">
          <input type="name" id="username-input" name="username-input" class="input" value=<?php echo $username;?> />
        </div>
        <label for="name">Name </label>
        <div class="input-bar">
          <input type="name" id="name-input" name="name-input" class="input" value=<?php echo $name;?> />
        </div>
        <label for="bio">Bio </label>
        <textarea id="bio-input" type="text" class="long-form" placeholder="Enter Bio"><?php echo $bio;?></textarea>
      <button class="btn btn-yellow auth-submit" style="margin: 15px 0;" type="button" id="edit-button" name="buttoneditprofile">Edit Profile</button>
      <button class="btn btn-red auth-submit" type="button" id="logout-button" name="buttonlogout">Log Out</button>
    </form>
  </section>
  <?php include "../app/components/ConfirmModal.php"?>
  <script src="/public/js/profile.js"></script>
</body>
</html>




