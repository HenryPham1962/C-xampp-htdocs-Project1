<?php require ('./components/head.php');?>
<?php include ('./components/navbar.php');?>
<div class="container text-center">
  <section>
    <h5 class= "text-info mt-4">Admin login</h5><br>
     <div class="form-outline ">
      <form action="invoice.php" method="POST">
         <input type="text" name="adminname" placeholder="Admin name" required/><br><br>
         <input type="password" name="password" placeholder="Password" required/><br><br>
         <input type="text" name="admin_role" placeholder="Admin security role number" required/><br><br>
         <button class="btn btn-info" type="submit" name="login_admin"> Login</button><br><br>
         <p> Are you admin? You have to regist first <a href="admin.php">Registeration</a></p>
       </form>
    </div>
  </section>
</div>  
<?php 
//log in
if (isset($_POST['login_admin'])) {
    $adminname = $_POST['adminname'];
    $password = $_POST['password'];
    $admin_role= $_POST["admin_role"];

$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName ="hair_care";

    $errors= array();
    $conn = new mysqli($servername,$dbUsername,$dbPassword,$dbName);
 
        $password = md5($password);
        $query = "SELECT * FROM admins WHERE adminname='$adminname' AND password='$password'";
        $results = mysqli_query($conn, $query);
        if (mysqli_num_rows($results) == 1) {
            if($admin_role ==11 || $admin_role ==55){
               header('location: /Project1/invoice_manage.php');
       } else {
              echo "Permision denied";
      }     
    } $stmt->close();
      $conn->close();
  }
?>
<?php require ('./components/footer.php');?>