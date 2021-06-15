<?php

$servername="localhost";
$username="user_name";
$password="user_pwd";
$database="db_name";
$conn = new mysqli($servername,$username,$password,$database);
if($conn->connect_error) {
  exit('Error connecting to database'); //Should be a message a typical user could understand in production
}
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
$conn->set_charset("utf8mb4");

?>