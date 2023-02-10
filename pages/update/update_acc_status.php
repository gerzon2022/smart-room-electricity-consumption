<?php
session_start();
include "../../db_conn.php";
if (isset($_GET['id_number']) && isset($_GET['acc_status'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $user_id = validate($_GET['id_number']);
    $acc_status = validate($_GET['acc_status']);
    if (empty($user_id)) {
        header("Location:../dashboard.php?page=main&error=Unknown user");
        exit();
    } else if (empty($acc_status)) {
        header("Location:../dashboard.php?page=main&error=Allowance is required");
        exit();
    } else {
        $update_acc_status = "UPDATE `tbl_user_info` SET `acc_status`='$acc_status'
                            WHERE id_number='$user_id'";
        $update_result = mysqli_query($conn, $update_acc_status);
        if ($update_result) {
            header("Location:../dashboard.php?page=main&success=account status has been updated.");
            exit();
        } else {
            header("Location:../dashboard.php?page=main&error=Unknown error occured");
            exit();
        }
    }

} else {
    header("Location:../dashboard.php?page=main&error=Account update failed.");
    exit();
}