<?php 
   session_start();
   include "connect.php";

   if(isset($_POST['submit'])){
        $username  = $_POST['username'];
        $email     = $_POST['email'];
        $password = $_POST['password'];
  
        $query = "INSERT INTO users (username,email,password)
                  VALUES('$username', '$email', '$password')";
         $result = mysqli_query($conn, $query);
         if($result){
            // echo ' successfully save ';
            $_SESSION['username']=$username;
            // $_SESSION['id']=$id;
            header('location: login.php');
          }else{
            
            echo (mysqli_error($conn)); 
          }
        //   if(isset($_SESSION['id'])){

        //  }
        
    
    }
  
  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Project</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!--===============================================================================================-->
  <link rel="icon" type="image/png" href="images/icons/favicon.ico" />
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <!--===============================================================================================-->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

  <!-- Script -->
  <script>
    function validate(letters) {
      //  var flag = true;
      console.log(letters.username);

      if (letters.username.value == "") {
        alert("Name Field cannot be left empty");
        letters.username.focus();
        return false;
      }
      var regex = /^[a-zA-Z]+$/;
      if (regex.test(letters.username.value) == false) {
        alert("Name must be in alphabets only");
        letters.username.focus();
        return false;
      }

      return true;

    }

    // OnKeyPress
    function nameKeyPress(text) {
      var regex = /^[a-zA-Z]+$/;
      // console.log(text);
      if (regex.test(text.value) === false) {
        // alert("Name must be in alphabets only");
        text.focus();

        var spanText = document.getElementById('spanText');
        spanText.innerText = "Name must be in alphabets only";


      } else {
        var spanText = document.getElementById('spanText');
        spanText.innerText = "";
      }

      if (text.value == "") {
        var spanText = document.getElementById('spanText');
        spanText.innerText = "";
      }

    }
    //Email Validate
    function emailKeyPress(mail) {
      var regex =
        /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
      if (regex.test(mail.value)) {
        var emailText = document.getElementById('emailText');
        emailText.innerText = "";
      } else {
        var emailText = document.getElementById('emailText');
        emailText.innerText = "This not a valid email";
      }
      if (mail.value == "") {
        emailText.innerText = "";
      }
    }
  </script>
</head>

<body>

  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100">
        <div class="login100-form-title" style="background-image: url(assets/images/background1.jpg);">
          <span class="login100-form-title-1">
            Sign Up
          </span>
        </div>

        <form class="login100-form validate-form" method="POST" action="register.php">
          <div class="wrap-input100 validate-input m-b-26" data-validate="Username is required">
            <span class="label-input100">Username</span>
            <input class="input100" type="text" id="username" name="username" placeholder="Enter username"
              onkeyup="nameKeyPress(this)">
            <span class="focus-input100"></span>
            <span id="spanText" class="text-danger"></span>
          </div>

          <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
            <span class="label-input100">Email</span>
            <input class="input100" type="text" id="email" name="email" placeholder="Enter email" onkeyup="emailKeyPress(this)">
            <span class="focus-input100"></span>
            <span id="emailText" class="text-danger"></span>
          </div>

          <div class="wrap-input100 validate-input m-b-18" data-validate="Password is required">
            <span class="label-input100">Password</span>
            <input class="input100" type="password" id="password" name="password" placeholder="Enter password">
            <span class="focus-input100"></span>
          </div>

          <div class="flex-sb-m w-full p-b-30">
            <!-- <div class="contact100-form-checkbox">
              <input class="input-checkbox100" id="ckb1" type="checkbox" name="remember-me">
              <label class="label-checkbox100" for="ckb1">
                Remember me
              </label>
            </div> -->

            <div>
              <a href="login.php" class="txt1">
                Already Have account? SignIn
              </a>
            </div>
          </div>

          <div class="container-login100-form-btn">
            <button type="submit" class="login100-form-btn"  name="submit">
              Sign Up
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <!--===============================================================================================-->
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/animsition/js/animsition.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/daterangepicker/moment.min.js"></script>
  <script src="vendor/daterangepicker/daterangepicker.js"></script>
  <!--===============================================================================================-->
  <script src="vendor/countdowntime/countdowntime.js"></script>
  <!--===============================================================================================-->
  <script src="js/main.js"></script>

</body>

</html>