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
$instructorID = "";
$password = "";

    session_start();

    //check if user already logged in
    if(isset($_SESSION["login"]) && $_SESSION["login"] == true)
    {
        header("location: index.php");
        exit;
    }
    
    //when submit form
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
            //check if user id is empty
        if(empty(trim($_POST["instructorID"])))
        {
            $instructorID_err = "Please enter user ID.";
        } else
        {
            $instructorID = trim($_POST["instructorID"]);
        }

        //check if password is empty
        if(empty(trim($_POST["password"])))
        {
            $password_err = "Please enter password";
        }else
        {
            $password = trim($_POST("password"));
        }

        //validate users' credentials
        if(empty($instructorID_err) && (empty($password_err)))
        {
            //retrieve data form mySQL
            
            //compare if id and password correct
                    
            //store data into session
            $_SESSION["login"] = 'true';
            $_SESSION["instructorID"] = '$instructorID';
           
            //direct user to homepage
            header("location: index.php");
            
        }else
        {
            //user id or password invalid
            $login_err = "Invalid user ID or password.";
        }
    }
    
?>

<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
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
            
            <h2>Login</h2><br>
            
            <form action="login.php" method="post">
                <?php if(isset($_GET['error']))?>
                
                <div class="login">
                    <label>User ID</label>
                    <input type="instructorID" name="instructorID" class="form-control <?php echo (!empty($instructorID_err)) ? 'is-invalid' : ''; ?>" 
                           value="<?php echo $userID; ?>">
                </div>
                
                <div class="login">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                </div>
                
                <br>
                
                <div class="login">
                    <input type="submit" class="btn btn-primary" value="Login">
                </div>
                
                <p>Do not have an account? <a href="register.php">Register Now!</a></p>  
            </form>
        </div>   
    </body>
</html>