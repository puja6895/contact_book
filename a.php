<?php 
// active color - #4886c738
// style=" border-top-right-radius: 30px; border-bottom-right-radius: 30px; background-color:#4886c738;"
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
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <title></title>
  <title>Document</title>
  <style>
  </style>
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
        if(mail.value == ""){
          emailText.innerText = "";
        }
      }

  </script>
</head>

<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <h2>Register</h2>
        <form action="register.php" method="post" name="myForm" id="f1" onsubmit=" return validate(this)">
          <div class="form-group">
            <label for="username">Name:</label>
            <input type="username" class="form-control" id="username" placeholder="Enter username" name="username"
              onkeyup="nameKeyPress(this)">
            <span id="spanText" class="text-danger"></span>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"
              onkeyup="emailKeyPress(this)">
            <span id="emailText" class="text-danger"></span>
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
          </div>
          <div class="form-group form-check">
            <a href="login.php">Login Already have account</a>
          </div>
          <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
      </div>
    </div>
  </div>
</body>

</html>

<?php    
  session_start();

  include "connect.php";
  if(isset($_POST['submit'])){

     $email = $_POST['email'];
     $password = $_POST['password'];
    //  echo $email;
    //  echo $password;
    
    $query =  "SELECT * FROM users WHERE email='$email' AND password='$password'";
    // echo $query;
    $results = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($results) == 1){
        // echo $query;
        $row = mysqli_fetch_assoc($results);
        $split =   explode(' ',$row["username"]);
        $_SESSION['username'] = $split[0];
        // echo $_SESSION['username'] ; die();
        $_SESSION['id']=$row["id"]; 
        header('location: index.php');
    }else{
        echo 'email and password does not match';
        
    }


  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>index</title>
    <title>Document</title>
</head>
<body>
<div class="container">
  <h2>Login</h2>
  <form action="login.php" method="post">
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <div class="form-group">
      <label for="pwd">Password:</label>
      <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
  </form>
</div>
</body>
</html>







<div class="container">
    <?php $results = mysqli_query($conn,"select * from contacts") ?>
  <form action="edit.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
    <div class="form-group">
      <label for="image">image:</label>
      <input type="file" class="image-rounded" id="image" placeholder="upload image" name="image">
    </div>
    <div class="form-group">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" value="<?php echo $row['name'] ?>">
    </div>
    <div class="form-group">
      <label for="contact">Contact Number:</label>
      <input type="number" class="form-control" id="contact" placeholder="Enter Contact Number" name="contact" value="<?php echo $row['number'] ?>">
      <?php
        if(isset($_GET['err']) && $_GET['err'] >= 0 ){
          echo $error[$_GET['err']];
        }
      ?>
    </div>
    <button type="submit" class="btn btn-success" name="submit">Update</button>
  </form>
</div>