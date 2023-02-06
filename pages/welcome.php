<?php
session_start();
include "../db_conn.php";
if (!isset($_SESSION['id_number'])) {
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
</head>
<body>
    
    <script>
        $(document).ready(()=>{

        })
        sessionStorage.setItem("user-type", null)
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
                  <div class="center-container">
                      <div class="center-content">
                        <h2>Welcome! Your account is now pending for Admin Approval</h2>
                      </div>
                  </div>
                    
                </div>
            </div>

        </div>
    </main>
    
</body>
</html>

<?php
} else {
  header("Location: ../index.php");
}
?>