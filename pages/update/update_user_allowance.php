<?php
session_start();
include "../../db_conn.php";
if (isset($_GET['id_number']) && isset($_GET['p_consumable'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $user_id = validate($_GET['id_number']);
    $allowance = validate($_GET['p_consumable']);
    if (empty($user_id)) {
        header("Location:../dashboard.php?page=main&error=Unknown user");
        exit();
    } else if (empty($allowance)) {
        header("Location:../dashboard.php?page=main&error=Allowance is required");
        exit();
    } else {
        $add_allowance = "UPDATE `tbl_user_info` SET `p_consumable`=$allowance
                            WHERE id_number='$user_id'";
        $user_result = mysqli_query($conn, $add_allowance);
        if ($user_result) {
            header("Location:../dashboard.php?page=main&success=Student allowance has been successfully added.");
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