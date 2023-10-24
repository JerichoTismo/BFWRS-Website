<?php 
require "sql/db.php";

    if (isset($_GET['delete'])) {
        $id = $_GET['delete'];
        
        $sql = "DELETE FROM accounts WHERE id=$id";
        $result = mysqli_query($link,$sql);
        if($result){
            $message = "Deleted";
            echo "<script type='text/javascript'>alert('$message');</script>";
            header('location:admin_index.php');
        }
        else{
            die(mysqli_error($link));
            
        }
        
    }

?>
