<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome to Baca.a</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>
<img class="sty-bckgrnd" src="storage/assets/logo.svg" alt="Stylized Background">
<body class="fullscreen centered">
  <section class="auth-container">
    <form class="form-container" action="/register" method="POST">
      <h1>Welcome to Baca.a 👋</h1>
      <h2>Create your new account</h2>  
      <div class="input-container">
        <div class="input-bar">
          <input type="email" id="email" name="email" class="input" placeholder="Email" required>
        </div>
      </div>
      <div class="input-container">
        <div class="input-bar">
          <input type="password" id="password" name="password" class="input" placeholder="Password" required>
        </div>
      </div>
      <div class="input-container">
        <div class="input-bar">
          <input type="name" id="username" name="username" class="input" placeholder="Username" required>
        </div>
      </div>
      <div class="input-container">
        <div class="input-bar">
          <input type="name" id="name" name="name" class="input" placeholder="Full Name" required>
        </div>
      </div>
      <button class="btn btn-yellow auth-submit" type="submit" name="login">Sign Up</button>
      <p class="yesacc">Already have an account? <a class="reg" href="/login">Log In</a></p>
    </form>
    <div class="sessionerror">
      <?php if (!empty($namaError)): ?>
        <div class="error-message"><?php echo $namaError; ?></div>
      <?php endif; ?>
    </div>
  </section>
</body>
</html>


<!-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <meta
      name="viewport"
      content="height=device-height,width=device-width,initial-scale=1.0,maximum-scale=1.0,viewport-fit=cover"
    />
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,700&display=swap"
      rel="stylesheet"
    />
    <script src="https://unpkg.com/feather-icons"></script>

    <link rel="stylesheet" href="../public/css/signup.css" />
  </head>

  <body>
    <section>
      <div class="book">
        <img
          src="https://www.goodnewsfromindonesia.id/uploads/post/large-1280px-books-hd-8314929977-7bb081dd3c63bc7677a06531bc56de94.jpg"
          alt="Gambar buku"
          width="250"
          height="250"
        />
      </div>

      <div class="form-box">
        <div class="form-value">
          <form action="/register" method="post">
            <h2>Welcome To Redsy <i data-feather="smile"></i></h2>
            <div class="p">Login with your Redsy account</div>
            <div class="inputbox">
              <i data-feather="mail"></i>
              <input
                type="email"
                id="email"
                name="email"
                required
                placeholder="     Masukkan email"
              />
            </div>
            <div class="inputbox">
              <i data-feather="lock"></i>
              <input
                type="password"
                id="password"
                name="password"
                required
                placeholder="     Masukkan password"
              />
            </div>
            <div class="inputbox">
              <i data-feather="user"></i>
              <input
                type="name"
                id="username"
                name="username"
                required
                placeholder="     Masukkan username"
              />
            </div>
            <div class="inputbox">
              <i data-feather="user"></i>
              <input
                type="name"
                id="name"
                name="name"
                required
                placeholder="     Masukkan Nama Lengkap"
              />
            </div>
            <button class="button" type="submit" name="signup">Sign Up</button>
            <div class="Login">
              <p>Already have account <a href="/login?redirect=signup">Login</a></p>
            </div>
          </form>
          <?php if (!empty($namaError)): ?>
              <div class="error-message"><?php echo $namaError; ?></div>
          <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
    <script>
      feather.replace();
    </script>
  </body>
</html> -->
