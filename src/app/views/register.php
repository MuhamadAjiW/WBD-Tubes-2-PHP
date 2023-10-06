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
    <form class="form-container" action="/register" method="POST">
      <h1>Welcome to Baca.a 👋</h1>
      <h2>Create your new account</h2>  
      <div class="input-container">
        <div class="input-bar" <?php if (isset($errors['emailError'])) echo 'style="border: 2px solid #ff9b9b"'; ?>>
          <input type="email" id="email" name="email" class="input" placeholder="Email" required <?php if (isset($errors['email'])) echo 'value="' . $errors['email'] . '"'; ?>>
        </div>
        <?php if(isset($errors['emailError'])) echo "<p style='color:#ff9b9b;font-size:12px'>". $errors['emailError'] ."</p>";?>
      </div>
      <div class="input-container">
        <div class="input-bar" <?php if (isset($errors['passwordError'])) echo 'style="border: 2px solid #ff9b9b"'; ?>>
          <input type="password" id="password" name="password" class="input" placeholder="Password" required <?php if (isset($errors['password'])) echo 'value="' . $errors['password'] . '"'; ?>>
        </div>
        <?php if(isset($errors['passwordError'])) echo "<p style='color:#ff9b9b;font-size:12px'>". $errors['passwordError'] ."</p>";?>
      </div>
      <div class="input-container">
        <div class="input-bar" <?php if (isset($errors['usernameError'])) echo 'style="border: 2px solid #ff9b9b"'; ?>>
          <input type="name" id="username" name="username" class="input" placeholder="Username" required <?php if (isset($errors['username'])) echo 'value="' . $errors['username'] . '"'; ?>>
        </div>
        <?php if(isset($errors['usernameError'])) echo "<p style='color:#ff9b9b;font-size:12px'>". $errors['usernameError'] ."</p>";?>
      </div>
      <div class="input-container">
        <div class="input-bar" <?php if (isset($errors['nameError'])) echo 'style="border: 2px solid #ff9b9b"'; ?>>
          <input type="name" id="name" name="name" class="input" placeholder="Full Name" required <?php if (isset($errors['username'])) echo 'value="' . $errors['name'] . '"'; ?>>
        </div>
        <?php if(isset($errors['nameError'])) echo "<p style='color:#ff9b9b;font-size:12px'>". $errors['nameError'] ."</p>";?>
      </div>
      <button class="btn btn-yellow auth-submit" type="submit" name="signup">Sign Up</button>
      <p class="yesacc">Already have an account? <a class="reg" href="/login">Log In</a></p>
    </form>
  </section>
</body>
</html>

<?php if(isset($errors)) unset($errors);?>