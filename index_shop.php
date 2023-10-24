<?php
session_start();
require 'sql/db.php';
if (isset($_POST['add_to_cart'])) {

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];

    $product_quantity = 1;

    $select_cart = mysqli_query($link, "SELECT * FROM `cart` WHERE name = '$product_name'");

    if (mysqli_num_rows($select_cart) > 0) {
        $message[] = 'product already added to cart';
    } else {
        $insert_product = mysqli_query($link, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image',  '$product_quantity')");
        $message[] = 'product added to cart succesfully';
    }
}
    $select_rows = mysqli_query($link, "SELECT * FROM `cart`") or die('query failed');
      $row_count = mysqli_num_rows($select_rows);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>BFWRS - SHOP</title>
    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/sb-admin-2.css">
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-tint"></i>
                </div>
                <div class="sidebar-brand-text mx-3">BFWRS</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-house-chimney"></i>
                    <span>Home</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index_shop.php">
                    <i class="fas fa-fw fa-building"></i>
                    <span>Shop</span>
                </a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link" href="index_about.php">
                    <i class="fas fa-fw fa-info"></i>
                    <span>About</span>
                </a>
            </li>
            <hr class="sidebar-divider my-0">
            <!-- Nav Item - Dashboard -->
            <li class="nav-item ">
                <a class="nav-link" href="index.php #container-how-to-order">
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
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="index_addToCart.php" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-shopping-cart fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter"><?php echo $row_count;?></span>
                            </a>
                            
                            
                        
                        </li>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="sign_in.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sign In
                                </a>
                                
                                
                            </div>

                        

                        
                    </ul>
                </nav>
                <?php

                if (isset($message)) {
                    foreach ($message as $message) {
                       
                        echo "<script type='text/javascript'>alert('$message');</script>";
                    };
                };

                ?>
                <div class="container d-flex justify-content-center mt-50 mb-50">
                    <div class="container-fluid">

                        <section class="products">

                            <div class="d-sm-flex align-items-center justify-content-between">
                                <h1 class="h2 mb-0 text-gray-900">Shop</h1>
                            </div>

                            <div class="row mt-2">

                                <?php

                                $select_products = mysqli_query($link, "SELECT * FROM `products`");
                                $records = array();
                                if (mysqli_num_rows($select_products) > 0) {
                                    while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                                        $records[] = $fetch_product;
                                    }

                                    foreach ($records as $rec) {
                                ?>

                                        <form action="" method="post" class="col-3 mt-2 mb-2 py-1">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div class="card-img-actions"><img src="img/<?php echo $rec['image']; ?>" alt="" class="card-img img-fluid" width="150" height="150"></div>
                                                </div>
                                                <div class="card-body bg-light text-center">
                                                    <h3><?php echo $rec['name']; ?></h3>
                                                    <div class="price">₱ <?php echo $rec['price']; ?></div>
                                                    <div class="mb-2">
                                                        <h6 class="font-weight-semibold mb-2"><input class="text-default mb-2" type="hidden" name="product_name" value="<?php echo $rec['name']; ?>"></h6>
                                                    </div>
                                                    <img src="img/<?php echo $fetch_product['image']; ?>" alt="">
                                                    <input type="hidden" name="product_price" value="<?php echo $rec['price']; ?>">
                                                    <input type="hidden" name="product_image" value="<?php echo $rec['image']; ?>">
                                                    

                                                    <input type="submit" class="product dropdown-item view_data" value="Add to Cart" name="add_to_cart">
                                                    <!-- btn-primary btn-md -->
                                                </div>
                                            </div>
                                        </form>

                                <?php
                                    };
                                };
                                ?>

                            </div>
                        </section>
                    </div>
                </div>
                <footer class="sticky-footer ">
                    <div class="container w-100">
                        <div class="copyright text-center">
                            <span>Copyright &copy; 2022 <a href="https://www.facebook.com/BlessedFlowWaterRefillingStation">BlessedFlow Water Refilling Station</span>

                        </div>

                    </div>

                </footer>

            </div>

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

            <!-- custom js file link  -->
            <!-- <script src="js/script.js">


            </script> -->
</body>

</html>