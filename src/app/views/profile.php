<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <meta
      name="viewport"
      content="height=device-height,width=device-width,initial-scale=1.0,maximum-scale=1.0,viewport-fit=cover"
    />
    <title>Profil</title>
    <!--Fonts Pake Poppins-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,700&display=swap"
      rel="stylesheet"
    />
    <!--Feather Icons-->
    <script src="https://unpkg.com/feather-icons"></script>

    <link rel="stylesheet" href="../../public/css/profile.css" />
  </head>

  <body>
    <section>
      <div class="user">
        <img
          src="https://www.theventuretours.com/wp-content/uploads/2020/03/avatar-icon-png-1-1024x1024.png"
          alt="Gambar User"
          width="250"
          height="250"
        />
      </div>
      <div class="form-box">
        <div class="form-value">
          <form action="/profile" method="post">
            <h2>Profile User</h2>
            <div class="inputbox">
              <span>Email </span>
              <input type="email" id="email" name="email" value=<?php echo $email;?> />
            </div>
            <div class="inputbox">
              <span>Nama </span>
              <input type="text" id="nama" name="nama" value=<?php echo $name;?> />
            </div>
            <div class="inputbox">
              <span>Username </span>
              <input type="text" id="username" name="username" value=<?php echo $username;?> />
            </div>
            <div class="inputbox">
              <span>Bio </span>
              <input type="text" id="bio" name="bio" value=<?php echo $bio;?> />
            </div>
            <div class="inputbox">
              <span>Status Admin </span>
              <input type="text" id="status" name="admin" value=<?php echo $admin;?> />
            </div>
          </form>
        </div>
      </div>
    </section>
    <!--Feather Icons-->
    <script>
      feather.replace();
    </script>
  </body>
</html>
