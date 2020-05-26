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
  <div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class=" " id="sidebar-wrapper">
      <div class="sidebar-heading continer">
        <div class="row">
          <div class="col-2 "><i style="font-size: 40px;" class="material-icons text-primary">account_circle</i></div>
          <div class="col-10 pl-4 text-secondary">Contacts</div>
        </div>
        <!-- <a href="index.php"></a>  -->
      </div>
      <div class="list-group list-group-flush">
        <a href="" class="list-group-item list-group-item-action text-body sidebar_items" data-toggle="modal"
          data-target="#myModal">
          <span class="icon material-icons">library_add</span>
          <span class="pl-2">Create contacts</span>
        </a>

        <a href="# " class="list-group-item list-group-item-action text-body sidebar_items  sidebarcontact">
          <span class="material-icons">perm_identity </span>
          <span class="pl-2">Contacts<span class="badge" style="margin-left:50px;"></span></span>
        </a>

      </div>
    </div>
    <!-- /#sidebar-wrapper -->
    <!-- Page Content -->
    <div id="page-content-wrapper">
      <nav class="navbar navbar-expand-lg navbar-light">
        <button class="btn" id="menu-toggle"><span class="material-icons">
            menu
          </span></button>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
          aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <form class="form-inline " id="search" action="search.php" method="post">
          <div class="input-group mb-3" id="search_box">
            <div class="input-group-prepend">
              <button type="submit"><span class="input-group-text" id="search_icon"><i
                    class="fas fa-search"></i></span></button>
            </div>
            <input type="text" class="form-control" id="search_input" placeholder="Search" name="search">
          </div>
        </form>

        <!-- <form class="form-inline">
    <i class="fas fa-search" aria-hidden="true"></i>
    <input class="form-control form-control-sm ml- w-75" type="text" placeholder="Search"
      aria-label="Search">
  </form> -->

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0 ">
            <li class="nav-item ">
              <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <!-- <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li> -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">

              </a>
              <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <!-- <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a> -->
                <!-- <div class="dropdown-divider"></div> -->
                <a class="dropdown-item" href="logout.php">Logout</a>
                <!-- </div> -->
            </li>
          </ul>
        </div>
      </nav><br>
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