<!DOCTYPE html>
<html lang="en">
<?php 

if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: homepage.php");
    exit;
}

session_start();
require 'sql/db.php';
$username = $password = "";
$username_err = $password_err = $login_err = "";
$user_id = $_SESSION['id'];
$select_rows = mysqli_query($link, "SELECT * FROM `users_cart` WHERE user_id = '$user_id'") or die('query failed');
$row_count = mysqli_num_rows($select_rows);

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BFWRS - ABOUT</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

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
            <li class="nav-item ">
                <a class="nav-link" href="homepage.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Home</span></a>
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
            <li class="nav-item active">
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
        <div id="content-wrapper " class="d-block w-100">

            <!-- Main Content -->
            <div id="content ">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow ">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    
                    <!-- Topbar Navbar -->
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
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION["username"]; ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>

                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
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
                <!--Main layout-->
<main class=" my-50 p-0">
  <div class="container-sm">
    <!--Google map-->
    <div id="map-container-google-4" class="z-depth-1-half map-container-4" style="height: 300px">
     <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3861.9715180939183!2d121.06776031427918!3d14.54362148237082!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3397c89af73740b9%3A0x3f914519765ca646!2sBlessedflow%20Mineral%20Water%20Filling%20Station!5e0!3m2!1sen!2sus!4v1646216679863!5m2!1sen!2sus" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
    </div>

  </div>
</main>


<div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">About us!</h6>
            </div>
                <div class="card-body">
                    <p>Blessed Flow is a water refilling station stationed at Pateros, Metro Manila was estabished on September of 2020.
                        The business offers all the drinking water services possible, from refilling to new containers and parts. Devilery 
                        for customer is free of charge and we deliver to locations; Pateros, Pasig San Joaquin, Pasig Kalawaan and Makati Comembo.
                        We replace our filters every week and does water testing every month to ensure that we are providing the best mineral and 
                        alkaline drinking water to our customers.</p>
                    <p class="mb-0">Store Location</p>
                    <p class="mb-0">E RAGAS ST. TANGCO SUBD, STA. ANA PATEROS METRO MANILA</p>
                    <p class="mb-0">Business Hours</p>
                    <p class="mb-0">7:00 am - 5:00 pm Monday to Saturday</p>
                    <p class="mb-0">Store Location</p>
                    <p class="mb-0">Social Media Account</p>
                    <p class="mb-0">Facebook: <a href="https://www.facebook.com/BlessedFlowWaterRefillingStation" >BlessedFlow Water Refilling Station</a></p>
                    <p class="mb-0">For Inquiries</p>
                    <p class="mb-0">Globe: 0916-2143056</p>
                    <p class="mb-0">Smart: 0920-4010405</p>
                    <p class="mb-0">Telephone: (02)8641-3364</p>
                </div>
</div>
<!--Main layout-->
                   
<!--Main layout-->

<!--Main layout-->
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer ">
                <div class="container w-100">
                    <div class="copyright text-center">
                        <span>Copyright &copy; 2022 <a href="https://www.facebook.com/BlessedFlowWaterRefillingStation" >BlessedFlow Water Refilling Station</span>

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
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
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