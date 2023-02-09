<?php
session_start();
include "../../db_conn.php";
if (isset($_POST['building']) && isset($_POST['room_number']) && isset($_POST['status'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $building = validate($_POST['building']);
    $room_number = validate($_POST['room_number']);
    $status = validate($_POST['status']);
    if (empty($building)) {
        header("Location: ../dashboard.php?page=add_classroom&error=Building is required");
        exit();
    } else if (empty($room_number)) {
        header("Location: ../dashboard.php?page=add_classroom&error=Room Number is required");
        exit();
    } else if (empty($status)) {
        header("Location: ../dashboard.php?page=add_classroom&error=Status is required");
        exit();
    } else {
        $building_check = "SELECT * FROM `classroom` WHERE building='$building'";
        $building_result = mysqli_query($conn, $building_check);
        $room_check = "SELECT * FROM `classroom` WHERE room_number='$room_number'";
        $room_result = mysqli_query($conn, $room_check);
        if (mysqli_num_rows($building_result) > 0 && mysqli_num_rows($room_result) > 0) {
            header("Location: ../dashboard.php?page=add_classroom&error=The classroom you are trying to add is already existing.");
            exit();
        } else {
            $sql_insert = "INSERT INTO `classroom`(`id`, `building`, `room_number`, `status`) 
                        VALUES (NULL,'$building','$room_number','$status')";
            $result_insert = mysqli_query($conn, $sql_insert);
            if ($result_insert) {
                header("Location: ../dashboard.php?page=main");
                exit();
            } else {
                header("Location: ../dashboard.php?page=add_classroom&error=Unknown error occured");
                exit();
            }
        }
    }
} else {
    header("Location: ../login.php");
    exit();
}