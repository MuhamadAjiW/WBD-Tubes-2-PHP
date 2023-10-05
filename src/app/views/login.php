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
    <form class="form-container" action="/login" method="POST">
      <h1>Welcome back 👋</h1>
      <h2>log in with your account</h2>  
      <div class="input-container">
        <div class="input-bar" <?php if (isset($loginError)) echo 'style="border: 2px solid #ff9b9b"'; ?>>
          <input type="email" id="email" name="email" class="input" placeholder="Email" required <?php if (isset($email)) echo 'value="' . $email . '"'; ?>>
        </div>
      </div>
      <div class="input-container">
        <div class="input-bar" <?php if (isset($loginError)) echo 'style="border: 2px solid #ff9b9b"'; ?>>
          <input type="password" id="password" name="password" class="input" placeholder="Password" required <?php if (isset($password)) echo 'value="' . $password . '"'; ?>>
        </div>
        <?php if(isset($loginError)) echo "<p style='color:#ff9b9b;font-size:12px'>". $loginError ."</p>";?>
      </div>
      <div class="input-container checkbox">
        <input type="checkbox" id="remember-me" name="remember-me" value="1"/>
        <label class="input" for="remember-me">Remember Me</label>
      </div>
      <button class="btn btn-yellow auth-submit" type="submit" name="login">Log in</button>
      <p><a class="forgor" href="/error/501">Forgot Your Password?</a></p>
      <p class="noacc">Don't have a account? <a class="reg" href="/register">Sign Up</a></p>
    </form>
  </section>
</body>
</html>

<?php if(isset($loginError)) unset($loginError);?>

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

  <link rel="stylesheet" href="/public/css/style.css" />
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
        <form action="/login" method="post">
          <h2>Welcome back <i data-feather="smile"></i></h2>
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
          <div class="remember-me">
            <input type="checkbox" id="remember-me" name="remember-me" value="1"/>
            <label for="remember-me">Remember Me</label>
          </div>
          <div class="forget">
            <a href="# ">Forgot Your Password?</a>
          </div>
          <button class="button" type="submit" name="login">Log in</button>
          <div class="Sign-Up">
            <p>Don 't have a account? <a href="/register?redirect=login">Sign Up</a></p>
          </div>
        </form>
      <div class="sessionerror">
        <?php 
          if (isset($loginError)) {
            echo $loginError;
            unset($loginError);
          }
        ?>
      </div>
    </div>
  </section>
  <script>
    feather.replace();
    </script>
</body>
</html> -->
