<?php

namespace app\controllers;

use app\core\Controller;
use app\models\UserModel;
class Login extends Controller{
    public function index(){
        $usermodel = $this->model("UserModel");
        $this->addRel("stylesheet", "/public/css/style-2.css");
        $this->addRel("stylesheet", "/public/css/auth.css");
        $this->addRel("stylesheet", "/public/css/topbar.css");

        $this->view('Login');
    }
    
    public function login(){
        session_start();
        if(isset($_POST['login'])){
            $userLogin = $this->model("UserModel");
            $email = $_POST["email"];
            $password = $_POST["password"];
            $user = $userLogin->login($email,$password);
            if($user==null){
                $_SESSION['error'] = "Invalid username or password";
                $this->view('Login');
            }
            else{
                if (password_verify($password, $user['password'])) {
                    $_SESSION['email'] = $email;
                    echo "Hi ". $_SESSION['email']. "Nanti dihubungin ke home";
                  } else {
                    $_SESSION['error'] = "Invalid username or password";
                    $this->view('Login');
                  }
            }
        }
        
        
        
        // if(isset($_POST['login'])){
        //     $email = $_POST["email"];
        //     $password = $_POST["password"];
        
        //     if($email=='' or $password==''){
        //         $err++;
        //         echo "Silakan masukan username dan password";
        //     }
        //     else{
        //         $sql1 = "select * from user where email = '$email'";
        //         $ql1 = mysqli_query($connection,$sql1);
        //         $r1 = mysqli_fetch_array($ql1);
        //         if($r1['email'] == ''){
        //             echo "Email tidak tersedia";
        //             $err+=1;
        //         }
        //         elseif($r1['password'] != md5($password)){
        //             echo "Password yang dimasukkan tidak sesuai";
        //             $err+=1;
        //         }
        //         if($err == 0){
        //             $_SESSION['session_email'] = $email;
        //             $_SESSION['session_password'] = md5($password);
        //             if($_POST['remember-me'] == 1){
        //                 $cookie_name = "cookie_email";
        //                 $cookie_value = $email;
        //                 $cookie_time = time() + (60 * 60 * 24 * 30);
        //                 setcookie($cookie_name, $cookie_value,$cookie_time,"/");
        
        //                 $cookie_name = "cookie_password";
        //                 $cookie_value = md5($password);
        //                 $cookie_time = time() + (60 * 60 * 24 * 30);
        //                 setcookie($cookie_name, $cookie_value,$cookie_time,"/");
        //             }
        //             header("location:anggota.php");
        
        //         }
        //     }
        // }
        
    }
}

?>