<?php
//Login disini cookie nya ketika tombol ingat akun dipencet
//Beberapa error gw langsung tulisin ke web nya jelas sangat jelek blm diperbaiki(: )
session_start();
//Atur koneksi ke database
$host = "localhost";
$port = 1234;
$database = "database";
$username = "root";
$pass = "Cecem1706"; 
$connection = mysqli_connect($host,$username,$pass,$database,$port);
    //echo "Sukses terkoneksi ke database MySQL". PHP_EOL;
    //Menutup koneksi 
if(!$connection){
    die("Query gagal: " . mysqli_error($connection));
}

$err = 0;
//Cek port 
//SHOW VARIABLES LIKE 'port';
if(isset($_POST['login'])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    

    if($email=='' or $password==''){
        $err++;
        echo "Silakan masukan username dan password";
    }
    else{
        $sql1 = "select * from user where email = '$email'";
        $ql1 = mysqli_query($connection,$sql1);
        $r1 = mysqli_fetch_array($ql1);
        if($r1['email'] == ''){
            echo "Email tidak tersedia";
            $err+=1;
        }
        elseif($r1['password'] != md5($password)){
            echo "Password yang dimasukkan tidak sesuai";
            $err+=1;
        }
        if($err == 0){
            $_SESSION['session_email'] = $email;
            $_SESSION['session_password'] = md5($password);
            if($_POST['remember-me'] == 1){
                $cookie_name = "cookie_email";
                $cookie_value = $email;
                $cookie_time = time() + (60 * 60 * 24 * 30);
                setcookie($cookie_name, $cookie_value,$cookie_time,"/");

                $cookie_name = "cookie_password";
                $cookie_value = md5($password);
                $cookie_time = time() + (60 * 60 * 24 * 30);
                setcookie($cookie_name, $cookie_value,$cookie_time,"/");
            }
            header("location:anggota.php");

        }
    }
}
?>
<!DOCTYPE html>
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

    <link rel="stylesheet" href="css/style.css" />
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
          <form action="index.php" method="post">
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
              <p>Don 't have a account <a href="#">Sign Up</a></p>
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
