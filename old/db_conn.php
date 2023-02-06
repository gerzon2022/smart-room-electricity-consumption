<?php

$servername = "localhost";
$username = "root";
$password = "";

$db_name = "gerzon";

$conn = mysqli_connect($servername, $username, $password, $db_name);

if(!$conn){
    die("Connection failed " . mysqli_connect_error());
}
?>