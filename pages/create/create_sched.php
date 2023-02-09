<?php
session_start();
include "../../db_conn.php";
if ( isset($_POST['location']) && 
    isset($_POST['start_time']) && isset($_POST['end_time'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
   
    $location = validate($_POST['location']);
    $start_time = validate($_POST['start_time']);
    $end_time = validate($_POST['end_time']);
    if (empty($location)) {
        header("Location: ../dashboard.php?page=add_schedule&error=Building is required");
        exit();
    } else if (empty($start_time)) {
        header("Location: ../dashboard.php?page=add_schedule&error=Start Time is required");
        exit();
    } else if (empty($end_time)) {
        header("Location: ../dashboard.php?page=add_schedule&error=End Time is required");
        exit();
    } else {
        $sql_room = "SELECT * FROM `classroom` WHERE id='$location'";
        $sql_room_result = mysqli_query($conn, $sql_room);
        if (mysqli_num_rows($sql_room_result) === 1) {
            while ($row_room = mysqli_fetch_assoc($sql_room_result)) {
                $date1 = new DateTime($start_time);
                $date2 = new DateTime($end_time);
                $diff = $date1->diff($date2);
                // $hours = $diff->h;
                // $hours = $hours + ($diff->days*24);
                $building = $row_room['building'];
                $room_number = $row_room['room_number'];
                $sql_insert = "INSERT INTO `schedule` (`id`, `building`, `room_number`, `start_time`, `end_time`) 
                    VALUES (NULL,'$building','$room_number','$start_time','$end_time')";
                $result_insert = mysqli_query($conn, $sql_insert);
                if ($result_insert) {
                    header("Location: ../dashboard.php?page=main&success=Schedule has been created successfully");
                    exit();
                } else {
                    header("Location: ../dashboard.php?page=add_schedule&error=Unknown error occured");
                    exit();
                }
                
            }
        } else {
            header("Location: ../dashboard.php?page=add_schedule&error=Location not found.");
            exit();
        }
}
   
} else {
    header("Location: ../../");
    exit();
}