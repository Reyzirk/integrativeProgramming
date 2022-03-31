<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->

<!--
Registration page
@author Shu Ling
 -->
 
 <?php
 $parentID = "";
 $password = "";
 $confirm_password = "";
 
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
     //check validation of user ID
     if(empty(trim($_POST["parentID"])) )
     {
         $parentID_err = "Please enter user ID.";
     }else if(!preg_match(trim($_POST["$parentID_err"],'/^[a-zA-Z0-9]+$/' )))
     {
         $parentID_err = "User ID only can contain alphametical and numbers. Please re-enter!";
     }
     
     //check validation of password
     if(empty(trim($_POST["password"])))
     {
         $password_err = "Please enter password.";
     }else if(!preg_match(trim($_POST["$password_err"])) < 13)
     {
         $password_err = "Password must have at least 12 character.";
     }else
     {
         $password = trim($_POST["password"]);
     }
     
     //validate confirm password same with password or not
     if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please re-enter the password";     
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($password_err) && ($password != $confirm_password)){
            $confirm_password_err = "Password did not match, please re-enter.";
        }
    }
 }
 ?>
 
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
        <style>
            body
            { 
                font: 14px;
                font-family: sans-serif;
            }
            .wrapper
            { 
                padding-right: 40%; 
                padding-left: 40%; 
                padding-top: 15%;
            }
        </style>
        
        <?php include 'Components/headmeta.php' ?>
    </head>
    <body>
        <div class="wrapper">
            <h2>Registration</h2><br>
            
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <div class="form-group">
                    <label>User ID</label>
                    <input type="text" name="username" class="form-control <?php echo (!empty($parentID_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $parentID; ?>">
                </div>    
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>">
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-primary" value="Submit">
                    <input type="reset" class="btn btn-secondary ml-2" value="Reset">
                </div>
                <p>Already have an account? <a href="login.php">Login here</a>.</p>
            </form>
        </div>    
    </body>
</html>