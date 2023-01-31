<?php
if (isset($_SESSION['id'])) {
?>
<nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="dashboard.php">School Info-Sys</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mynavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="mynavbar">
            <ul class="navbar-nav me-auto">
                <!-- Hidden on purpose -->
                <li class="nav-item">
                    <a hidden class="nav-link" href="javascript:void(0)">Link</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link">
                        <script> 
                            document.write(new Date().toDateString()); 
                        </script>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="php/logout.php" class="btn btn-warning">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<?php 
} else { ?>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark mb-5">
        <div class="container-fluid">
            <a class="navbar-brand" href="javascript:void(0)">School Info-Sys</a>
        </div>
    </nav>
<?php
} 
?>