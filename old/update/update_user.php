<?php
session_start();
include "../db_conn.php";
if (isset($_POST['id']) && isset($_POST['username']) && isset($_POST['user_type']) && isset($_POST['full_name']) && isset($_POST['current_password']) &&
    isset($_POST['contact_number']) && isset($_POST['email']) && isset($_POST['course']) && isset($_POST['allowance'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $user_id = validate($_POST['id']);
    $username = validate($_POST['username']);
    $current_password = validate($_POST['current_password']);
    $user_type = validate($_POST['user_type']);
    $full_name = validate($_POST['full_name']);
    $contact_number = validate($_POST['contact_number']);
    $email = validate($_POST['email']);
    $course = validate($_POST['course']);
    $allowance = validate($_POST['allowance']);

    if (!empty(validate($_POST['new_password'])) && !empty(validate($_POST['confirm_password']))) {
        if (empty($user_id)) {
            header("Location: ../../update.php?error=Unknown user");
            exit();
        } else if (empty($username)) {
            header("Location: ../../update.php?error=Username is required");
            exit();
        } else if (empty($user_type)) {
            header("Location: ../../update.php?error=User type is required");
            exit();
        } else if (empty($current_password)) {
            header("Location: ../../update.php?error=Password is required");
            exit();
        } else if (empty($full_name)) {
            header("Location: ../../update.php?error=Full name is required");
            exit();
        } else if (empty($contact_number)) {
            header("Location: ../../update.php?error=Contact number is required");
            exit();
        } else if (empty($email)) {
            header("Location: ../../update.php?error=Email is required");
            exit();
        } else if (empty($course)) {
            header("Location: ../../update.php?error=Course is required");
            exit();
        } else if (empty($allowance)) {
            header("Location: ../../update.php?error=Allowance is required");
            exit();
        } else {
            $new_password = validate($_POST['new_password']);
            $confirm_password = validate($_POST['confirm_password']);
            if (empty($new_password)) {
                header("Location: ../../update.php?error=New password is required");
                exit();
            } else if (empty($confirm_password)) {
                header("Location: ../../update.php?error=Old password is required");
                exit();
            } else if ($new_password !== $confirm_password) {
                header("Location: ../../dashboard.php?error=Confirm password does not match");
                exit();
            } else {
                $current_password = md5($current_password);
                $new_password = md5($new_password);
                if ($_SESSION['password'] === $current_password) {
                    $user_newpass = "UPDATE `users` SET `username`='$username', `password`='$new_password', `user_type`='$user_type',
                                `full_name`='$full_name', `contact_number`='$contact_number', `email`='$email', 
                                `course`='$course', `allowance`='$allowance' WHERE id=$user_id";
                    $user_newpass_result = mysqli_query($conn, $user_newpass);
                    if ($user_newpass_result) {
                        header("Location: ../../dashboard.php?success=User has been updated successfully");
                        exit();
                    } else {
                        header("Location: ../../update.php?error=Unknown error occured");
                        exit();
                    }
                } else {
                    header("Location: ../../dashboard.php?error=Incorrect password");
                    exit();
                }
            }
        }
    } else {
        if (empty($user_id)) {
            header("Location: ../../update.php?error=Unknown user");
            exit();
        } else if (empty($username)) {
            header("Location: ../../update.php?error=Username is required");
            exit();
        } else if (empty($user_type)) {
            header("Location: ../../update.php?error=User type is required");
            exit();
        } else if (empty($current_password)) {
            header("Location: ../../update.php?error=Password is required");
            exit();
        } else if (empty($full_name)) {
            header("Location: ../../update.php?error=Full name is required");
            exit();
        } else if (empty($contact_number)) {
            header("Location: ../../update.php?error=Contact number is required");
            exit();
        } else if (empty($email)) {
            header("Location: ../../update.php?error=Email is required");
            exit();
        } else if (empty($course)) {
            header("Location: ../../update.php?error=Course is required");
            exit();
        } else if (empty($allowance)) {
            header("Location: ../../update.php?error=Allowance is required");
            exit();
        } else {
            $current_password = md5($current_password);
            if ($_SESSION['password'] === $current_password) {
                $user_newpass = "UPDATE `users` SET `username`='$username', `user_type`='$user_type',
                            `full_name`='$full_name', `contact_number`='$contact_number', `email`='$email', 
                            `course`='$course', `allowance`='$allowance' WHERE id=$user_id";
                $user_newpass_result = mysqli_query($conn, $user_newpass);
                if ($user_newpass_result) {
                    header("Location: ../../dashboard.php?success=User has been updated successfully");
                    exit();
                } else {
                    header("Location: ../../update.php?error=Unknown error occured");
                    exit();
                }
            } else {
                header("Location: ../../dashboard.php?error=Incorrect password");
                exit();
            }
        }
    }
    
} else {
    header("Location: ../../dashboard.php?error=Account update failed.");
    exit();
}