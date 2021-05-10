<?php require ('components/head.php');?>
<?php include ('components/header.php');?> 
<?php include ('components/background_img.php'); ?>
<div class="container text-center">
  <section>
    <h5 class="text-warning mt-4">ORDER</h5><br>
    <div class="form-outline">
      <form action="database/regist.inc.php" method="POST">
         <input type="text" name="name" placeholder="Full name" required/><br><br>
         <input type="text" name="username" placeholder="Username" required/><br><br>
         <input type="text" name="email" placeholder="Email" required/><br><br>
         <input type="password" name="password" placeholder="Password" required/><br><br>
       <div class="form-check form-check-inline">
          <input class="form-check-input " type="radio" name="gender" value="male">
          <label class="form-check-label" for="Male">Male</label>
        </div>
       <div class="form-check form-check-inline">
           <input class="form-check-input" type="radio" name="gender" value="female" checked>
           <label class="form-check-label" for="Female">Female</label>
       </div><br><br>
        <button class="btn btn-warning" type="submit" name="submit"> Register</button><br><br>
       </form>
    </div>
  </section>
</div>  

<?php
// (A) PROCESS ORDER FORM
if (isset($_POST['place_order'])) { 
  require "order.php"; 
  echo $result == "" 
    ? "<div class='notify'>Thank You! We have received your order</div>" 
    : "<div class='notify'>$result</div>" ;
}
?>
<div class="container justify-content-center"> 
<section class="align-items-center">
<!-- (B) ORDER FORM -->
<form class="container text-center" id="orderform" method="post" target="_self">
  <h1>Order Form</h1>
  <label for="name">Name:</label>
  <input type="text" name="name" required /> 
  <label for="email">Email:</label>
  <input type="email" name="email" required /> 
  <label for="tel">Telephone:</label>
  <input type="text" name="tel" required /> 
  <label for="qty">Quantity Needed:</label>
  <input type="number" name="qty" required /> 
  <label for="notes">Additional Notes (if any):</label>
  <textarea name="notes"></textarea>
  <input type="submit" name ="place_order" value="Place Order"/>
</form>
</section>
</div>
<?php require ('components/footer.php');?>
