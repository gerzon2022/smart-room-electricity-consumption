<?php if ($_SESSION['acc_type'] === 'student') { 
    if ( isset($_SESSION['id_number'])) {
        $full_name = $_SESSION['first_name'];
        $user_id = $_SESSION['id_number'];
        $sql_current_user = "SELECT * FROM tbl_user_info WHERE id_number='$user_id'";
        $result_current_user = mysqli_query($conn, $sql_current_user);

        $sql_user = "SELECT * FROM tbl_user_info WHERE id_number != $user_id AND acc_type = 'student'";
        $result_user = mysqli_query($conn, $sql_user);

        $sql_classroom = "SELECT * FROM classroom";
        $result_classroom = mysqli_query($conn, $sql_classroom);

        $sql_schedule = "SELECT * FROM schedule WHERE first_name='$full_name'";
        $result_schedule = mysqli_query($conn, $sql_schedule);

        $sql_all_students = "SELECT COUNT(*) FROM tbl_user_info WHERE acc_type='student'";
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
    } 
    else {
        header("Location: login.php");
    }
?>
<!-- CONTAINER -->
<div class="border shadow p-4 rounded" style="overflow-y: scroll; width: 90%; height: 80vh;">
    
    <!-- USER INFO WRAPPER -->
    <div class="row justify-content-center align-items-center">
        
        <!-- USER IMAGE -->
        <div class="col-4 p-2 m-2">
            <img src="../images/default.png" class="card-img-top img-fluid" alt="default-img">
        </div>

        <!-- USER INFORMATION -->
        <div class="col border rounded-4 m-2">
            <?php if (mysqli_num_rows($result_current_user) > 0) {
                while ($row = mysqli_fetch_assoc($result_current_user)) { ?>
            <div class="row p-2">
                <div class="col-6">
                    <h2><?=$row['first_name'] . " " .$row['family_name'] ?></h2>
                    <h6>Power Allowance: <?=$row['p_consumable']-1?></h6>
                    <a class="btn btn-outline-success float-right" href="update.php?id=<?php echo $_SESSION['id']; ?>">Update Account</a>
                </div>
            <?php
                while (true) {
                    $sql = "SELECT * FROM tbl_user_info";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {
                      while ($row = mysqli_fetch_assoc($result)) {
                        print_r($row['p_consumed']);
                      }
                    } else {
                      echo "No data found";
                    }
                
                    sleep(10);
                  }
            
            ?>
                
                <div class="col-3">
                    Power Consumed: <h5><?=$row['first_name']?></h5>
                 
                </div>
            </div>
            <?php }} ?>
      
        </div>
    </div>
    
    
<?php } ?>