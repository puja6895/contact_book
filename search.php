<?php session_start(); 
include "connect.php";

if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
}
if(isset($_POST['search'])) {
    // echo "<script>alert('working')</script>";

        $userId = $_SESSION['id'];
        $search = $_POST['search'];

        // $query = "SELECT * FROM contacts WHERE MATCH(name,number) AGAINST('$search')";
        $query = "SELECT * FROM contacts WHERE user_id = $userId and (name like '$search%' or number like '$search%' or email like '$search%') ";
        
        
        $results = mysqli_query($conn,$query) or die( mysqli_error($conn));
       
       
 
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
        body {
            font-family: Roboto, Arial, sans-serif;
        }

        .list-group-item {
            position: relative;
            display: block;
            padding: .75rem 1..25rem;
            background-color: #fff;
            border: 0px solid rgba(0, 0, 0, .125);

        }

        .circle {
            /* position: relative; */
            width: 50px;
            height: 50px;
            overflow: hidden;
            border-radius: 50%;
            /* display:inline-flex;
      box-sizing: border-box; */
        }

        .circle img {
            width: 100%;
            /* height: auto; */
        }

        .contact_name {

            /* display: inline-flex; */
            /* box-sizing: border-box; */
            padding-left: 7%;

        }

        .sidebar_items {
            display: flex;
            align-items: center;
        }

        .row_hover:hover {
            background-color: #f7f7f7;
            border-radius: 4px;
        }

        .actions_hover {
            visibility: hidden;
        }

        .row_hover:hover>#actions {
            visibility: visible;
        }

        #delete_icon:hover {
            color: rgb(219, 10, 10);
        }

        #edit_icon:hover {
            color: blue;
        }

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

        .no-border {
            border-top: 0;
            border-left: 0;
            border-right: 0;
            border-radius: 0;
            margin-top: 10px;
        }

        input:focus~.floating-label,
        input:not(:focus):valid~.floating-label {
            top: 8px;
            bottom: 10px;
            left: 20px;
            font-size: 11px;
            opacity: 1;
        }

        .inputText {
            font-size: 14px;
            width: 200px;
            height: 35px;
        }

        .floating-label {
            position: absolute;
            pointer-events: none;
            left: 20px;
            top: 18px;
            transition: 0.2s ease all;
        }
    </style>

    <script>
        document.getElementById("search_input").addEventListener("mouseenter", Test);

        function Test() {
            document.getElementById("search_box").classList.add("search_box");
        }

        function test2() {
            document.getElementById("search_box").classList.remove("search_box");
        }
    </script>

</head>
</head>

<body>
    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class=" " id="sidebar-wrapper">
            <div class="sidebar-heading continer">
                <div class="row">
                    <div class="col-2 "><i style="font-size: 40px;"
                            class="material-icons text-primary">account_circle</i></div>
                    <div class="col-10 pl-4 text-secondary">Contacts</div>
                </div>
                <!-- <a href="index.php"></a>  -->
            </div>
            <div class="list-group list-group-flush">
                <a href="add.php" class="list-group-item list-group-item-action text-body sidebar_items"
                    data-toggle="modal" data-target="#myModal">
                    <span class="icon material-icons text-secondary">library_add</span>
                    <span class="pl-2">Create contacts</span>
                </a>

                <a href="#" class="list-group-item list-group-item-action text-body sidebar_items">
                    <span class="material-icons text-secondary">perm_identity </span>
                    <span class="pl-2">Contacts</span>
                </a>

                <a href="other_contact.php" class="list-group-item list-group-item-action text-body sidebar_items  ">
                    <span class="material-icons text-secondary">
                        move_to_inbox
                    </span>
                    <span class="pl-2">Other contacts<span class="badge" style="margin-left:50px;"></span></span>
                </a>

            </div>
        </div>
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="btn" id="menu-toggle"><span class="material-icons">
                        menu
                    </span></button>

                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
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
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item ">
                            <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <!-- <li class="nav-item">
<a class="nav-link" href="#">Link</a>
</li> -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

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
            </nav>
            <div class="container-fluid">
                <!-- <h1 class="mt-4">Simple Sidebar</h1> -->
                <!-- <p>The starting state of the menu will appear collapsed on smaller screens, and will appear non-collapsed on larger screens. When toggled using the button below, the menu will change.</p> -->
                <!-- <p>Make sure to keep all page content within the <code>#page-content-wrapper</code>. The top navbar is optional, and just for demonstration. Just create an element with the <code>#menu-toggle</code> ID which will toggle the menu when clicked.</p> -->
                <div class="row pt-5 text-secondary border-bottom">
                    <div class="col-4 ">
                        <p>Name</p>
                    </div>
                    <div class="col-3 ">
                        <p>Email</p>
                    </div>
                    <div class="col-2 ">
                        <p>Phone Number</p>
                    </div>
                    <div class="col-2">
                        <p></p>
                    </div>
                </div><br>
                <?php //$results= mysqli_query($conn,"SELECT * FROM contacts WHERE MATCH(name,number) AGAINST('$search')") ?>
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                <div class="row pt-2 row_hover mb-3">
                    <div class="col-4 " style="display: flex; ">
                        <div class="circle ">
                            <img class="img" src="./image/<?php echo $row['image'] ?>" alt="image">
                        </div>
                        <div class="contact_name mt-2">
                            <span><?php echo $row['name'];?></span>
                        </div>
                    </div>
                    <div class="col-3 mt-2">
                        <span><?php echo $row['email'];?></span>
                    </div>
                    <div class="col-2 mt-2">
                        <p><?php echo $row['number'];?></p>
                    </div>
                    <div class="col-2 mt-2 d-flex actions_hover" id="actions">
                        <div><a href="delete.php?delete=<?php echo $row['id']?>"><i class='fas fa-trash pr-4'
                                    data-toggle="tooltip" title="Delete" id="delete_icon"></i></a>
                        </div>
                        <div><a href="edit.php?edit=<?php echo $row['id']?>"><i class='fas fa-edit'
                                    data-toggle="tooltip" title="Edit Contact" id="edit_icon"></i></a></div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function (e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <!-- Bootstrap tooltip -->
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</body>

</html>