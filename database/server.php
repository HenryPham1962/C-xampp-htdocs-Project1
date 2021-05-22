<?php
session_start();
$username="";
$email="";

$errors= array();
$conn= mysqli_connect('localhost','root', '', 'hair_care') or die("could not connect to database");
//registration
if (isset($_POST['submit'])) {
$name =  $_POST['name'];
$username = $_POST['username'];
$email =  $_POST['email'];
$password =  $_POST['password'];
$gender = $_POST['gender'];
$contact= $_POST["contact"];
$address= $_POST["address"];
//validation

//check for existing user
 $check_query= "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
 
 $result = mysqli_query($conn, $check_query);
  $user= mysqli_fetch_assoc($result);

  if($user){
    if($user['$username']===$username){array_push($errors,"Username already exists" );}
    if($user['$email']===$email){array_push($errors,"Email already exists" );}
    echo"username or email had been taken";
    die();
  }  
 
if(count($errors)==0){
    $password =md5($password);
    $query = "INSERT INTO users (name,username, email, password,gender,contact,address) 
    VALUES ('$name','$username', '$email','$password','$gender','$contact','$address')";
    mysqli_query($conn, $query);
    $_SESSION['$username'] = $username;
    $_SESSION['$success'] = "You are inserted successfully";
    header('location: ../sales.php'); 
  }  
} 
 