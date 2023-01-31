<?php
session_start();
include "php/db_conn.php";
if (isset($_SESSION['username']) && isset($_SESSION['id']) && ($_SESSION['user_type'] === 'admin' || $_SESSION['user_type'] === 'faculty')) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register User</title>

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

            <!-- REGISTRATION TITLE -->
            <h1 class="text-center p-3">USER REGISTRATION</h1>

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
            
            <!-- REGISTER FORM -->
            <form action="php/create/create_user.php"
                    method="POST">

                <!-- USERNAME -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input  type="text" 
                        class="form-control" 
                        name="username"
                        id="username">
                </div>
                <div class="row mb-3">
                    <div class="col">

                        <!-- PASSWORD -->
                        <label for="password" class="form-label">Password:</label>
                        <input  type="password" 
                                class="form-control" 
                                name="password"
                                id="password">
                    </div>
                    <div class="col">

                        <!-- REPEAT PASSWORD -->
                        <label for="repeat_password" class="form-label">Repeat Password:</label>
                        <input  type="password" 
                                class="form-control" 
                                name="repeat_password"
                                id="repeat_password">
                    </div>
                </div>

                <!-- USER TYPE -->
                <div class="mb-3">
                    <label for="user_type" class="form-label">User Type:</label>
                    <select class="form-select mb-3"
                            onchange="setReadOnlyIfNotAStudent()"
                            name="user_type"
                            id="user_type">
                        <?php if ($_SESSION['user_type'] === 'admin') { ?>
                            <option value="student">Student</option>
                            <option value="faculty">Faculty</option>
                            <option value="admin">Administrator</option>
                        <?php } else if ($_SESSION['user_type'] === 'faculty') { ?>
                            <option value="faculty">Faculty</option>
                            <option value="student">Student</option>
                        <?php } ?>
                    </select>
                </div>

                <!-- FULL NAME -->
                <div class="mb-3">
                    <label for="full_name" class="form-label">Full Name:</label>
                    <input  type="text" 
                            class="form-control" 
                            name="full_name"
                            id="full_name">
                </div>

                <!-- CONTACT NUMBER -->
                <div class="mb-3">
                    <label for="contact_number" class="form-label">Contact Number:</label>
                    <input  type="text" 
                            class="form-control" 
                            name="contact_number"
                            id="contact_number">
                </div>

                <!-- EMAIL -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input  type="email" 
                            class="form-control" 
                            name="email"
                            id="email">
                </div>
                <div class="row mb-3">
                    <div class="col">

                        <!-- COURSE -->
                        <label for="course" class="form-label">Course:</label>
                        <input  type="text" 
                                class="form-control" 
                                name="course"
                                id="course">
                    </div>
                    <div class="col">

                        <!-- ALLOWANCE -->
                        <label for="allowance" class="form-label">Allowance:</label>
                        <input  type="text" 
                                class="form-control" 
                                name="allowance"
                                id="allowance">
                    </div>
                </div>
                
                <!-- SUBMIT -->
                <button type="submit" class="btn btn-success mb-3">Register</button>
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
            document.getElementById('allowance').value = 20;
            document.getElementById("allowance").readOnly = false;
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