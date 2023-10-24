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

if (isset($_POST['update_update_btn'])) {
    $update_value = $_POST['update_quantity'];
    $update_id = $_POST['update_quantity_id'];
    $update_quantity_query = mysqli_query($link, "UPDATE `users_cart` SET quantity = '$update_value' WHERE id = '$update_id'");
    if ($update_quantity_query) {
        header('location:addToCart.php');
    };
};

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    mysqli_query($link, "DELETE FROM `users_cart` WHERE id = '$remove_id'");
    header('location:addToCart.php');
};

if (isset($_GET['delete_all'])) {
    mysqli_query($link, "DELETE FROM `users_cart` WHERE user_id = '$user_id'");
    header('location:addToCart.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<?php


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
        <div id="content-wrapper " class="d-flex flex-columnm" style="width: 100vw; margin: 0; padding: 0; box-sizing: border-box">

            <!-- Main Content -->
            <div id="content" style="width: 100%">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto d-flex align-items-center">
                        <li class="nav-item dropdown no-arrow mx-1">
                            <!-- Topbar Search -->
                            <!-- <form class="d-none d-sm-inline-block form-inline my-2 my-md-0 w-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form> -->
                        </li>

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
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <!--                     <div class="d-bg-flex align-items-center justify-content-between ">
-->
                    <!-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> -->
                    <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                                class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
                    <!--  </div> -->
                    <div class="container-fluid mx-0 px-0">

                        <section class="shopping-cart">

                            <h1 class="h2 mb-0 text-gray-900 mb-3">Cart</h1>

                            <table class="table table-hover">

                                <thead class="bg-primary text-white">
                                    <th scope="col">Image</th>
                                    <th scope="col">Product Name</th>
                                    <th scope="col">Price Per Unit</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total Price</th>
                                    <th scope="col">Remove</th>
                                    </tr>
                                </thead>

                                <tbody>

                                    <?php
                                    $u = $_SESSION["username"];
                                    // $get_username = mysqli_query($link, "SELECT username from 'accounts'");

                                    $select_cart = mysqli_query($link, "SELECT * FROM `users_cart` WHERE user_id = '$user_id' ");
                                    $grand_total = 0;
                                    if (mysqli_num_rows($select_cart) > 0) {
                                        while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                                    ?>

                                            <tr>
                                                <td class="align-middle"><img src="img/<?php echo $fetch_cart['image']; ?>" height="100" alt=""></td>
                                                <td class="align-middle"><?php echo $fetch_cart['name']; ?></td>
                                                <td class="align-middle">₱ <?php echo number_format($fetch_cart['price']); ?></td>
                                                <td class="align-middle">
                                                    <form action="" method="post">
                                                        <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
                                                        <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['quantity']; ?>">
                                                        <input type="submit" value="update" name="update_update_btn" class="btn bg-primary text-white">
                                                    </form>
                                                </td>
                                                <td class="align-middle">₱ <?php echo $sub_total = number_format($fetch_cart['price'] * $fetch_cart['quantity']); ?> </td>
                                                <td class="align-middle"><a href="addToCart.php?remove=<?php echo $fetch_cart['id']; ?>" onclick="return confirm('remove item from cart?')" class="btn btn-danger delete-btn"> <i class="fas fa-trash"></i> remove</a></td>
                                            </tr>
                                    <?php
                                            $grand_total += $sub_total;
                                        };
                                    };
                                    ?>
                                    <tr class="table-bottom">
                                        <td colspan="3"><a href="shop.php" class="option-btn" style="margin-top: 10;">continue shopping</a></td>
                                        <td></td>
                                        <td>Total: ₱ <?php echo $grand_total; ?> </td>
                                        <td><a href="addToCart.php?delete_all" onclick="return confirm('are you sure you want to delete all?');" class="btn btn-danger delete-btn"> <i class="fas fa-trash"></i> delete all </a></td>
                                    </tr>

                                </tbody>

                            </table>

                            <div class="checkout-btn">
                                <a href="checkout.php" class="btn btn-primary <?= ($grand_total > 1) ? '' : 'disabled'; ?>"> Procced to Checkout</a>
                            </div>

                        </section>

                    </div>

                    <!-- custom js file link  -->
                    <script src="js/script.js"></script>

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


                <script src="js/script.js"></script>
</body>


</html>