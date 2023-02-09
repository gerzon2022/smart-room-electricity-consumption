<!-- CLASSROOMS TAB -->
<div class="tab-pane fade" id="classroom" role="tabpanel" aria-labelledby="classroom-tab">
    <?php if ($_SESSION['acc_type'] !== 'student') { ?>
    <!-- CLASSROOMS -->
    <div class="row p-2">
        <div class="col">
            <a href="dashboard.php?page=add_classroom" class="btn btn-info float-end">Add Classroom</a>
        </div>
    </div>
    <?php } ?>

    <!-- CLASSROOMS TABLE -->
    <table class="table table-sm table-hover table-bordered">

        <!-- CLASSROOMS TABLE HEAD -->
        <thead>
            <tr class="bg-dark text-white">
                <th scope="col">Building</th>
                <th scope="col">Device Number</th>
                <th scope="col">Status</th>
                <?php if ($_SESSION['acc_type'] !== 'student') { ?>
                <th scope="col">Action</th>
                <?php } ?>
            </tr>
        </thead>

        <!-- CLASSROOMS TABLE BODY -->
        <tbody>
            <?php 
                if (mysqli_num_rows($result_classroom) > 0) {
                    while ($row = mysqli_fetch_assoc($result_classroom)) { 
            ?>
            <tr>
                <th><?=$row['building']; ?></th>
                <td><?=$row['room_number']; ?></td>
                <td><?=$row['status']; ?></td>
                
                <?php if ($_SESSION['acc_type'] !== 'student') { ?>
                <td>
                    <?php if ($row['status'] === 'available') { ?>
                        <a class="btn btn-warning btn-sm mb-lg-0 mb-md-1" 
                            href="update/update_classroom_status.php?id=<?php echo $row['id']; ?>&status=<?php echo $row['status']; ?>">Off</a>
                    <?php } else { ?>
                        <a class="btn btn-success btn-sm mb-lg-0 mb-md-1" 
                            href="update/update_classroom_status.php?id=<?php echo $row['id']; ?>&status=<?php echo $row['status']; ?>">On</a>
                    <?php } ?>
                    <?php 
                        echo "<a class='btn btn-danger btn-sm mb-lg-0 mb-md-1' onClick=\"javascript: 
                                return confirm('Click OK to delete Classroom in ".$row['building']." room: ".$row['room_number'].".');\" 
                                href='delete/delete_classroom.php?id=".$row['id']."'>Delete</a>"; ?>
                    </td>
                
                <?php } ?>
            </tr>
            <?php } ?>
        <?php } ?>
        </tbody>
    </table>
</div>