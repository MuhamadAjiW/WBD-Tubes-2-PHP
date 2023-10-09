<!DOCTYPE html>
<html lang="en">
<head>
  <title>Welcome to Baca.a</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php echo strip_tags($REL_DATA, '<link>');?>
</head>
<?php if(file_exists($TOP_BAR)) include_once($TOP_BAR);?>
<img class="sty-bckgrnd" src="/storage/assets/logo.svg" alt="Stylized Background">
<body class="fullscreen centered">
  <section class="auth-container">
    <form class="form-container" action="/login" method="POST">
      <h1>Welcome back 👋</h1>
      <h2>log in with your account</h2>
      <div class="input-container">
        <div class="input-bar" <?php if (isset($errors['email'])) echo 'style="border: 2px solid #ff9b9b"'; ?>>
          <input type="email" id="email" name="email" class="input" placeholder="Email" required <?php if (isset($errors['email'])) echo 'value="' . $errors['email'] . '"'; ?>>
        </div>
      </div>
      <div class="input-container">
        <div class="input-bar" <?php if (isset($errors['password'])) echo 'style="border: 2px solid #ff9b9b"'; ?>>
          <input type="password" id="password" name="password" class="input" placeholder="Password" required <?php if (isset($errors['password'])) echo 'value="' . $errors['password'] . '"'; ?>>
        </div>
        <?php if(isset($errors['loginError'])) echo "<p style='color:#ff9b9b;font-size:12px'>". $errors['loginError'] ."</p>";?>
      </div>
      <div class="input-container checkbox">
        <input type="checkbox" id="remember-me" name="remember-me" value="1"/>
        <label class="input" for="remember-me">Stay Logged In</label>
      </div>
      <button class="btn btn-yellow auth-submit" type="submit" name="login">Log in</button>

      <!-- +TODO: implement -->
      <p><a class="forgor" href="/error/501">Forgot Your Password?</a></p>

      <p class="noacc">Don't have a account? <a class="reg" href="/register">Sign Up</a></p>
    </form>
  </section>
</body>
</html>

<?php if(isset($errors)) unset($errors);?>