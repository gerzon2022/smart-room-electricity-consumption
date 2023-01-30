<?php
include "../db_conn.php";
$id = $_GET['id'];
$sql = "DELETE FROM `users` WHERE id = $id";
$result = mysqli_query($conn, $sql);
if ($result) {
    header("Location: ../../dashboard.php?msg=User successfully deleted.");
} else {
    echo "Failed: " . mysqli_error($conn);
}
?>