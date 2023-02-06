<?php
session_start();
include "../db_conn.php";
if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
    <script
  src="https://code.jquery.com/jquery-3.6.3.min.js"
  integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU="
  crossorigin="anonymous"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.css">
  
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.js"></script>

</head>
<body>
    <input type="hidden" id = "user-type-container" value = "<?php echo $_SESSION['acc_type'] ; ?>">
    <script>
        $(document).ready(()=>{
          let userType = $("#user-type-container").val()
          
          sessionStorage.setItem("acc-type", userType)
        })
        
    </script>
    <header>
        <div class="header-content">

        </div>
    </header>
    <main>
        <div class="main-content dashboard">
          <?php
            include 'side-nav.php'
          ?>
            <div class="display-area">
                <div class="display-content">
                <?php
                  include 'activateUsers.php'
                ?>
                <!-- ADMIN -->
                <?php include "admin.php"; ?>

                <!-- FACULTY -->
                <?php include "faculty.php"; ?>

                <!-- STUDENT -->
                <?php include "student.php"; ?>
                </div>
            </div>

        </div>
    </main>

</body>
</html>

<?php
} else {
  header("Location: ../../index.php");
}
?>