<?php 
session_start();

require 'sql/db.php';


$order_user = "SELECT fullName, phoneNo, houseNo, subdivision, street, barangay, city FROM accounts";
$order_product = "SELECT name FROM products";
$query = mysqli_query($link, $order_user);
$query2 = mysqli_query($link, $order_product);

$ordered = array();
$ordered2 = array();

while($row = mysqli_fetch_array($query)) {
    $ordered[]=$row;
}

while($row1 = mysqli_fetch_array($query2)) {
    $ordered2[]=$row1;
}

echo json_encode(array_merge($ordered, $ordered2), JSON_PRETTY_PRINT);

$orders = array_merge($ordered, $ordered2);

// $get_order = "INSERT * INTO order FROM $orders";

if(mysqli_query($link, $orders)){
    echo "success";
}else{
    echo "failed";
}
?>