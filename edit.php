<?php 
  session_start();
  include "connect.php";

  if(isset($_GET['edit']))
  {
    $id = $_GET['edit'];
    $query = "select * from contacts where id = $id limit 1";
    $results = mysqli_query($conn,$query);
    $row = mysqli_fetch_array($results);
    $error = [0 => "<p class='alert alert-danger mt-1'> Please insert 10 number </p>"];
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
    $image   = $_FILES['image']; 
    $name    = $_POST['name'];
    $contact = $_POST['contact'];
    $id      = $_POST['id'];
    // echo $name;
    // echo strlen($contact);
    // die();


    if(!(strlen($contact) == 10)){
      // echo $error;
      // die();
      header('location: edit.php?edit='.$id.'&err=0');
    }else{

      if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
      $query = "UPDATE  contacts SET name='$name',number='$contact',image='$fileName' where id = '$id' ";
      $results = mysqli_query($conn,$query);
      
      if($results){
         header('location: index.php');
      }else {
        echo (mysqli_error($conn)); 
      }
    } 

    }

    


  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

  <!-- Google icons material -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

  <!-- font awesome -->
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">

  <!-- Font -->
  <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">

  <title>Test</title>
  <!-- Custom styles for this template -->
  <link href="./css/simple-sidebar.css" rel="stylesheet">
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
  </style>
</head>

<body>

      <?php $results = mysqli_query($conn,"select * from contacts") ?>
      <form action="edit.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $row['id'] ?>">
        <div class="form-group">
          <label for="image">image:</label>
          <input type="file" class="image-rounded" id="image" placeholder="upload image" name="image">
        </div>
        <div class="form-group">
          <label for="name">Name:</label>
          <input type="text" class="form-control" id="name" placeholder="Enter name" name="name"
            value="<?php echo $row['name'] ?>">
        </div>
        <div class="form-group">
          <label for="contact">Contact Number:</label>
          <input type="number" class="form-control" id="contact" placeholder="Enter Contact Number" name="contact"
            value="<?php echo $row['number'] ?>">
          <?php
        if(isset($_GET['err']) && $_GET['err'] >= 0 ){
          echo $error[$_GET['err']];
        }
      ?>
        </div>
        <button type="submit" class="btn btn-success" name="submit">Update</button>
      </form>
    </div>
  </div>

  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function (e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
</body>

</html>