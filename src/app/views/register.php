<!DOCTYPE html>
<!--Sign Up baru depannya aja-->
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE-edge" />
    <meta
      name="viewport"
      content="height=device-height,width=device-width,initial-scale=1.0,maximum-scale=1.0,viewport-fit=cover"
    />
    <title>Login</title>
    <!--Fonts Pake Poppins-->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,700&display=swap"
      rel="stylesheet"
    />
    <!--Feather Icons-->
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
          <form action="" method="post">
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
              <i data-feather="lock"></i>
              <input
                type="password"
                id="confirmPassword"
                name="confirmPassword"
                required
                placeholder="     Tuliskan ulang password"
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
            <button class="button">Sign Up</button>
            <div class="Login">
              <p>Already have account <a href="#">Sign Up</a></p>
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
