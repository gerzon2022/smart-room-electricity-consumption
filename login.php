<?php
session_start();
include "php/db_conn.php";
if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- BOOTSTRAP CSS -->
    <link href="src/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- NAVBAR -->
    <?php include "src/navbar.php";?>
    
    <!-- CONTAINER -->
    <div class="container d-flex justify-content-center align-items-center"
        style="min-height: 90vh;">
        
        <!-- FORM WRAPPER -->
        <div class="border shadow p-3 rounded">
            <!-- LOGIN TITLE -->
            <h4 class="text-center pt-2">Welcome to</h4>
            <h1 class="text-center mb-3">Classroom Manager</h1>
            
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

            <!-- LOGIN FORM -->
            <form action="php/login-check.php"
                method="POST">
                
                <!-- USERNAME -->
                <div class="mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input  type="text" 
                            class="form-control" 
                            name="username"
                            id="username">
                </div>

                <!-- PASSWORD -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input  type="password" 
                            class="form-control" 
                            name="password"
                            id="password">
                </div>

                <!-- USER TYPE -->
                <div class="mb-3">
                    <label for="user_type" class="form-label">User Type:</label>
                    <select class="form-select mb-3" 
                            name="user_type"
                            id="user_type">
                        <option value="student">Student</option>
                        <option value="faculty">Faculty</option>
                        <option value="admin">Administrator</option>
                    </select>
                </div>
                <!-- SUBMIT -->
                <button type="submit" class="btn btn-primary">Login</button>
            </form>
        </div>
        
    </div>

    <!-- BOOTSTRAP JS -->
    <script src="src/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php
} else {
    header("Location: dashboard.php");
}
?>