<?php
session_start();
include "php/db_conn.php";
if (isset($_SESSION['username']) && isset($_SESSION['id'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- BOOTSTRAP CSS -->
    <link href="src/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include "src/navbar.php"; ?>

    <!-- CONTENT WRAPPER -->
    <div class="container d-flex justify-content-center align-items-center"
        style="min-height: 90vh;">

        <!-- ADMIN -->
        <?php include "src/admin.php"; ?>

        <!-- FACULTY -->
        <?php include "src/faculty.php"; ?>

        <!-- STUDENT -->
        <?php include "src/student.php"; ?>
    </div>

    <!-- BOOTSTRAP JS -->
    <script src="src/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
} else {
    header("Location: login.php");
}
?>