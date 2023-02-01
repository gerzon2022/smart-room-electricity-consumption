<?php
session_start();
include "db_conn.php";
if ((isset($_POST['username']) && isset($_POST['password']) && isset($_POST['user_type'])) ||
    (isset($_GET['username']) && isset($_GET['password']) && isset($_GET['user_type']))) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $username = validate($_POST['username']);
    $password = validate($_POST['password']);
    $user_type = validate($_POST['user_type']);
    if (empty($username)) {
        header("Location: ../login.php?error=Username is required");
        exit();
    } else if (empty($password)) {
        header("Location: ../login.php?error=Password is required");
    } else {
        $password = md5($password);
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if ($row['password'] === $password && $row['user_type'] === $user_type) {
                $_SESSION['id'] = $row['id'];
                $_SESSION['username'] = $row['username'];
                $_SESSION['password'] = $row['password'];
                $_SESSION['user_type'] = $row['user_type'];
                $_SESSION['full_name'] = $row['full_name'];
                $_SESSION['contact_number'] = $row['contact_number'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['course'] = $row['course'];
                $_SESSION['allowance'] = $row['allowance'];
                header("Location: ../dashboard.php");
            } else {
                header("Location: ../login.php?error=Incorrect password or user type");
                exit();
            }
        } else {
            header("Location: ../login.php?error=Incorrect username or password");
            exit();
        }
    }
} else {
    header("Location: ../login.php");
    exit();
}