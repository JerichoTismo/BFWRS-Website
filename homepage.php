<!DOCTYPE html>
<html lang="en">
<?php

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false) {
    header("location: homepage.php");
    exit;
}
    

session_start();
require 'sql/db.php';
$username = $password = "";
$username_err = $password_err = $login_err = "";
$user_id = $_SESSION['id'];
$user_cart = "SELECT * FROM `users_cart`WHERE user_id = '$user_id'";
$select_rows = mysqli_query($link, $user_cart) or die('query failed');
$row_count = mysqli_num_rows($select_rows);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Check if username is empty
    if (empty(trim($_POST["username"]))) {
        $username_err = "Please enter username.";
    } else {
        $username = trim($_POST["username"]);
    }

    // Check if password is empty
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter your password.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate credentials
    if (empty($username_err) && empty($password_err)) {
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM accounts WHERE username = ?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);

            // Set parameters
            $param_username = $username;

            // Attempt to execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Store result
                mysqli_stmt_store_result($stmt);

                // Check if username exists, if yes then verify password
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if (mysqli_stmt_fetch($stmt)) {
                        $str = $password;
                        md5($str);
                        if (md5($str) == $hashed_password) {
                            if($stmt > 0){
                                //$row = mysqli_stmt_fetch($sql);
                                //echo $_SESSION['user_id'] = $row['id'];
                                // Password is correct, so start a new session
                                session_start();
                                
                                // Store data in session variables
                                $_SESSION["loggedin"] = true;
                                $_SESSION["id"] = $id;
                                $_SESSION["fullName"] = $fullName;
                                $_SESSION["phoneNo"] = $phoneNo;     
                                $_SESSION["email"] = $email;     
                                $_SESSION["houseNo"] = $houseNo;     
                                $_SESSION["subdivision"] = $subdivision;     
                                $_SESSION["street"] = $street;     
                                $_SESSION["barangay"] = $barangay;     
                                $_SESSION["city"] = $city;                                 
                                
                                // Redirect user to welcome page
                                header("location: homepage.php");
                            }
                        } else {
                            // Password is not valid, display a generic error message
                            $login_err = "Invalid username or password.";
                        }
                    }
                } else {
                    // Username doesn't exist, display a generic error message
                    $login_err = "Invalid username or password.";
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    // Close connection
    mysqli_close($link);
}
?>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BFWRS - HOME</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">
    <style>
        .fa-house-chimney {
            color: white;
        }
    </style>
</head>

<body id="page-top">
<!-- <div class="container"> -->
                        
                       

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="homepage.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-tint"></i>
                </div>
                <div class="sidebar-brand-text mx-3">BFWRS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="homepage.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home </span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link" href="shop.php">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Shop</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link" href="about.php">
                    <i class="fas fa-fw fa-info"></i>
                    <span>About</span></a>
            </li>
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link" href="homepage.php #container-how-to-order">
                    <i class="fas fa-fw fa-question-circle"></i>
                    <span>How to Order</span></a>
            </li>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper " class="d-flex flex-columnm">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto" style="padding-right:17px">

                        <!-- Nav Item - Messages -->
                        <ul class="navbar-nav ml-auto d-flex align-items-center">
                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="addToCart.php" 
                                 aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-shopping-cart fa-fw"></i>
                                
                                <span class="badge badge-danger badge-counter"><?php echo $row_count;?></span>
                            </a>
                            
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["username"]; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid  ">

                    <!-- Page Heading -->
                    <!--                     <div class="d-bg-flex align-items-center justify-content-between ">
