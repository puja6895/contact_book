<?php 
  session_start();
  include "connect.php";

  if(isset($_POST['submit']))
  { 
    if(!empty($_FILES['image']['name'])) {
     
      $target_dir = "./image/";
      $target_file = $target_dir . basename($_FILES["image"]["name"]);
      $fileName = basename($_FILES['image']['name']);
      // echo $fileName ; die();
      $uploadOk = 1;
      $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      // Check if image file is a actual image or fake image
      $check = getimagesize($_FILES["image"]["tmp_name"]);
      if($check !== false) {
        // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
      } else {
        echo "File is not an image.";
        $uploadOk = 0;
      }
      if(!move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)){
        echo "Error in uploading file";
        die();
      }
    }else
    {
      $fileName = "default.png";
    }
            
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $contact = $_POST['contact'];
    $id      = $_SESSION['id'];

    if(empty($contact) && empty($email)) {
      // $contact  = "";
      // $email    = "";
      die("Contact and email field can't be empty");
    }

    $query = "INSERT INTO contacts(user_id,name,email,number,image)
              VALUES('$id' , '$name','$email', '$contact','$fileName')";

    
    $results = mysqli_query($conn,$query);
    
    if($results){
      echo "<script>
        alert('Success');
        window.location.href='index.php';
      </script>";
      $msg = "<p class='alert alert-success'>Contact added successfully</p>";
    }else {
      header('location:other_contact');
      echo (mysqli_error($conn)); 
    }
          
  }else{
    echo "Some error in submiting";
  }
?>