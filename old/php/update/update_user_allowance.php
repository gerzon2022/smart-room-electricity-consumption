<?php
session_start();
include "../db_conn.php";
if (isset($_GET['id']) && isset($_GET['allowance'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $user_id = validate($_GET['id']);
    $allowance = validate($_GET['allowance']);
    if (empty($user_id)) {
        header("Location: ../../update.php?error=Unknown user");
        exit();
    } else if (empty($allowance)) {
        header("Location: ../../update.php?error=Allowance is required");
        exit();
    } else {
        $add_allowance = "UPDATE `users` SET `allowance`='$allowance'
                            WHERE id=$user_id";
        $user_result = mysqli_query($conn, $add_allowance);
        if ($user_result) {
            header("Location: ../../dashboard.php?success=Student allowance has been successfully added.");
            exit();
        } else {
            header("Location: ../../update.php?error=Unknown error occured");
            exit();
        }
    }

} else {
    header("Location: ../../dashboard.php?error=Account update failed.");
    exit();
}