<?php 
  session_start();
  include "connect.php";

  if(isset($_POST['submit']))
  {  
    $target_dir = "./image/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
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
            
            // }
            
            // echo $_FILES['image'];
            // $image   = $_FILES['image']; 
            $name    = $_POST['name'];
            $email   = $_POST['email'];
            $contact = $_POST['contact'];
            $id      = $_SESSION['id'];
            // echo $name;
            // echo $contact;
             if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
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
      echo (mysqli_error($conn)); 
    }
  }
  }else{
    echo "Some error in submiting";
  }
?>