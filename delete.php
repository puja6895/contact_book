<?php 
  
  include "connect.php";

//   echo $_GET['delete'];
 
  if(isset($_GET['delete'])){
      $id=$_GET['delete'];
      
      $query= "DELETE FROM contacts WHERE id=$id";
      $results = mysqli_query($conn,$query) or die(mysqli_error($conn));

      header('location: index.php');
  }
  


?>