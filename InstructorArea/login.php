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
    require_once 'Database/InstructorDB.php';
    include 'Function/login.php' 
 ?>
 
<html>
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/login.css" />
        <?php include 'Components/headmeta.php' ?>
    </head>
    <body>
        <div class="wrapper">
            
            <h2>Login</h2><br>
            
            <form action="login.php" method="post">
                <?php if(isset($_GET['error']))?>
                
                <div class="login">
                    <label>User ID</label>
                    <input type="instructorEmail" name="instructorEmail" class="form-control <?php echo (!empty($instructorID_err)) ? 'is-invalid' : ''; ?>" 
                           value="<?php echo $instructorEmail; ?>">
                </div>
                
                <div class="login">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                </div>
                
                <br>
                
                <div class="login">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
                
                <br><p>Forget your password? <a href="#">Change Password!</a></p>  
            </form>
        </div>   
    </body>
</html>