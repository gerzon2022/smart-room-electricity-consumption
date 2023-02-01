<?php
session_start();
include "db_conn.php";
if ((isset($_POST['username']) && isset($_POST['password'])) ||
    (isset($_GET['username']) && isset($_GET['password']))) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    if (empty($username)) {
        header("Location: index.php?error=Username is required");
        exit();
    } else if (empty($password)) {
        header("Location: index.php?error=Password is required");
    } else {
        $password = md5($password);
        $sql = "SELECT * FROM tbl_user_info WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['password'] === $password && $row['user_type'] === $user_type) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['user_type'] = $row['user_type'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['middle_name'] = $row['middle_name'];
                $_SESSION['family_name'] = $row['family_name'];
                $_SESSION['allowance'] = $row['allowance'];
                header("Location: pages/dashboard.php");
            } else {
                header("Location: index.php?error=Incorrect password or user type");
                exit();
            }
        } else {
            header("Location: index.php?error=Incorrect username or password");
            exit();
        }
    }
} else {
    header("Location: ../login.php");
    exit();
}