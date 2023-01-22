<?php
session_start();
include "php/db_conn.php";
if (isset($_GET['id'])) {
    $sched_id = $_GET['id'];
    $sql_sched = "SELECT * FROM `schedule` WHERE `id`='$sched_id'";
    $result_sched = mysqli_query($conn, $sql_sched);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Schedule</title>

    <!-- BOOTSTRAP CSS -->
    <link href="src/css/bootstrap.min.css" rel="stylesheet">
</head>
<body onload="checkOnLoad()">
    
    <!-- NAVBAR -->
    <?php include "src/navbar.php"; ?>

    <!-- CONTAINER -->
    <div class="container d-flex justify-content-center align-items-center"
        style="min-height: 90vh;">

    <!-- FORM WRAPPER -->
        <div class="border shadow p-3 rounded">

            <!-- UPDATE TITLE -->
            <h1 class="text-center p-3">UPDATE SCHEDULE</h1>
            
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
            
            <?php  
                if (mysqli_num_rows($result_sched) === 1) { 
                    while ($row = mysqli_fetch_assoc($result_sched)) {
            ?>

            <!-- UPDATE FORM -->
            <form action="php/update/update_schedule.php"
                    method="POST">

                <input  type="text" hidden
                            name="id"
                            value="<?php echo $row['id']; ?>"
                            id="id">
                            
                <!-- FULL NAME -->
                <div class="mb-3">
                    <label for="full_name" class="form-label">User Full Name:</label>
                    <input  type="text" 
                        class="form-control" 
                        name="full_name"
                        id="full_name"
                        value="<?php echo $row['user']; ?>">
                </div>

                <!-- COURSE -->
                <div class="mb-3">
                    <label for="course" class="form-label">Course:</label>
                    <input  type="text" 
                        class="form-control" 
                        name="course"
                        id="course"
                        value="<?php echo $row['course']; ?>">
                </div>

                <!-- LOCATION -->
                <?php
                    $sql_available = "SELECT * FROM classroom WHERE status='available'";
                    $result_available = mysqli_query($conn, $sql_available);
                ?>
                <div class="mb-3">
                    <label for="location" class="form-label">Location:</label>
                    
                    <select class="form-select mb-3" onchange="myFunction()"
                        name="location"
                        id="location">
                        <?php if (mysqli_num_rows($result_available) > 0) { 
                            while ($row_loc = mysqli_fetch_assoc($result_available)) { ?>
                            <option value="<?= $row_loc['id']; ?>"
                                <?php 
                                    if ($row['building'] == $row_loc['building'] && 
                                        $row['room_number'] == $row_loc['room_number']) { 
                                        echo "selected"; 
                                    } 
                                ?>>
                                Bldg- <?= $row_loc['building']; ?> |
                                Room- <?= $row_loc['room_number']; ?>
                            </option>
                        <?php } ?>
                    <?php } else { ?>
                        <option>No classroom available</option>
                    <?php } ?>
                    </select>
                </div>

                <!-- START TIME -->
                <div class="mb-3">
                    <label for="start_time" class="form-label">Start Date & Time:</label>
                    <input  type="datetime-local" 
                            onchange="checkDate()"
                            class="form-control" 
                            name="start_time"
                            value="<?php echo $row['start_time']; ?>"
                            id="start_time">
                </div>

                <!-- END TIME -->
                <div class="mb-3">
                    <label for="end_time" class="form-label">End Date & Time:</label>
                    <input  type="datetime-local" 
                            onchange="checkDate()"
                            class="form-control" 
                            name="end_time"
                            value="<?php echo $row['end_time']; ?>"
                            id="end_time">
                </div>
                
                <!-- SUBMIT -->
                <button type="submit" class="btn btn-success mb-3">Update</button>
                <a href="dashboard.php" class="btn btn-warning mb-3 float-end">Back</a>
            </form>
        </div>
        <?php } ?>
    <?php } ?>
    </div>

    <script>
        function checkDate() {
            var dateString = document.getElementById('start_time').value;
            var dateString2 = document.getElementById('end_time').value;
            var DateStart = new Date(dateString);
            var DateEnd = new Date(dateString2);
            if (DateEnd < DateStart) {
                alert("End date cannot be less than Start date.");
                document.getElementById('end_time').value = 'dd/mm/yyyy --:-- --';
                return false;
            }
            return true;
        }
        function checkOnLoad() {
            var dateString = document.getElementById('start_time').value;
            var DateStart = new Date(dateString);
            var currDate = new Date();
            if (DateStart < currDate) {
                document.getElementById("start_time").readOnly = true;
                document.getElementById("end_time").readOnly = true;
            }
            return true;
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