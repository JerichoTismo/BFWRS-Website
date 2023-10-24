<!DOCTYPE html>
<html lang="en">
<?php

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: homepage.php");
    exit;
}
require 'sql/db.php';


if(isset($_POST['add_to_cart'])){

    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;
 
    $select_cart = mysqli_query($link, "SELECT * FROM `cart` WHERE name = '$product_name'");
 
    if(mysqli_num_rows($select_cart) > 0){
       $message[] = 'product already added to cart';
    }else{
       $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
       $message[] = 'product added to cart succesfully';
    }
 
 }

?>

<div class="container d-flex justify-content-center mt-50 mb-50">
                    <div class="container-fluid ">
                        <div class="d-sm-flex align-items-center justify-content-between mb-0">
                            <h1 class="h3 mb-0 text-gray-800">Container Parts</h1>
                        </div>
                        <div class="row">
                            <div class="container">

                                <section class="products">

                                

                                <div class="box-container">

                                    <?php
                                    
                                    $select_products = mysqli_query($link, "SELECT * FROM `products`");
                                    if(mysqli_num_rows($select_products) > 0){
                                        while($fetch_product = mysqli_fetch_assoc($select_products)){
                                    ?>

                                    <form action="" method="post">
                                        <div class="box">
                                            <!-- <img src="<?php echo "img/". $rec['image']; ?>" width="200" height="350" alt="">  -->
                                            <img src="img/<?php echo $fetch_product['image']; ?>" alt="">
                                            <!-- <img src="<?php echo "img/" . $rec['image']; ?>" class="card-img img-fluid" width="96" height="350" alt=""> -->
                                            <h3><?php echo $fetch_product['name']; ?></h3>
                                            <div class="price">$<?php echo $fetch_product['price']; ?>/-</div>
                                            <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                            <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                            <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                            <input type="submit" class="btn" value="add to cart" name="add_to_cart">
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
                    </div>
                </div>