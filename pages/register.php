<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../css/style.css">
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
                            <form action="../pages/create/create.php" method = "POST" class="signup-form">
                                    <div class="signup-input">
                                        <select name="user_type" id="user_type" class="input">
                                            <option value="faculty">I am a faculty</option>
                                            <option value="student">I am a student</option>
                                        </select>
                                    </div>
                                    <div class="signup-inputs">
                                        <div class="signup-input">
                                            <input type="text" class="first-name" placeholder="First Name" name = "first_name" id = "first_name"/>
                                        </div>
                                        <div class="signup-input">
                                            <input type="text" class="middle-name" placeholder="Middle Name" name = "middle_name" id = "middle_name" />
                                        </div>
                                        <div class="signup-input">
                                            <input type="text" class="family-name" placeholder="Family Name" name = "family_name" id = "family_name"/>
                                        </div>
                                        
                                        <div class="signup-input">
                                            <input type="text" class="id-number" placeholder="ID Number" name = "username" id = "username"/>
                                        </div>
                                        <div class="signup-input">
                                            <input type="password" class="password" placeholder="Password" name = "password" id = "password" />
                                        </div>
                                        <div class="signup-input">
                                            <input type="password" class="confirm-password" placeholder="Confirm Password" name = "repeat_password" id = "repeat_password"/>
                                        </div>
                                        <?php
                                            if(isset($_GET['error'])) {
                                                echo $_GET['error'];
                                            }
                                        ?>
                                        <div class="signup-button-container">
                                            <button style = "border : none;"><div class="register-btn">register</div></button>
                                        </div>
                                        <div class="new-user-question">
                                            <span class="question">Already have an account?</span>
                                            <a href = "../index.php">Login!</a>
                                        </div>
                                    </div>
                                </form>
                                <?php
                                            if(isset($_GET['error'])) {
                                                echo $_GET['error'];
                                            }
                                        ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>