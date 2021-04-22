<?php
if (isset($_POST['submit'])) {
  $name=$_POST["name"];
  $username =$_POST["username"];
  $email =$_POST["email"];
  $password= $_POST["password"];
  $gender= $_POST["gender"];
  $contact= $_POST["contact"];
  $address= $_POST["address"];

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
    $check = "SELECT username FROM users WHERE username=? LIMIT 1";
    $password =md5($password);
    $sql= "INSERT INTO users (name, username, email, password, gender, contact, address) 
    VALUES ('$name','$username','$email','$password','$gender','$contact','$address')";
    $stmt = $conn->prepare($check);
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $stmt->bind_result($username);
    $stmt->store_result();
    $rnum= $stmt->num_rows();
    if($rnum==0){
      $stmt->close();
      $stmt=$conn->prepare($sql);
      $conn->query($sql);      
      header('location: ../equip_products.php'); 
    } else {
        echo "You have to use other username";

    } $stmt->close();
      $conn->close(); 
}
}
     ?>