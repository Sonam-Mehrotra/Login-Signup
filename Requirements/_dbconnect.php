<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "users";

//Create connection with database
$conn = mysqli_connect($servername, $username, $password, $dbname);
if(!$conn){
    die("Connection failed");
}

?>