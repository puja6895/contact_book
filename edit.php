<?php 
  session_start();
  include "connect.php";

  if(isset($_GET['edit']))
  {
    $id = $_GET['edit'];
    $query = "select * from contacts where id = $id limit 1";
    $results = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($results);
   // $error = [0 => "<p class='alert alert-danger mt-1'> Please insert 10 number </p>"];
  }

  if(isset($_POST['submit']))
  {
    $target_dir = "./image/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    // echo $target_file;
    $fileName = basename($_FILES['image']['name']);
    // echo $fileName ; die();
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
    // Check if image file is a actual image or fake image
    // if(isset($_POST["submit"])) {
        $check = getimagesize($_FILES["image"]["tmp_name"]);
        if($check !== false) {
              echo "File is an image - " . $check["mime"] . ".";
              $uploadOk = 1;
          } else {
                echo "File is not an image.";
                $uploadOk = 0;
            }
   // $image   = $_FILES['image']; 
    $name    = $_POST['name'];
    $contact = $_POST['contact'];
    $id      = $_POST['id'];
    // echo $name;
    // echo strlen($contact);
    // die();


    //if(!(strlen($contact) == 10)){
      // echo $error;
      // die();
      //header('location: edit.php?edit='.$id.'&err=0');
    //}else{

      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      $query = "UPDATE  contacts SET name='$name',number='$contact',image='$fileName' where id = '$id' ";
      $results = mysqli_query($conn,$query);
      
      if($results){
         header('location: index.php');
      }else {
        echo (mysqli_error($conn)); 
      }
    }
  //} 

    

    


  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!-- Google icons material -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- font awesome -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

  <title>Test</title>
  <!-- Custom styles for this template -->
  <!-- <link href="./css/simple-sidebar.css" rel="stylesheet"> -->
  <style>
    #search {
      position: static;
      margin-left: 35%;
    }

    .search_icon {
      border-bottom-left-radius: 0;
      border-right: 0;
      background-color: #fff;
    }

    .search_input {
      border-bottom-right-radius: 0;
      border-left: 0;
    }

    .search_box {
      box-shadow: 2px 2px 5px grey;
    }

    .sidebar_items {
      display: flex;
      align-items: center;
    }

    .Nav {
      margin-top: 7%;
      margin-left: 30%;
      margin-right: 30%;
    }

    .imagePreviewDiv {
      width: 200px;
      height: 200px;
      border: 2px solid #dddddd;
      margin-top: 10px;

      /* Default */
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
      color: #cccccc;

    }

    .image-PreviewImage {
      display: block;
      width: 60%;
    }
  </style>
</head>

<body>
  <div class="container">
    <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
      <div class="panel panel-info">
        <div class="panel-heading">
          <div class="panel-title">Edit Contact <a href="index.php" style="float:right">Home</a></div>
          <!-- <div style="float:right; font-size: 80%; position: relative; top:-10px" class="panel-title"><a href="index.php">Home</a></div> -->
        </div>

        <div style="padding-top:30px" class="panel-body">

          <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
          <?php $results = mysqli_query($conn,"select * from contacts") ?>
          <form id="loginform" class="form-horizontal" role="form" action="edit.php" method="post"
            enctype="multipart/form-data">
            <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
            <!-- <img class="img mb-2" src="./image/<?php //echo $row['image'] ?>" alt="image" width="60" height="60"> -->

            <input type="file" name="image" id="image">
            <div class="imagePreviewDiv" id="imagePreviewDiv">
              <img src="./image/<?php echo $row['image'] ?>" alt="Image" id="image-PreviewImage" class="image-PreviewImage">
              <!-- <span class="image-PreviewDefault">Image Preview</span> -->
            </div>

            <div style="margin-bottom: 25px" class="input-group">
              <!-- <span class="input-group-addon"></span> -->

              <!-- <input type="file"   class="image-rounded " id="image" placeholder="upload image" name="image" > -->
            </div>

            <div style="margin-bottom: 25px; margin-left:3px; margin-right:3px;" class="form-group">
              <!-- <span class="input-group-addon"></span> -->
              <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"
                value="<?php echo $row['name'] ?>">
            </div>

            <div style="margin-bottom: 25px; margin-left:3px; margin-right:3px;" class="form-group">
              <!-- <span class="input-group-addon"></span> -->
              <input type="text" class="form-control" id="email" placeholder="no email" name="email"
                value="<?php echo $row['email'] ?>">
            </div>

            <div style="margin-bottom: 25px; margin-left:3px; margin-right:3px;" class="form-group">
              <!-- <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span> -->
              <input type="number" class="form-control" id="contact" placeholder="Enter Contact Number" name="contact"
                value="<?php echo $row['number'] ?>">
              <?php
                 // if(isset($_GET['err']) && $_GET['err'] >= 0 ){
                   // echo $error[$_GET['err']];
                  //}
                ?>
            </div>
            <!-- <div class="input-group">
              <div class="checkbox">
                <label>
                  <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                </label>
              </div>
            </div> -->
            <div style="margin-top:10px" class="form-group">
              <!-- Button -->

              <div class="col-sm-12 controls">
                <button id="btn-login" type="submit" class="btn btn-success" name="submit">Update </button>
                <a id="btn-fblogin" href="#" class="btn btn-primary">Back</a>

              </div>
            </div>
            <!-- <div class="form-group">
              <div class="col-md-12 control">
                <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%">
                  Don't have an account!
                  <a href="#" onClick="$('#loginbox').hide(); $('#signupbox').show()">
                    Sign Up Here
                  </a>
                </div>
              </div>
            </div> -->
          </form>
        </div>
      </div>
    </div>


    <!-- ImagePreview Script -->
    <script>
      const inputFile = document.getElementById("image");
      const previewContainer = document.getElementById("imagePreviewDiv");
      const previewImage = previewContainer.querySelector(".image-PreviewImage");
      const oldImage = document.getElementById("image-PreviewImage").getAttribute("src");
      // console.log(oldImage);
      
      // const previewDefaultText = previewContainer.querySelector(".image-PreviewDefault");

      inputFile.addEventListener("change", function () {

        const file = this.files[0];

        if (file) {
          const reader = new FileReader();
          // previewDefaultText.style.display = "none";
          previewImage.style.display = "block";

          reader.addEventListener("load", function () {
            // console.log(this);
            previewImage.setAttribute("src", this.result);
          });
          reader.readAsDataURL(file);

        } else {
          // previewDefaultText.style.display = null;
          previewImage.style.display = null;
          previewImage.setAttribute("src", oldImage);
        }

      });
    </script>
</body>

</html>