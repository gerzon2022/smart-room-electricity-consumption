<?php
    include '../../db_conn.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        
      
        // Do something with the data here, like insert it into a database
        // Prepare the update statement
        $sql = "UPDATE tbl_user_info SET acc_status = ? WHERE id_number = ?";
        $stmt = $conn->prepare($sql);

        // Bind the parameters
        $id_number = $_POST["id_number"];
        $acc_status = $_POST["acc_status"];

        $stmt->bind_param("ss",  $acc_status, $id_number);

        // Execute the update statement
        if ($stmt->execute()) {
        echo "Record updated successfully";
        } else {
        echo "Error updating record: " . $stmt->error;
        }
      
        echo "Submitted successfully: $acc_status ($id_number)";
      }
?>