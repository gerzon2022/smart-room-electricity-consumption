<!-- USERS TAB -->
<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

    <!-- REGISTER USER BUTTON -->
    <div class="row p-2">
        <div class="col">
            <a href="register.php" class="btn btn-info float-end">Register User</a>
        </div>
    </div>
        
    <!-- USERS TABLE -->
    <table class="table table-sm table-hover table-bordered">
        
        <!-- USERS TABLE HEAD -->
        <thead>
            <tr class="bg-dark text-white">
                <th scope="col">Full Name</th>
                <th scope="col">Account Status</th>
                <th scope="col" class="d-none d-lg-table-cell">Power Consumed</th>
                
                <th scope="col">Power Allowance</th>
                <th scope="col">Action</th>
            </tr>
        </thead>

        <!-- USERS TABLE BODY -->
        <tbody>
            <?php 
                if (mysqli_num_rows($result_user) > 0) {
                    while ($row = mysqli_fetch_assoc($result_user)) { 
            ?>
            <tr>
              
                <td><?=$row['first_name'] . " " .$row['middle_name']. " " .$row['family_name']; ?></td>
                <td><?=$row['acc_status']; ?></td>
                <td class="d-none d-lg-table-cell"><?=$row['p_consumed']; ?></td>
                
                <td class="text-center">
                    <?php if ($row['acc_type'] === 'student') { ?>

                        <form action="update/update_user_allowance.php" method="GET">
                            <input type="hidden" name = "id_number" value = "<?php echo $row['id_number']; ?>">
                            <input type="text" name = "p_consumable" value = " <?=$row['p_consumable']; ?>">
                            <input type="submit" value = "Update">
                        </form>
                       
                    <?php } else if ($row['acc_type'] === 'admin') { ?>
                        <p>N/A for Admin</p>
                    <?php } else { ?>
                        <p>N/A for Faculty</p>
                    <?php } ?>
                </td>
                <td>
                    <?php if ($row['acc_type'] === 'student') { ?>
                        
                        <?php echo "<a class='btn btn-danger btn-sm' onClick=\"javascript: 
                            return confirm('Click OK to delete ".$row['first_name'].".');\" href='delete/delete_user.php?
                            id=".$row['id_number']."'>Remove</a>"; ?>
                    <?php } else {?>
                    <?php 
                        echo "<a class='btn btn-danger btn-sm' onClick=\"javascript: 
                            return confirm('Click OK to delete ".$row['first_name'].".');\" href='delete/delete_user.php?
                            id=".$row['id_number']."'>Remove</a>"; ?>
                    <?php } ?>
                </td>
            </tr>
            <?php }} ?>
        </tbody>
    </table>
</div>
