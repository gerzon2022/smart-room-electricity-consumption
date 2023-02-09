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
        header("Location:index.php?error=Username is required");
        exit();
    } else if (empty($password)) {
        header("Location:index.php?error=Password is required");
    } 
    else {
        $password = md5($password);
        $sql = "SELECT * FROM tbl_user_info WHERE id_number='$username' AND acc_pw='$password'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
           
               
                $_SESSION['id_number'] = $row['id_number'];
                $_SESSION['password'] = $row['acc_pw'];
                $_SESSION['acc_type'] = $row['acc_type'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['middle_name'] = $row['middle_name'];
                $_SESSION['family_name'] = $row['family_name'];
                $_SESSION['p_consumable'] = $row['p_consumable'];
                $_SESSION['p_consumed'] = $row['p_consumed'];
                header("Location: ./pages/dashboard.php?page=main");
                
        } else {
            header('Location:'.$_SERVER['PHP_SELF'].'?error=Incorrect username or password');
            
            exit();
        }
    }
} else {
    header("Location:index.php?");
    exit();
} 
?>