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

$get_user = mysqli_query($link, "SELECT fullName, phoneNo, email, houseNo, subdivision, street, barangay, city FROM accounts WHERE id = $user_id");
$row = mysqli_fetch_row($get_user);

// $name = $_POST['fullName'];
// $number = $_POST['phoneNo'];
// $email = $_POST['email'];
// $houseno = $_POST['houseNo'];
// $subd = $_POST['subdivision'];
// $street = $_POST['street'];
// $barangay = $_POST['barangay'];
// $city = $_POST['city'];

if (isset($_POST['order_btn'])) {

    $get_user = mysqli_query($link, "SELECT fullName, phoneNo, email, houseNo, subdivision, street, barangay, city FROM accounts WHERE id = $user_id");
    $row = mysqli_fetch_row($get_user);
    // echo $row[];

    $name = $_POST['fullName'];
    $number = $_POST['phoneNo'];
    $email = $_POST['email'];
    $houseno = $_POST['houseNo'];
    $subd = $_POST['subdivision'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];
}
    
if (isset($_POST['change_btn'])) {


    $name = $_POST['fullName'];
    $number = $_POST['phoneNo'];
    $email = $_POST['email'];
    $houseno = $_POST['houseNo'];
    $subd = $_POST['subdivision'];
    $street = $_POST['street'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];

    $update_user = mysqli_query($link, "UPDATE accounts SET fullname='$name', phoneNo='$number', email='$email', houseNo='$houseno',
     subdivision='$subd', street='$street', barangay='$barangay', city='$city' WHERE id = '$user_id'");
    // echo $row[];
    header("location:profile.php");
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
            <li class="nav-item ">
                <a class="nav-link" href="#container-how-to-order">
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
                <div class="card o-hidden border-0 shadow-lg my-5 d-flex justify-content-center">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row d-flex justify-content-center">
                    
                    <div class="col-lg-8">
                        <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">User Profile</h1>
                        </div>
                        <form class="user" id="accounts" method="POST">
                            <div class="form-group">

                                <div class="form-group">
                                    <div class="form-group">
                                    
                                    
                                    <input class="form-control form-control-user" type="text" placeholder="Enter Your Full Name" name="fullName" value="<?php echo $row[0] ?>" ></intput>
                                    </div>
                                    <div class="form-group">
                                    <input class="form-control form-control-user" type="number" placeholder="enter your number" name="phoneNo" value="<?php echo $row[1] ?>" ></intput>
                                    </div>
                                    <div class="form-group">
                                    <input class="form-control form-control-user" type="email" placeholder="enter your email" name="email" value="<?php echo $row[2] ?>" ></intput>
                                    </div>

                                    <div class="form-group row">
                                    <div class="col-sm-4 mb-3 mb-sm-0">

                                        <input class="form-control form-control-user" type="text" placeholder="House No." name="houseNo" value="<?php echo $row[3] ?>" ></intput>
                                    </div>

                                    <div class="col-sm-4">

                                        <input class="form-control form-control-user" type="text" placeholder="Subdivision" name="subdivision" value="<?php echo $row[4] ?>" ></intput>
                                    </div>
                                    <div class="col-sm-4">

                                        <input class="form-control form-control-user" type="text" placeholder="Street" name="street" value="<?php echo $row[5] ?>" ></intput>
                                    </div>
                                    </div>
                                    <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">

                                        <input class="form-control form-control-user" type="text" placeholder="Barangay" name="barangay" value="<?php echo $row[6] ?>" ></intput>
                                    </div>
                                    <div class="col-sm-6">

                                        <input class="form-control form-control-user" type="text" placeholder="City" name="city" value="<?php echo $row[7] ?>" ></intput>
                                    </div>
                                    </div>
                                </div>
                                
                                <br><br>
                                <input type="submit" value="Change Details" name="change_btn" class="btn btn-primary btn-md" data-toggle="modal" data-target="#receiptModal"></input>


                        </form>

                    <!-- Page Heading -->
                    <!--                     <div class="d-bg-flex align-items-center justify-content-between ">
-->
                    <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    <!--  </div> -->
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
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
                </div>

                <!-- End of Main Content -->

                <!-- Footer -->
                <footer class="sticky-footer ">
                    <div class="container w-100">
                        <div class="copyright text-center">

                            <span>Copyright &copy; 2022 <a href="https://www.facebook.com/BlessedFlowWaterRefillingStation">BlessedFlow Water Refilling Station</span>

                        </div>

                    </div>
                </footer>
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