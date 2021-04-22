<?php require ('components/head.php');?>
<?php require ('components/header.php');?>  
<div class="p-5 text-center bg-image hover-shadow"
        style="background-image: url('./img/2.jpg');height: 420px;">
        <div class="mask" style="background-color: rgba(179, 121, 121, 0.521)">
          <div class="d-flex justify-content-center align-items-center h-100">
            <div >
              <h1 class="mb-3">Register and enjoy promotion </h1>
              <h3 class="mb-3"> up to 50%</h3>
            </div>
          </div>
        </div>
      </div>
    </header>  
<div class="container text-center">
  <section>
    <h5 class="text-info mt-4">REGISTER FORM</h5><br>
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
       <input type="tel" name="contact" placeholder="Contact" required/><br><br>
       <input type="text" name="address" placeholder="Deliver address" required/><br><br>
        <button class="btn btn-info" type="submit" name="submit"> Register</button><br><br>
       </form>
    </div>
  </section>
</div>  
<?php require ('components/footer.php');?>
