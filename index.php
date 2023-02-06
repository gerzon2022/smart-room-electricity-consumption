<?php
    session_start();
    echo $_SESSION['acc_type'];
    echo $_SESSION['id_number'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <main>
        <div class="main-container">
            <div class="main-content">
                <div class="hero">
                    <div class="split-container">
                        <div class="split-content">
                            <div class="hero-img"></div>
                            <!-- <div class="img-hero-left">
                                <img src="" alt="" class="hero-img">
                            </div> -->
                        </div>
                    </div>
                    
                    <div class="split-container">
                        <div class="split-content">
                            <div class="right">
                                <div class="login-img-container">
                                    <img src="images/cloud-icon.png" alt="" class="img-top">
                                </div>
    
                                <div class="login-content">
                                    <form action="login-check.php" method = "POST" class="login-form">
                                        <div class="login-inputs">
                                            <div class="username-content">
                                                <input class="username" type="text" name = "username" placeholder = "ID Number"/>
                                            </div>
                                            <div class="password-content">
                                                <input type="password" class="password" name = "password" placeholder = "Password">
                                                <a href="#" class="forgot-password">forgot password?</a>
                                            </div>
                                                  <!-- ALERT -->
                                                <?php if (isset($_GET['error'])) { ?>
                                                    <div class="alert alert-danger" role="alert">
                                                        <?php echo $_GET['error']; ?>
                                                    </div>
                                                <?php } ?>
                                                <?php if (isset($_GET['success'])) { ?>
                                                    <div class="alert alert-success" role="alert">
                                                        <?php echo $_GET['success']; ?>
                                                    </div>
                                                <?php } ?>
                                            <div class="login-button-container">
                                                <button class = "submit-btn">
                                                <div class="submit-btn">sign in</div>
                                                </button>
                                            </div>
                                            <div class="new-user-question">
                                                <span class="question">New user?</span>
                                                <a href = "pages/register.php">Register Now!</a>
                                            </div>
                                        </div>
                                    </form>
                                </div> 
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>