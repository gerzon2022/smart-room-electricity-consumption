<?php
session_start();
include "php/db_conn.php";
if (isset($_GET['id'])) {
    $update_id = $_GET['id'];
    $sql = "SELECT * FROM `users` WHERE id = '$update_id'"; 
    $result = mysqli_query($conn, $sql);
    $update_row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Account</title>

    <!-- BOOTSTRAP CSS -->
    <link href="src/css/bootstrap.min.css" rel="stylesheet">
</head>
<body onload="setReadOnlyIfNotAStudent()">

    <!-- NAVBAR -->
    <?php include "src/navbar.php"; ?>

    <!-- CONTAINER -->
    <div class="container d-flex justify-content-center align-items-center"
        style="min-height: 90vh;">

        <!-- FORM WRAPPER -->
        <div class="border shadow p-3 rounded">
            
            <!-- UPDATE TITLE -->
            <h1 class="text-center p-3">UPDATE USER INFORMATION</h1>

            <!-- ALERT -->
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $_GET['error']; ?>
                </div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $_GET['success']; ?>
                </div>
            <?php } ?>

            <!-- UPDATE FORM -->
            <form action="php/update/update_user.php"
                    method="POST">

                <!-- ID -->
                <input  type="text" hidden
                        name="id" id="id"
                        value="<?php echo $update_row['id']; ?>">
                <div class="mb-3">

                    <!-- USERNAME -->
                    <label for="username" class="form-label">Username:</label>
                    <input  type="text" 
                        class="form-control" 
                        name="username"
                        id="username"
                        value="<?php echo $update_row['username']; ?>">
                </div>

                <div class="row mb-3">
                    <div class="col">

                        <!-- NEW PASSWORD -->
                        <label for="new_password" class="form-label">New Password:</label>
                        <input  type="password" 
                                class="form-control" 
                                name="new_password"
                                id="new_password">
                    </div>
                    <div class="col">

                        <!-- REPEAT NEW PASSWORD -->
                        <label for="confirm_password" class="form-label">Confirm Password:</label>
                        <input  type="password" 
                                class="form-control" 
                                name="confirm_password"
                                id="confirm_password">
                    </div>
                </div>
                <div class="mb-3">
                    
                    <!-- USER TYPE -->
                    <label for="user_type" class="form-label">User Type:</label>
                    <select class="form-select mb-3" 
                            onchange="setReadOnlyIfNotAStudent()"
                            name="user_type"
                            id="user_type">
                        <option value="student" <?php if ($update_row['user_type'] === 'student') { echo 'selected'; } ?>>Student</option>
                        <option value="faculty" <?php if ($update_row['user_type'] === 'faculty') { echo 'selected'; } ?>>Faculty</option>
                        <option value="admin" <?php if ($update_row['user_type'] === 'admin') { echo 'selected'; } ?>>Administrator</option>
                    </select>
                </div>
                <div class="mb-3">
                    
                    <!-- FULL NAME -->
                    <label for="full_name" class="form-label">Full Name:</label>
                    <input  type="text" 
                            class="form-control" 
                            name="full_name"
                            id="full_name"
                            value="<?php echo $update_row['full_name']; ?>">
                </div>

                <div class="mb-3">
                    
                    <!-- CONTACT NUMBER -->
                    <label for="contact_number" class="form-label">Contact Number:</label>
                    <input  type="text" 
                            class="form-control" 
                            name="contact_number"
                            id="contact_number"
                            value="<?php echo $update_row['contact_number']; ?>">
                </div>
                <div class="mb-3">

                    <!-- EMAIL -->
                    <label for="email" class="form-label">Email:</label>
                    <input  type="email" 
                            class="form-control" 
                            name="email"
                            id="email"
                            value="<?php echo $update_row['email']; ?>">
                </div>
                <div class="mb-3">

                    <!-- CURRENT PASSWORD -->
                    <label for="current_password" class="form-label">Current Password:</label>
                    <input  type="password" 
                            class="form-control" 
                            name="current_password"
                            id="current_password">
                </div>

                <div class="row mb-3">
                    <div class="col">

                        <!-- COURSE -->
                        <label for="course" class="form-label">Course:</label>
                        <input  type="text" 
                                class="form-control" 
                                name="course"
                                id="course"
                                value="<?php echo $update_row['course']; ?>">
                    </div>
                    <div class="col">

                        <!-- ALLOWANCE -->
                        <label for="allowance" class="form-label">Allowance:</label>
                        <input  type="text" 
                                class="form-control" 
                                name="allowance"
                                id="allowance"
                                value="<?php 
                                // if ($update_row['user_type'] === 'student') {
                                //     echo $update_row['allowance']-1;
                                // }else {
                                    echo $update_row['allowance'];
                                // }
                                ?>">
                    </div>
                </div>

                <!-- SUBMIT -->
                <button type="submit" class="btn btn-success mb-3">Update</button>
                <a href="dashboard.php" class="btn btn-warning mb-3 float-end">Back</a>
            </form>
        </div>
    </div>

    <script>
    function setReadOnlyIfNotAStudent() {
        $usertype = document.getElementById('user_type').value;
        if ($usertype === 'student') {
            document.getElementById('course').value = '';
            document.getElementById("course").readOnly = false;
            document.getElementById("allowance").readOnly = true;
        } else if ($usertype === 'faculty') {
            document.getElementById('course').value = 'Faculty';
            document.getElementById("course").readOnly = true;
            document.getElementById('allowance').value = 1;
            document.getElementById("allowance").readOnly = true;
        } else if ($usertype === 'admin') {
            document.getElementById('course').value = 'Administrator';
            document.getElementById("course").readOnly = true;
            document.getElementById('allowance').value = 1;
            document.getElementById("allowance").readOnly = true;
        }
    }
    </script>

    <!-- BOOTSTRAP JS -->
    <script src="src/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
} else {
    header("Location: login.php");
}
?>