<?php
  // Connect to the database
  $host = "localhost";
  $user = "username";
  $password = "password";
  $dbname = "database_name";

  $conn = mysqli_connect($host, $user, $password, $dbname);
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }

  // Fetch data every 10 seconds
  while (true) {
    $sql = "SELECT * FROM table_name";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
        print_r($row);
      }
    } else {
      echo "No data found";
    }

    sleep(10);
  }

  // Close the connection
  mysqli_close($conn);
?>
