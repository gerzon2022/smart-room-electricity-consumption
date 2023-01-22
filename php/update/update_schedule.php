<?php
session_start();
include "../db_conn.php";
if (isset($_POST['id']) && isset($_POST['full_name']) && isset($_POST['course']) &&  
    isset($_POST['location']) && isset($_POST['start_time']) && isset($_POST['end_time'])) {
    function validate($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
    $sched_id = validate($_POST['id']);
    $full_name = validate($_POST['full_name']);
    $course = validate($_POST['course']);
    $location = validate($_POST['location']);
    $start_time = validate($_POST['start_time']);
    $end_time = validate($_POST['end_time']);
    if (empty($sched_id)) {
        header("Location: ../../resched.php?error=Unknown user");
        exit();
    } else if (empty($full_name)) {
        header("Location: ../../resched.php?error=User is required");
        exit();
    } else if (empty($course)) {
        header("Location: ../../resched.php?error=Course is required");
        exit();
    } else if (empty($location)) {
        header("Location: ../../resched.php?error=Location is required");
        exit();
    } else if (empty($start_time)) {
        header("Location: ../../resched.php?error=Start Time is required");
        exit();
    } else if (empty($end_time)) {
        header("Location: ../../resched.php?error=End Time is required");
        exit();
    } else {
        $user_check = "SELECT * FROM `users` WHERE `full_name`='$full_name' AND `user_type`='student'";
        $user_result = mysqli_query($conn, $user_check);
        if (mysqli_num_rows($user_result) === 1) {
            while ($row_user = mysqli_fetch_assoc($user_result)) {
                if ($row_user['course'] === $course) {
                    $sql_room = "SELECT * FROM `classroom` WHERE id='$location'";
                    $sql_room_result = mysqli_query($conn, $sql_room);
                    if (mysqli_num_rows($sql_room_result) === 1) {
                        while ($row_room = mysqli_fetch_assoc($sql_room_result)) {
                            // echo $row_room['building'] . " / " . $row_room['room_number'];
                            $building = $row_room['building'];
                            $room_number = $row_room['room_number'];
                            $sql_update = "UPDATE schedule SET user='$full_name', course='$course', building='$building',
                                        room_number='$room_number',start_time='$start_time',
                                        end_time='$end_time' WHERE id=$sched_id";
                            $result_update = mysqli_query($conn, $sql_update);
                            if ($result_update) {
                                header("Location: ../../dashboard.php?success=Schedule has been updated successfully");
                                exit();
                            } else {
                                header("Location: ../../dashboard.php?error=Unknown error occured");
                                exit();
                            }
                        }
                    } else {
                        header("Location: ../../resched.php?error=Location not found.");
                        exit();
                    }
                } else {
                    header("Location: ../../dashboard.php?error=Update failed.");
                    exit();
                }
            }
        } else {
            header("Location: ../../resched.php?error=This user is not a student.");
            exit();
        }
    }
} else {
    header("Location: ../../login.php");
    exit();
}