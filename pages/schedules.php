<!-- SCHEDULES TAB -->
<div class="tab-pane fade <?php if ($_SESSION['user_type'] === 'student') { echo 'show active'; } ?>" id="schedule" role="tabpanel" aria-labelledby="schedule-tab">
    
    <!-- ADD SCHEDULE BUTTON -->
    <div class="row p-2">
        <div class="col">
            <a href="dashboard.php?page=add_schedule
            <?php 
             if ($_SESSION['acc_type'] === 'student') { 
                 $full_name = $_SESSION['first_name'];
                 echo "?user=$full_name"; 
             } ?>" 
            class="btn btn-info float-end">Add Schedule</a>
        </div>
    </div>

    <!-- SCHEDULES TABLE -->
    <table class="table table-sm table-hover table-bordered">

        <!-- SCHEDULE TABLE HEAD -->
        <thead>
            <tr class="bg-dark text-white">
               
                <th scope="col">Location</th>
                <th scope="col">Start Time</th>
                <th scope="col">End Time</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <!-- SHCEDULES TABLE BODY -->
        <tbody>
            <?php 
                if (mysqli_num_rows($result_schedule) > 0) {
                    while ($row = mysqli_fetch_assoc($result_schedule)) { 
            ?>
            <tr>
                
                <td>
                    <div class="col"><b>Building:</b> <?=$row['building']; ?></div>
                    <div class="col"><b>Room:</b> <?=$row['room_number']; ?></div>
                </td>
                <td><?=$row['start_time']; ?></td>
                <td><?=$row['end_time']; ?></td>
                <td>
                    
                    <?php echo "<a class='btn btn-danger btn-sm' onClick=\"javascript: 
                        return confirm('Click OK to delete Schedule of user ".
                        " start time: ".$row['start_time']." end time: ".
                        $row['end_time'].".');\" href='delete/delete_sched.php?id=".$row['id']
                        ."'>Delete</a>"; ?>
                </td>
            </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>