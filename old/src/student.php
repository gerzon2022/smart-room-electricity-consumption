<?php if ($_SESSION['user_type'] === 'student') { 
    if (isset($_SESSION['id']) && isset($_SESSION['username']) && isset($_SESSION['full_name'])) {
        $user_id = $_SESSION['id'];
        $full_name = $_SESSION['full_name'];

        $sql_current_user = "SELECT * FROM users WHERE id='$user_id'";
        $result_current_user = mysqli_query($conn, $sql_current_user);

        $sql_user = "SELECT * FROM users WHERE id != $user_id AND user_type = 'student'";
        $result_user = mysqli_query($conn, $sql_user);

        $sql_classroom = "SELECT * FROM classroom";
        $result_classroom = mysqli_query($conn, $sql_classroom);

        $sql_schedule = "SELECT * FROM schedule WHERE user='$full_name'";
        $result_schedule = mysqli_query($conn, $sql_schedule);

        $sql_all_students = "SELECT COUNT(*) FROM users WHERE user_type='student'";
        $result_all_students = mysqli_query($conn, $sql_all_students);
        $row_all_students = mysqli_fetch_array($result_all_students);
        $total_all_students = $row_all_students[0];

        $sql_all_classrooms = "SELECT COUNT(*) FROM classroom";
        $result_all_classrooms = mysqli_query($conn, $sql_all_classrooms);
        $row_all_classrooms = mysqli_fetch_array($result_all_classrooms);
        $total_all_classrooms = $row_all_classrooms[0];

        $sql_all_available = "SELECT COUNT(*) FROM classroom WHERE status='available'";
        $result_all_available = mysqli_query($conn, $sql_all_available);
        $row_all_available = mysqli_fetch_array($result_all_available);
        $total_all_available = $row_all_available[0];

        $sql_all_unavailable = "SELECT COUNT(*) FROM classroom WHERE status='unavailable'";
        $result_all_unavailable = mysqli_query($conn, $sql_all_unavailable);
        $row_all_unavailable = mysqli_fetch_array($result_all_unavailable);
        $total_all_unavailable = $row_all_unavailable[0];
    } else {
        header("Location: login.php");
    }
?>
<!-- CONTAINER -->
<div class="border shadow p-4 rounded" style="overflow-y: scroll; width: 90%; height: 80vh;">
    
    <!-- USER INFO WRAPPER -->
    <div class="row justify-content-center align-items-center">
        
        <!-- USER IMAGE -->
        <div class="col-4 p-2 m-2">
            <img src="src/img/default.png" class="card-img-top img-fluid" alt="default-img">
        </div>

        <!-- USER INFORMATION -->
        <div class="col border rounded-4 m-2">
            <?php if (mysqli_num_rows($result_current_user) > 0) {
                while ($row = mysqli_fetch_assoc($result_current_user)) { ?>
            <div class="row p-2">
                <div class="col-6">
                    <h2><?=$row['full_name']?></h2>
                    <h6>Student Allowance: <?=$row['allowance']-1?></h6>
                    <a class="btn btn-outline-success float-right" href="update.php?id=<?php echo $_SESSION['id']; ?>">Update Account</a>
                </div>
                <div class="col-3">
                    Email: <h5><?=$row['email']?></h5>
                    Contact Number: <h5><?=$row['contact_number']?></h5>
                </div>
            </div>
            <?php }} ?>
            <div class="row p-2">
                <table class="table table-sm table-hover table-bordered">
                    <thead>
                        <tr class="bg-dark text-white">
                            <th scope="col">Students Registered</th>
                            <th scope="col">Classroom/s</th>
                            <th scope="col">Available Classroom/s</th>
                            <th scope="col">Unavailable Classroom/s</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $total_all_students; ?></td>
                            <td><?php echo $total_all_classrooms; ?></td>
                            <td><?php echo $total_all_available; ?></td>
                            <td><?php echo $total_all_unavailable; ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="p-3">
            
            <!-- ALERT MESSAGES -->
            <?php if (isset($_GET['msg'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_GET['msg']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <?php if (isset($_GET['success'])) { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <?php echo $_GET['success']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            <?php if (isset($_GET['error'])) { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <?php echo $_GET['error']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            <?php } ?>
            
            <!-- TABS LINK -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="schedule-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#schedule" 
                            type="button" role="tab" 
                            aria-controls="schedule" 
                            aria-selected="false">
                            <h1 style="font-size: 3vw;">Schedule</h1>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="classroom-tab" 
                            data-bs-toggle="tab" 
                            data-bs-target="#classroom" 
                            type="button" role="tab" 
                            aria-controls="classroom" 
                            aria-selected="false">
                            <h1 style="font-size: 3vw;">Classrooms</h1>
                    </button>
                </li>
            </ul>
            
            <!-- TAB CONTENT -->
            <div class="tab-content" id="myTabContent">

                <!-- SCHEDULES TAB -->
                <?php include "schedules.php"; ?>

                <!-- CLASSROOMS TAB -->
                <?php include "classrooms.php" ;?>
            </div>
        </div>
    </div>
</div>
    
<?php } ?>