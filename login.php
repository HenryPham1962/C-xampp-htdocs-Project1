<?php require ('components/head.php');?>
<?php require ('components/header.php');?>  
<div class="p-5 text-center bg-image hover-shadow"
        style="background-image: url('./img/2.jpg');height: 420px;">
        <div class="mask" style="background-color: rgba(179, 121, 121, 0.521)">
          <div class="d-flex justify-content-center align-items-center h-100">
            <div >
              <h1 class="mb-3">Enjoy promotion </h1>
              <h3 class="mb-3"> up to 50%</h3>
            </div>
          </div>
        </div>
      </div>
    </header>  
<div class="container text-center">
  <section>
    <h4 class= "text-info mt-4">LOG IN</h4><br>
    <div class="form-outline ">
      <form action="database/login.inc.php" method="POST">
         <input type="text" name="username" placeholder="Username" required/><br><br>
         <input type="password" name="password" placeholder="Password" required/><br><br>
         <button class="btn btn-info" type="submit" name="login_user"> Log in</button><br><br>
         <p> Not yet a member? <a href="registry.php">Sign up</a></p>
       </form>
    </div>
  </section>
</div>  
<?php require ('components/footer.php');?>
