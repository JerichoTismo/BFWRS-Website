
<?php  

require 'sql/db.php';

 if(isset($_POST["product_id"]))  
 {  
      include "productId.php";

      $output = '';  
      $connect = mysqli_connect("localhost", "root", "", "bfwrs");  
      $query = "SELECT p.id, p.name, p.image, p.price, c.description FROM products p JOIN categories c on p.category = c.id where p.id= '".$_POST["product_id"]."'";  
      $result = mysqli_query($connect, $query);  

      $output .= '  
      <div class="table-responsive">  
      <form method="POST" action="addToCart.php">
           <table class="table table-borderless" >';  
      while($row = mysqli_fetch_array($result)) 
       
      {  
        $pID  = $row["name"]; 
           $output .= '

               <tr>  
                    <td width="30%" hidden><label>Item ID:</label></td>  
                    <td width="70%" hidden>'.$row["id"].'</td> 

                </tr>   
                <tr>  
                     <td width="30%"><label>Item</label></td>  
                     <td width="70%">'.$row["name"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Price</label></td>  
                     <td width="70%">₱ '.$row["price"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Category</label></td>  
                     <td width="70%">'.$row["description"].'</td>  
                </tr>  
                <tr>  
                     <td width="30%"><label>Quantity</label></td>  
                     <td width="70%"><input type="number" min=1 max=50 name="qty" id="qty" value=1 "></td>  
                </tr> 
                <tr>  
                    <td width="30%"><label>Remarks</label></td>  
                    <td width="70%"><textarea name="remarks" id="remarks" autofocus></textarea></td>  
               </tr> 
              
                ';  

      }  
      $output .= "</table></form></div>";  
      echo $output; 
 
 } 
 else{
      echo "error";
 } 
 
 ?>
 
