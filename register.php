<!DOCTYPE html>
<html lang="en">
<?php
session_start();
require('sql/db.php');
$user = 0;
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    // Function definition
    function function_alert($message) {
                
    // Display the alert box 
    echo "<script>alert('$message');</script>";
    }
   
        $fullName = $_POST['fullName'];
        $phoneNo = $_POST['phoneNo'];
        $email = $_REQUEST['email'];
        $houseNo = $_REQUEST['houseNo'];
        $street = $_REQUEST['street'];
        $subdivision = $_REQUEST['subdivision'];
        $brgy = $_REQUEST['brgy'];
        $city = $_REQUEST['city'];
        $username =  $_REQUEST['username'];
        $password = $_POST['password'];
        $cPassword = $_POST['repeatPass'];
        $encryptPass = md5($password);
       
        $sql = "SELECT * FROM accounts where username='$username'";
        // $sql = "INSERT INTO accounts (fullName, phoneNo, email, houseNo, street, subdivision, barangay, city, username, password) VALUES ('$fullName','$phoneNo', '$email','$houseNo','$street','$subdivision','$brgy','$city','$username', '$encryptPass')";
        
        $result=mysqli_query($link, $sql);
        if($num=mysqli_num_rows($result) === 0){
                if($password===$cPassword) {
                    $sql = "INSERT INTO accounts (fullName, phoneNo, email, houseNo, street, subdivision, barangay, city, username, password) VALUES ('$fullName','$phoneNo', '$email','$houseNo','$street','$subdivision','$brgy','$city','$username', '$encryptPass')";
                    $result=mysqli_query($link, $sql);
                    if ($result){
                        header("Location: sign_in.php");
                        exit();
                        // Function call
                        function_alert("You have successfully Signed Up Click OK to continue");
        
                        // link($home);
                    }
                }
                else {
                     function_alert("Password and Repeat Password do not match!");
                }
            }
            else{
                function_alert("Username is already used!");
            // echo "ERROR: Hush! Sorry $sql. " 
            //     . mysqli_error($link);
            }
}

?>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>BFWRS - Register</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <!-- Nested Row within Card Body -->
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
                            </div>
                            <form class="user" id="accounts" method="POST">
                                <div class="form-group">
                                    
                                        <input type="text" class="form-control form-control-user" id="exampleFullName"
                                           name="fullName" placeholder="Full Name" required>
                                    
                                   <!--  <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleLastName"
                                            placeholder="Last Name">
                                    </div> -->
                                </div>
                                <div class="form-group">
                                    
                                        <input type="text" class="form-control form-control-user" id="examplePhoneNo"
                                            name= "phoneNo" placeholder="Contact Number" required>

                                </div>
                                <div class="form-group">
                                    
                                        <input type="email" class="form-control form-control-user" id="example@email.com"
                                            name= "email" placeholder="Email" required>

                                </div>
                                <div class="form-group row">
                                     <div class="col-sm-4 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleHouseNo"
                                            name="houseNo" placeholder="House No.">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-user" id="exampleSubdivision" name="subdivision"
                                            placeholder="Subdivision">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" class="form-control form-control-user" id="exampleStreet"
                                           name="street" placeholder="Street">
                                    </div>

                                </div>
                                 <div class="form-group row">
                                     <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="text" class="form-control form-control-user" id="exampleBarangay"
                                            name="brgy" placeholder="Barangay">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="text" class="form-control form-control-user" id="exampleCity"
                                            name="city" placeholder="City">
                                    </div>
                                </div>
                                 <div class="form-group">
                                    
                                        <input type="text" class="form-control form-control-user" id="exampleUserName"
                                            name= "username" placeholder="Username">

                                </div>


                                <div class="form-group row">
                                    <div class="col-sm-6 mb-3 mb-sm-0">
                                        <input type="password" class="form-control form-control-user"
                                            name = "password" id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="password" class="form-control form-control-user"
                                            name= "repeatPass" id="exampleRepeatPassword" placeholder="Repeat Password">
                                    </div>
                                </div>
                                 <div class="form-group">
                                 <!-- <div class="form-check">
                                  <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                                  <label class="form-check-label" for="flexCheckDefault">
                                    Administrator?
                                  </label>
                                </div> -->
                            </div>
                                <input type="submit" class="btn btn-primary btn-user btn-block">
                                    
                                

                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="sign_in.php">Already have an account? Login!</a>
                            </div>
                        </div>
                    </div>
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

</body>

</html>