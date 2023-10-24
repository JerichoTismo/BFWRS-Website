<!DOCTYPE html>
<html lang="en">
<?php

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === false) {
    header("location: admin.php");
    exit;
}

session_start();
require 'sql/db.php';
$username = $password = "";
$username_err = $password_err = $login_err = "";

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($link, "DELETE FROM `order` WHERE id = '$remove_id'");
    header('location:admin_index.php');
};

if (isset($_GET['delete_all'])) {
    mysqli_query($link, "DELETE FROM `order`");
    header('location:admin_index.php');
}

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
        $sql = "SELECT id, username, password FROM admin WHERE username = ?";

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
                            // Password is correct, so start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;

                            // Redirect user to welcome page
                            header("location: admin_index.php");
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

    <title>BFWRS - ADMINHOME</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-dark sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="homepage.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-tint"></i>
                </div>
                <div class="sidebar-brand-text mx-3">
                    <div class="d-flex flex-column align-items-start">
                        BFWRS ADMIN
                        <div>
                            DASHBOARD
                        </div>
                    </div>
                </div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="admin_index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Orders</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link" href="customer_records.php">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Customer Records</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-columnm" style="overflow: auto">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Messages -->

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo "(admin)" . " " . $_SESSION["username"]; ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="admin.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid" id="content-wrapper">
                    <table class="table table-hover table-striped">
                        <thead>
                            <tr class="">
                                <th scope="col">Date</th>
                                <th scope="col">Full Name</th>
                                <th scope="col">Phone No.</th>
                                <th scope="col">Email</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">House Number</th>
                                <th scope="col">Subdivision</th>
                                <th scope="col">Street</th>
                                <th scope="col">Barangay</th>
                                <th scope="col">City</th>
                                <th scope="col">Total Products</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php

                            $select_order = mysqli_query($link, "SELECT * FROM `order`");
                            $grand_total = 0;
                            if (mysqli_num_rows($select_order) > 0) {
                                while ($fetch_order = mysqli_fetch_assoc($select_order)) {

                                    $products = $fetch_order['total_products'];
                                    $productsArray = explode(',', $products);
                                    $totalProducts = '';
                                    foreach ($productsArray as $prod) {
                                        $totalProducts =  $prod . "<br />" .  $totalProducts;
                                    }
                            ?>

                                    <tr>
                                        <td class="align-middle"><?php echo $fetch_order['datetime']; ?></td>
                                        <td class="align-middle"><?php echo $fetch_order['fullName']; ?></td>
                                        <td class="align-middle"><?php echo $fetch_order['phoneNo']; ?></td>
                                        <td class="align-middle"><?php echo $fetch_order['email']; ?></td>
                                        <td class="align-middle"><?php echo $fetch_order['method']; ?></td>
                                        <td class="align-middle"><?php echo $fetch_order['houseNo']; ?></td>
                                        <td class="align-middle"><?php echo $fetch_order['subdivision']; ?></td>
                                        <td class="align-middle"><?php echo $fetch_order['street']; ?></td>
                                        <td class="align-middle"><?php echo $fetch_order['barangay']; ?></td>
                                        <td class="align-middle"><?php echo $fetch_order['city']; ?></td>
                                        <td class="align-middle"><?php echo $totalProducts; ?></td>
                                        <td class="align-middle">₱ <?php echo $fetch_order['total_price']; ?></td>

                                        <td class="align-middle"><a href="admin_index.php?remove=<?php echo $fetch_order['id']; ?>" onclick="return confirm('remove item from orders?')" class="btn btn-danger delete-btn"> <i class="fas fa-trash"></i> Remove</a></td>
                                    </tr>
                            <?php

                                };
                            };
                            ?>
                            <tr class="table-bottom">

                                <td><a href="admin_index.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="btn btn-danger delete-btn"> <i class="fas fa-trash"></i> Remove All </a></td>
                            </tr>

                        </tbody>

                    </table>
                </div>

                <!-- End of Main Content -->

            </div>
            <!-- End of Content Wrapper -->

            <!-- End of Page Wrapper -->

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