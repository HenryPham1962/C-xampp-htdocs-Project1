
<?php require ('./components/head.php');?>
<?php include ('components/navbar.php');?>
<?php include ('components/slogan.php');?>
<div class="container text-center">
  <section>
    <h5 class="text-info mt-4">Admin registeration </h5><br>
    
    <div class="form-outline">
      <form action="admin.php" method="POST">
         <input type="text" name="name" placeholder="Full name" required/><br><br>
         <input type="text" name="adminname" placeholder="Admin name" required/><br><br>
         <input type="text" name="email" placeholder="Email" required/><br><br>
         <input type="password" name="password" placeholder="Password" required/><br><br>
         <input type="text" name="admin_pwd" placeholder="Admin security" required/><br><br>
       <button class="btn btn-info" type="submit" name="register_admin"> Register</button><br><br>
       </form>
    </div>
  </section>
</div>

<?php require ('components/footer.php');?>
<?php 

//insert admindata
if (isset($_POST['register_admin'])) {
  $name=$_POST["name"];
  $adminname =$_POST["adminname"];
  $email =$_POST["email"];
  $password= $_POST["password"];
  $admin_pwd= $_POST["admin_pwd"];
 
 $servername = "localhost";
 $dbUsername = "root";
 $dbPassword = "";
 $dbName ="hair_care";
   //connect to the database
     $conn = new mysqli($servername,$dbUsername,$dbPassword,$dbName);
 
 if(mysqli_connect_error()){
     die('Connect Error('.mysqli_connect_error().')' .mysqli_connect_error());
} else {
       //check validation
    $check = "SELECT adminname FROM admins WHERE adminname=? LIMIT 1";
    $password =md5($password);
    $sql= "INSERT INTO admins (name, adminname, email, password, admin_pwd) VALUES ('$name','$adminname','$email','$password','$admin_pwd')";
    $stmt = $conn->prepare($check);
    $stmt->bind_param("s",$adminname);
    $stmt->execute();
    $stmt->bind_result($adminname);
    $stmt->store_result();
    $rnum= $stmt->num_rows();
    if($rnum==0){
      $stmt->close();
      $stmt=$conn->prepare($sql);
      $conn->query($sql);      
      echo "Admindata inserted. Now you can go to your section";
      
     } else {
       //echo "You have to use other adminname";
    }  $stmt->close();
       $conn->close();
  }
}
?>
