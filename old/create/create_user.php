<?php
session_start();
include "../db_conn.php";
if (isset($_POST['username']) && isset($_POST['password']) && isset($_POST['repeat_password']) &&
    isset($_POST['user_type']) && isset($_POST['full_name']) && isset($_POST['contact_number'])&&
    isset($_POST['email']) && isset($_POST['course']) && isset($_POST['allowance'])) {
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
    $full_name = validate($_POST['full_name']);
    $contact_number = validate($_POST['contact_number']);
    $email = validate($_POST['email']);
    $course = validate($_POST['course']);
    $allowance = validate($_POST['allowance']);
    if (empty($username)) {
        header("Location: ../../register.php?error=Username is required");
        exit();
    } else if (empty($password)) {
        header("Location: ../../register.php?error=Password is required");
        exit();
    } else if (empty($repeat_password)) {
        header("Location: ../../register.php?error=Repeat Password is required");
        exit();
    } else if (empty($user_type)) {
        header("Location: ../../register.php?error=Password is required");
        exit();
    } else if (empty($full_name)) {
        header("Location: ../../register.php?error=Password is required");
        exit();
    } else if (empty($contact_number)) {
        header("Location: ../../register.php?error=Password is required");
        exit();
    } else if (empty($email)) {
        header("Location: ../../register.php?error=Password is required");
        exit();
    } else if (empty($allowance)) {
        header("Location: ../../register.php?error=Allowance is required for student");
        exit();
    } else if (empty($course)) {
        header("Location: ../../register.php?error=Course is required for student");
        exit();
    } else if ($password !== $repeat_password) {
        header("Location: ../../register.php?error=Repeat password does not match");
        exit();
    } else {
        $password = md5($password);
        $user_check = "SELECT * FROM `users` WHERE username='$username'";
        $user_result = mysqli_query($conn, $user_check);
        $email_check = "SELECT * FROM `users` WHERE email='$email'";
        $email_result = mysqli_query($conn, $email_check);
        if (mysqli_num_rows($user_result) > 0) {
            header("Location: ../../register.php?error=The username is already taken try another");
            exit();
        } else if (mysqli_num_rows($email_result) > 0) {
            header("Location: ../../register.php?error=The email is already taken try another");
            exit();
        } else {
            $sql_insert = "INSERT INTO `users`(`id`, `username`, `password`, `user_type`, `full_name`, `contact_number`, `email`, `course`, `allowance`) 
                        VALUES (NULL,'$username','$password','$user_type','$full_name','$contact_number','$email','$course','$allowance')";
            $result_insert = mysqli_query($conn, $sql_insert);
            if ($result_insert) {
                header("Location: ../../dashboard.php?success=Your account has been created successfully");
                exit();
            } else {
                header("Location: ../../register.php?error=Unknown error occured");
                exit();
            }
        }
    }
} else {
    header("Location: ../../login.php");
    exit();
}