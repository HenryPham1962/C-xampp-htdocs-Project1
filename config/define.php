<?php
define('SERVERNAME','localhost');
define('DB_USERNAME','root');
define('DB_PASSWORD','');
define('DB_NAME','hair_care');

$conn = mysqli_connect(SERVERNAME, DB_USERNAME, DB_PASSWORD, DB_NAME) or die(mysqli_error());
$db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error());
?>