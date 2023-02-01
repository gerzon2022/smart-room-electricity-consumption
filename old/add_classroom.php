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
    <title>Register</title>

    <!-- BOOTSTRAP CSS -->
    <link href="src/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- NAVBAR -->
    <?php include "src/navbar.php"; ?>

    <!-- CONTAINER -->
    <div class="container d-flex justify-content-center align-items-center"
        style="min-height: 90vh;">

        <!-- FORM WRAPPER -->
        <div class="border shadow p-3 rounded">

            <!-- ADD ROOM TITLE -->
            <h1 class="text-center p-3">ADD CLASSROOM</h1>

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

            <!-- ADD ROOM FORM -->
            <form action="php/create/create_room.php"
                    method="POST">

                <!-- BUILDING -->
                <div class="mb-3">
                    <label for="building" class="form-label">Building:</label>
                    <input  type="text" 
                        class="form-control" 
                        name="building"
                        id="building">
                </div>

                <!-- ROOM NUMBER -->
                <div class="mb-3">
                    <label for="room_number" class="form-label">Room Number:</label>
                    <input  type="text" 
                            class="form-control" 
                            name="room_number"
                            id="room_number">
                </div>

                <!-- STATUS -->
                <div class="mb-3">
                    <label for="status" class="form-label">Status:</label>
                    <select class="form-select mb-3" 
                            name="status"
                            id="status">
                        <option value="available">Available</option>
                        <option value="unavailable">Unavailable</option>
                    </select>
                </div>
                
                <!-- SUBMIT -->
                <button type="submit" class="btn btn-success mb-3">Add</button>
                <a href="dashboard.php" class="btn btn-warning mb-3 float-end">Back</a>
            </form>
        </div>
        
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