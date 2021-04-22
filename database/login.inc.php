<?php

if (isset($_POST['login_user'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


$servername = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName ="hair_care";

    $errors= array();
    $conn = new mysqli($servername,$dbUsername,$dbPassword,$dbName) or die (mysqli_error($mysqli));
 
        $password = md5($password);
        $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $results = mysqli_query($conn, $query);
        if (mysqli_num_rows($results) == 1) {
          header('location:../equip_products.php'); 
        }else {
            //array_push($errors, "Wrong username/password combination");
            echo "Invalid username or password";
           // header('location: ../error.php');
        } 
        $conn->close(); 
    }
  ?>