<?php
session_start();
include "../db_conn.php";
if (isset($_GET['id']) && isset($_GET['status'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $user_id = validate($_GET['id']);
    $status;
    if ($_GET['status'] === 'available') {
        $status = 'unavailable';
    } else {
        $status = 'available';
    }
    if (empty($user_id)) {
        header("Location: ../../update.php?error=Unknown user");
        exit();
    } else if (empty($status)) {
        header("Location: ../../update.php?error=Status is required");
        exit();
    } else {
        $change_status = "UPDATE `classroom` SET `status`='$status'
                            WHERE id=$user_id";
        $status_result = mysqli_query($conn, $change_status);
        if ($status_result) {
            header("Location: ../../dashboard.php?success=Classroom status has been successfully updated.");
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