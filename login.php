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
 <?php
    include 'Function/load.php';
    include 'Function/login.php';
 ?>
 
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
            
            <form action="login.php" method="post">
                <?php if(isset($_GET['error']))?>
                
                <div class="login">
                    <label>Email</label>
                    <input type="parentEmail" style="margin-left: 10%" name="parentEmail"<?php echo (!empty($parentEmail_err)) ? 'is-invalid' : ''; ?>" 
                           value="<?php echo $instructorEmail; ?>">
                </div>
                
                <div class="login">
                    <br><label>Password</label>
                    <input type="password" style="margin-left: 2%" name="password" <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                </div>
                
                <br>
                
                <div class="login">
                    <input type="submit" class="btn btn-primary" value="Login" style="margin-left: 35%;">
                </div>
                
                <br><p>Do not have an account? <a href="register.php">Register Now!</a></p>
                <p>Forget your password? <a href="forgotPassword.php">Change Password!</a></p>  
            </form>
        </div>   
    </body>
</html>