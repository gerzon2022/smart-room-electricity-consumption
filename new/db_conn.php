<?php

$servername = "localhost";
$username = "root";
$password = "";

$db_name = "cloudcontrol";

$conn = mysqli_connect($servername, $username, $password, $db_name);

if(!$conn){
    echo "nahh";
    die("Connection failed " . mysqli_connect_error());
} else {
    echo "success";
}

?>