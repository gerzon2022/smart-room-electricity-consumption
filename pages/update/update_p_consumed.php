<?php
session_start();
include "../../db_conn.php";
if (isset($_GET['id_number']) && isset($_GET['p_consumed'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $user_id = validate($_GET['id_number']);
    $p_consumed = validate($_GET['p_consumed']);
    if (empty($user_id)) {
        header("Location:../dashboard.php?page=main&error=Unknown user");
        exit();
    }else {
        $p_consumed = "UPDATE `tbl_user_info` SET `p_consumed`=0
                            WHERE id_number='$user_id'";
        $update_result = mysqli_query($conn, $p_consumed);
        if ($update_result) {
            header("Location:../dashboard.php?page=main&success=account status has been renewed.");
            exit();
        } else {
            header("Location:../dashboard.php?page=main&error=Unknown error occured");
            exit();
        }
    }

} else {
    header("Location:../dashboard.php?page=main&error=Account renewed failed.");
    exit();
}