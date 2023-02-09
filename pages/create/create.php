<?php
session_start();
include "../../db_conn.php";
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repeat_password']) &&
    isset($_POST['user_type']) && isset($_POST['first_name']) && isset($_POST['middle_name']) && isset($_POST['family_name'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $repeat_password = validate($_POST['repeat_password']);
    $user_type = validate($_POST['user_type']);
    $first_name = validate($_POST['first_name']);
    $middle_name = validate($_POST['middle_name']);
    $family_name = validate($_POST['family_name']);
   
    if (empty($username)) {
        header("Location:../dashboard.php?page=main&error=Username is required");
        exit();
    } else if (empty($password)) {
        header("Location:../dashboard.php?page=main&error=Password is required");
        exit();
    } else if (empty($repeat_password)) {
        header("Location:../dashboard.php?page=main&error=Repeat Password is required");
        exit();
    } else if (empty($user_type)) {
        header("Location:../dashboard.php?page=main&error=user_type is required");
        exit();
    } else if (empty($first_name)) {
        header("Location:../dashboard.php?page=main&error=first_name is required");
        exit();
    } else if (empty($middle_name)) {
        header("Location:../dashboard.php?page=main&error=middle_name is required");
        exit();
    } else if (empty($family_name)) {
        header("Location:../dashboard.php?page=main&error=family_name is required");
        exit();
    } 

    else if ($password !== $repeat_password) {
        header("Location:../dashboard.php?page=main&error=Repeat password does not match");
        exit();
    } else {
        $password = md5($password);
        $user_check = "SELECT * FROM `tbl_user_info` WHERE id_number='$username'";
        $user_result = mysqli_query($conn, $user_check);
        if (mysqli_num_rows($user_result) > 0) {
            header("Location:../dashboard.php?page=main&error=The username is already taken try another");
            exit();
        } else {
            $sql_insert = "INSERT INTO `tbl_user_info`(`id_number`, `acc_pw`, `first_name`, `middle_name`, `family_name`, `acc_type`) 
                        VALUES ('$username','$password','$first_name','$middle_name','$family_name', '$user_type')";
            $result_insert = mysqli_query($conn, $sql_insert);
            if ($result_insert) {
                
                header("Location:../welcome.php?success=Your account has been created successfully");
                exit();
            } else {
                
                 header("Location:../dashboard.php?page=main&error=Unknown error occured");
                exit();
            }
        }
    }
} else {
  
    header("Location:../dashboard.php?page=main");
    exit();
}