
<?php require ('./components/head.php');?>
<?php include ('./components/navbar.php');?>

<div class="container text-center">
  <section>
    <h5 class= "text-info mt-4">Admin Log in</h5><br>
     <div class="form-outline ">
      <form action="items.php" method="POST">
         <input type="text" name="adminname" placeholder="Admin name" required/><br><br>
         <input type="password" name="password" placeholder="Password" required/><br><br>
         <input type="text" name="admin_pwd" placeholder="Admin security number" required/><br><br>
         <button class="btn btn-info" type="submit" name="login_admin"> Log in</button><br><br>
       </form>
    </div>
  </section>
</div>  
<?php 
//log in
if (isset($_POST['login_admin'])) {
    $adminname = $_POST['adminname'];
    $password = $_POST['password'];
    $admin_pwd= $_POST["admin_pwd"];

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
            if($admin_pwd ==11 || $admin_pwd ==22){
              header('location:/Project1/item_manage.php');
             } elseif($admin_pwd ==44 || $admin_pwd ==33){
              header('location:/Project1/brand_manage.php');
             } elseif($admin_pwd ==55 || $admin_pwd ==11){
             header('location: /Project1/invoice_manage.php');
             } else {
              echo "Permision denied";
             }
        //$_SESSION ['Login'] = "You have login successfully"; 
       //echo "You have login successfully";
       //header ('location:../items.php'); 
       
     } $stmt->close();
       $conn->close();
  }
?>
<?php require ('./components/footer.php');?>