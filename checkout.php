<!DOCTYPE html>
<html lang="en">

<?php session_start();




require 'sql/db.php';
$username = $password = "";
$username_err = $password_err = $login_err = "";

$user_id = $_SESSION['id'];

$get_user = mysqli_query($link, "SELECT fullName, phoneNo, email, houseNo, subdivision, street, barangay, city FROM accounts WHERE id = $user_id");
$row = mysqli_fetch_row($get_user);

?>

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>checkout</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/sb-admin-2.css">

</head>

<body>
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
               <i class="fas fa-fw fa-house-chimney"></i>
               <span>Home</span>
            </a>
         </li>

         <!-- Divider -->
         <hr class="sidebar-divider my-0">

         <!-- Nav Item - Dashboard -->
         <li class="nav-item active">
            <a class="nav-link" href="shop.php">
               <i class="fas fa-fw fa-building"></i>
               <span>Shop</span>
            </a>
         </li>

         <!-- Divider -->
         <hr class="sidebar-divider my-0">

         <!-- Nav Item - Dashboard -->
         <li class="nav-item ">
            <a class="nav-link" href="about.php">
               <i class="fas fa-fw fa-info"></i>
               <span>About</span>
            </a>
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
      <div id="content-wrapper " class="d-block w-100" >
         <!-- Main Content -->
         <div id="content " class="overflow-auto">
            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow ">
               <!-- Sidebar Toggle (Topbar) -->
               <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                  <i class="fa fa-bars"></i>
               </button>

               <!-- Topbar Navbar -->
               <ul class="navbar-nav ml-auto d-flex align-items-center">
                  <li class="nav-item dropdown no-arrow mx-1">
                     <!-- <a class="nav-link dropdown-toggle" href="index_addToCart.php" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-shopping-cart fa-fw"></i> -->
                     <!-- Counter - Messages -->
                     <!-- <span class="badge badge-danger badge-counter"><?php echo $row_count; ?></span>
                    </a> -->
                     <!-- Dropdown - Messages
                    <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                        <h6 class="dropdown-header">
                            Shopping Cart
                        </h6>

                    </div> -->
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
                  <div class="topbar-divider d-none d-sm-block"></div>

                  <!-- Nav Item - Sign Up -->
                  <!-- <a href="sign_in.php">Sign In </a> -->
               </ul>
            </nav>

            <?php

            @include 'sql/db.php';

            if (isset($_POST['order_btn'])) {

               $get_user = mysqli_query($link, "SELECT fullName, phoneNo, email, houseNo, subdivision, street, barangay, city FROM accounts WHERE id = $user_id");
               $row = mysqli_fetch_row($get_user);
               // echo $row[];

               $name = $_POST['fullName'];
               $number = $_POST['phoneNo'];
               $email = $_POST['email'];
               $method = $_POST['method'];
               $houseno = $_POST['houseNo'];
               $subd = $_POST['subdivision'];
               $street = $_POST['street'];
               $barangay = $_POST['barangay'];
               $city = $_POST['city'];
               $date = $_POST['savedate'];

               $cart_query = mysqli_query($link, "SELECT * FROM `users_cart` WHERE user_id = $user_id");
               $price_total = 0;
               if (mysqli_num_rows($cart_query) > 0) {
                  while ($product_item = mysqli_fetch_assoc($cart_query)) {
                     $product_name[] = $product_item['name'] . ' (' . $product_item['quantity'] . ') ';
                     $product_price = number_format($product_item['price'] * $product_item['quantity']);
                     $price_total += $product_price;
                  };
               };

               $total_product = implode(', ', $product_name);
               $detail_query = mysqli_query($link, "INSERT INTO `order`(datetime, fullName, phoneNo, email, method, houseNo, subdivision, street, barangay, city,  total_products, total_price) VALUES('$date', '$name','$number','$email','$method','$houseno','$subd','$street','$barangay','$city','$total_product','$price_total')") or die('query failed');

               if ($cart_query && $detail_query) {
            ?>

                  
                        <div class='order-message-container' style = "position:fixed; top:0;left:20em;min-height: 80vh; overflow-y: hidden;overflow-x:hidden; padding:2rem;display:flex; align-items:center;justify-content:center;z-index:1100;background-color:white;width:70%;margin-top:5rem;flex-direction:column;">
                           <div class="message-continer" style = "display:flex;width:50rem;background-color:var(--white);border-radius:.5rem;align-items:center;justify-content:center;">
                              <h3 style="font-size:2.5rem;color:blue;"><strong>THANK YOU FOR SHOPPING!</strong></h3>
                           </div>
                           <div class="order-detail" style = "background-color:var(--bg-color);border-radius: .5rem; padding:0rem;margin:1rem 0;padding-right:5rem; padding:0 10% ;">
                           <div>   
                           <p><b> Hi </b> <span> <?php echo $_POST['fullName'] ?>, </span> </p>
                              <p> Your order is now being processed.</p>
                           <div>
                              <div class="border-top border-bottom">
                                 <table class="table ">
                                    <thead>
                                       <tr>
                                          <th scope="col">ADDRESS</th>
                                          <th scope="col">EMAIL</th>
                                          <th scope="col">NUMBER</th>
                                          <th scope="col">PAYMENT</th>
                                       </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                          <td><?php echo $_POST['houseNo'].  ", "   .$_POST['subdivision'] . ", " . $_POST['street'] . ", " . $_POST['barangay'] . ", " . $_POST['city']  ?></td>
                                          <td><?php echo $_POST['email'] ?></td>
                                          <td><?php echo $_POST['phoneNo'] ?></td>
                                          <td><?php echo $_POST['method'] ?></td>
                                          <p><b> Date and Time of Order :</b> <span> <?php echo $_POST['savedate'] ?> </span> </p>
                                       </tr>   
                                    </tbody>

                                 </table>
                                 
                              <div class="border-top border-bottom">
                              <span><b>Products:</b></span>
                              <span><?php echo $total_product  ?></span>
                              <p class='total'> <br><b>Total:</b> ₱ <?php echo $price_total ?>.00  </p>
                              </div>
                              
                              <p>*<b>Note:</b> Pay when product is delivered. *</p>
                              <p>*<b>Note:</b> For new customers, the owner might contact you through Email or your Phone Number to confirm your order.*</p>

                           </div><br>
                           <div>
                              <center>
                              <a href='shop.php' class='btn btn-primary'>Continue Shopping</a>
                              
                              <a href='homepage.php' class='btn btn-primary'>Back to Homepage</a>
                              </center>
                           </div>
                        </div><br><br><br><br><br><br><br><br><br><br><br><br>
                    
                        
            <?php
               }
            }
            ?>

            <!-- include header -->

            <div class="container-fluid column d-flex justify-content-center">

               <section class="checkout-form">

                  <h1 class="h2 mb-0 text-gray-900 mb-3">Almost There! Complete Your Order</h1>

                  <form class="user" action="" method="post">

                     <div class="display-order d-flex row justify-content-center">

                        <table class="table" style="width:100%">

                           <thead class="bg-primary text-white">
                              <th scope="col">Product Name</th>
                              <th scope="col">Quantity</th>
                              </tr>
                           </thead>
                           <tbody>

                              <?php
                              $select_cart = mysqli_query($link, "SELECT * FROM `users_cart` WHERE user_id = $user_id");
                              $total = 0;
                              $grand_total = 0;
                              if (mysqli_num_rows($select_cart) > 0) {
                                 while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
                                    $total_price = number_format($fetch_cart['price'] * $fetch_cart['quantity']);
                                    $grand_total = $total += $total_price;
                              ?>

                                    <tr>
                                       <td class="align-middle"><?= $fetch_cart['name']; ?></td>
                                       <td class="align-middle"><?= $fetch_cart['quantity']; ?> pcs.</td>
                                    </tr>

                              <?php
                                 }
                              } else {
                                 echo "<div class='display-order'><span>your cart is empty!</span></div>";
                              }
                              ?>

                           </tbody>
                        </table>
                        <div class="bg-dark ">
                           <span class="grand-total h5 text-white col-6 col-md-4">Grand Total : ₱<?= $grand_total; ?> </span>
                        </div>
                     </div>

                  </form>

               </section>

            </div>
            <div class="card o-hidden border-0 shadow-lg my-5 d-flex justify-content-center">
               <div class="card-body p-0">
                  <!-- Nested Row within Card Body -->
                  <div class="row d-flex justify-content-center">
                     <!-- <div class="col-lg-5 d-none d-lg-block bg-register-image"></div> -->
                     <div class="col-lg-8">
                        <div class="p-5">
                           <div class="text-center">
                              <h1 class="h4 text-gray-900 mb-4">Delivery Form Details</h1>
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
                                    <div class="form-group">

                                       <input class="form-control form-control-user" type="datetime-local" placeholder="" name="savedate" required>
                                    </div>
                                 </div>
                                 <div class="inputBox">
                                    <p>Payment Method: </p>

                                    <select class="form-select form-select-lg" name="method">
                                       <option value="cash on delivery" selected>Cash on Delivery</option>
                                       <option value="gcash">Gcash</option>
                                    </select>

                                 </div>
                                 <br><br>
                                 <input type="submit" value="order now" name="order_btn" class="btn btn-primary btn-md" data-toggle="modal" data-target="#receiptModal"></input>

                                 <!-- <button type="button" name="order_btn" href="#" class="btn btn-primary btn-md" data-toggle="modal" data-target="#receiptModal">
                                    Order Now
                                 </button> -->

                           </form>

                        </div>
                     </div>
                  </div>
               </div>
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
            </div>

            <footer class="sticky-footer ">
               <div class="container w-100">
                  <div class="copyright text-center">

                     <span>Copyright &copy; 2022 <a href="https://www.facebook.com/BlessedFlowWaterRefillingStation">BlessedFlow Water Refilling Station</span>

                  </div>

               </div>
            </footer>
            

            <!-- custom js file link  -->
            <script src="js/script.js"></script>

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

</body>

</html>