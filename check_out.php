<?php require ('components/head.php');?>
<?php include ('components/header.php');?> 
<?php include ('./components/brand.php');?>
<?php
 $subtotal = 0;
 $total_after_tax= 0;
// (A) PROCESS ORDER FORM
if (isset($_GET["order"])) { 
    $subtotal=$_GET["order"];
}
?>
 <div class="container text-center">
    <section class="align-items-center">
     <!-- (B) ORDER FORM -->
           <h4 class="text-warning mt-4">CHECK OUT</h4>
   <form action="check_out.php" method="POST" >         
     <div class="form-outline">
      <input type="text" name="name" placeholder="Full name" required/><br><br>
       <input type="text" name="username" placeholder="Username" required/><br><br>
       <input type="text" name="email" placeholder="Email" required/><br><br>
       <input type="text" name="contact" placeholder="Telephone" required/><br><br>
       <div class="form-check form-check-inline">
             <input class="form-check-input " type="radio" name="form_payment" value="cash">
             <label class="form-check-label" for="Cash">Cash</label>
        </div>
       <div class="form-check form-check-inline">
             <input class="form-check-input" type="radio" name="form_payment" value="credit_card" checked>
             <label class="form-check-label" for="credit_card">Credit card</label>
       </div><br><br>
       <input type="text" name="card_number" placeholder="Credit card number"/><br><br>
       <label for="subtotal">Subtotal: $</label>         
       <input class="container text-center col-lg-3" type="text" name="subtotal" value="<?= ($subtotal);?>" /> <br><br>
       <label for="total_after_tax">Total after tax: $</label>         
       <input class="container text-center col-lg-3" type="text" name="total_after_tax" value="<?= 1.1*($subtotal);?>" /> <br><br>
       <input class="container text-center col-lg-4" type="text" name="address" placeholder="Address" required/><br><br>
       <textarea class="container text-center col-lg-4" name="notes" placeholder="Additional Information"></textarea> <br><br>  
       <button class="btn btn-warning" type="submit" name="check_out">Place Order</button><br><br>
     </div> 
     </form>
   </section>
 </div>
 <?php
 $servername = "localhost";
 $dbUsername = "root";
 $dbPassword = "";
 $dbName ="hair_care";

     $conn = new mysqli($servername,$dbUsername,$dbPassword,$dbName) or die ($mysqli_error($mysqli));
 
if (isset($_POST['check_out'])) {
   $name= $_POST['name'];
    $username = $_POST['username'];
    $email=$_POST['email'];
    $contact= $_POST['contact'];
    $card_number= $_POST['card_number'];
    $subtotal = $_POST['subtotal'];
    $total_after_tax= $_POST['total_after_tax'];
    $address = $_POST['address'];
    $notes = $_POST['notes'];
    $insert = "INSERT INTO tbl_invoice (name, username, email, contact,card_number,subtotal, total_after_tax, address, notes) 
    VALUES('$name','$username','$email','$contact','$card_number','$subtotal', '$total_after_tax','$address','$notes')" or die (mysqli_error());
    $stmt=$conn->prepare($insert);
    $conn->query($insert);   

 // $sql = "SELECT * FROM users WHERE username= $username";
  //$result = mysqli_query($conn, $sql);
  //while($row = $result->fetch_assoc()):;
  //$name=$row['name'];
  //$email=$row['email'];
  //$contact=$row['contact'];
  //$address=$row['address'];
  //$sql = "UPDATE tbl_invoice SET name ='$name', email ='$email', contact='$contact', address='$address' WHERE username='$username'" 
  //or die (mysqli_error());
  //$stmt=$conn->prepare($sql);
  //$conn->query($sql);  
   echo "Order has been saved";
}
  ?>      
<?php require ('components/footer.php');?>