-->
                    <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    <!--  </div> -->
                    <div class="has-bg-img" style="position:relative" id="homepagepic">
                   <!-- <div class="" style="background-image: url(img/forHomepage.jpeg); height:1000px; width:100%; background-repeat:no-repeat">this is a title</div> -->
                   
                        <img class = "mask"style="background-color: rgba(0, 0, 0, 0.6); width:100% " src="img/forHomepage.jpeg" >
                        <div style="position:absolute; transform: translateY(-50%); top: 50% ;right: 50px">
                        <div style="color:white; font-size:5em; text-shadow: 2px 2px black">CLEAN</div>
                        <div style="color:white; font-size:5em;text-shadow: 2px 2px black">HEALTHY</div>
                        <div style="color:white; font-size:5em;text-shadow: 2px 2px black">WATER</div>
                        </div>
                        <div style=" position: absolute;top:90%; left: 50px; transform: translateY(-50%); color:white; font-size:5em;"><a href="#container-how-to-order"><button class="btn btn-primary btn-lg"> How To Order</button></a></div>
                        <div style=" position: absolute;top:90%; left: 250px; transform: translateY(-50%); color:white; font-size:5em;"><a href="shop.php"><button class="btn btn-primary btn-lg">  Order Now</button></a></div>   
                        
                   </div> <br><br>
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img class="d-block w-100 " src="img/banner.png" alt="First slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="img/banner2.png" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                                <img class="d-block w-100" src="img/banner3.png" alt="Second slide">
                            </div>
                            <!-- <div class="carousel-item">
                                <img class="d-block"style="height:610px ;width:1600px" src="img/containers_pic.jpg" alt="Second slide">
                            </div> -->
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                    <div id="container-how-to-order" class="container" style="height: 100%; justify-content:center; align-items:center; display:flex">
                            <img src="img/how_to_order.png" width="600" height="800" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                            <div class="container">
                        <h4><b>Instruction:</b></h4>
                        <p class="mb-2">- Go to Shop section to browse all the products in our online shop</p>
                        <p class="mb-2">- ADD TO CART the product/s you wish to buy</p>
                        <p class="mb-2">- View your order/s by clicking the cart icon </p>
                        <p class="mb-2">- If you are satisfied with your order/s click PROCEED TO CHECKOUT </p>
                        <p class="mb-2">- Input the necessary information needed for shipping of your order</p>
                        <p class="mb-2">- Click ORDER NOW once you choose your mode of payment and time</p>
                        <p class="mb-2">- View the Reciept</p>
                        <p class="mb-2">- You will receive updates regarding your order/s through your contact number or email address</p>
                        <p class="mb-2">If you have more questions or concerns, please don't hesitate to contact our Blessed Flow customer service</p>
                        <p class="mb-2">You may reach our customer service by sending a sms message at 09455437956</p>
                        </div>
                        </div>
                        <div class="justify-content-center align-items-center"><center><a href="#homepagepic"><button class="btn btn-primary">Go back to homepage</button></a></center></div>
                        <footer class="sticky-footer ">
                <div class="container">
                    <div class="copyright text-center">
                        <span>Copyright &copy; 2022 <a href="https://www.facebook.com/BlessedFlowWaterRefillingStation" >BlessedFlow Water Refilling Station</span>

                    </div>
                </div>

                <!-- End of Main Content -->

                <!-- Footer -->
                <!-- <footer class="sticky-footer ">
                    <div class="container w-100">
                        <div class="copyright text-center">

                            <span>Copyright &copy; 2022 <a href="https://www.facebook.com/BlessedFlowWaterRefillingStation">BlessedFlow Water Refilling Station</span>

                        </div>

                    </div>
                </footer> -->
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

            <!-- End of Page Wrapper -->

            <!-- Scroll to Top Button-->
            <!--     <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
 -->
            <!-- Logout Modal-->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                            <a class="btn btn-primary" href="logout.php">Logout</a>

                        </div>
                    </div>
                </div>
            </div>

            <!-- Bootstrap core JavaScript-->
            <script src="vendor/jquery/jquery.min.js"></script>
            <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

            <!-- Core plugin JavaScript-->
            <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

            <!-- Custom scripts for all pages-->
            <script src="js/sb-admin-2.min.js"></script>

            <!-- Page level plugins -->
            <script src="vendor/chart.js/Chart.min.js"></script>

            <!-- Page level custom scripts -->
            <script src="js/demo/chart-area-demo.js"></script>
            <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>