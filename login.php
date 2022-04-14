 <?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
        
    }
    include_once 'Function/ini_load.php';
    include 'Function/login.php';
 ?>
<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->

<!--
Login page
@author Shu Ling
 -->

 
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/login.css" />
        <?php 
            include 'Components/headmeta.php' 
        ?>
    </head>
    <body>
        <div class="wrapper">
            
            <h2>Login</h2><br>
            
            <form action="login.php" method="post" style="text-align: center;">
                <?php if(isset($_GET['error']))?>
                
                <div class="login">
                    <label>Email</label>
                    <input type="parentEmail" name="parentEmail"<?php echo (!empty($parentEmail_err)) ? 'is-invalid' : ''; ?>" 
                           value="<?php echo $instructorEmail; ?>">
                </div>
                
                <div class="login">
                    <br><label>Password</label>
                    <input type="password" name="password" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                </div>
                
                <br>
                
                <div class="login">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
                
                <br><p>Do not have an account? <a href="register.php">Register Now!</a></p>
                <p>Forget your password? <a href="forgotPassword.php">Change Password!</a></p>  
            </form>
        </div>   
    </body>
</html>