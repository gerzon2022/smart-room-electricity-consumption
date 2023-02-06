
    <div class="content activate-users">
     
        <table id = "myTable">
            <thead>
                <tr>
                    <th>ID Number</th>
                    <th>Account Type</th>
                    <th>RFID Code</th>
                    <th>Firstname</th>
                    <th>Middlename</th>
                    <th>Lastname</th>
                    <th>Consumable</th>
                    <th>Consumed</th>
                    <th>acc_status</th>

                </tr>
            </thead>
            <tbody>
            <?php
             

                $query = "SELECT * FROM tbl_user_info";
                $result = $conn->query($query);
                if (!$result) {
                    die("Query failed: " . $db->error);
                }
                while ($row = $result->fetch_assoc()) {
                ?>
                <tr>
                    <td><?php echo $row['id_number']; ?></td>
                    <td><?php echo $row['acc_type']; ?></td>
                    <td><?php echo $row['rfid_code']; ?></td>
                    <td><?php echo $row['first_name']; ?></td>
                    <td><?php echo $row['middle_name']; ?></td>
                    <td><?php echo $row['family_name']; ?></td>
                    <td><?php echo $row['p_consumable']; ?></td>
                    <td><?php echo $row['p_consumed']; ?></td>
                    <td>
                        <?php  
                        if($row['acc_status'] == null) { ?>

                            <button id = "activate-deactivate" data_id = "<?php echo $row['id_number'];  ?>" data_action = "active" data_text = "Deactivate" >Activate</button>

                        <?php } else if($row['acc_status'] == "active") { ?>
                            
                            <button id = "activate-deactivate" data_id = "<?php echo $row['id_number']; ?>" data_action = "inactive" data_text = "Activate">Deactivate</button>
                            
                        <?php } else {?>

                            <button id = "activate-deactivate" data_id = "<?php echo $row['id_number']; ?>" data_action = "active" data_text = "Deactivate">Activate</button>

                        <?php }?>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                 <tfoot>
            </tfoot>
        </table>
</div>
<script>
  $(document).ready(function() {
    $("#activate-deactivate").click(function() {
      $.ajax({
        url: "process/updateAccStatus.php",
        type: "POST",
        data: {
          id_number: $("#activate-deactivate").attr("data_id"),
          acc_status: $("#activate-deactivate").attr("data_action")
        },
        success: function(response) {
          alert(response);
        }
      });
    });
  });
</script>
<script>
    $(document).ready( function () {
        $('#myTable').DataTable();
    });
    </script>
