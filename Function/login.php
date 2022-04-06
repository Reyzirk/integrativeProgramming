<!DOCTYPE html>
<!--
============================================
Copyright 2022 Omega International Junior School. All Right Reserved.
Web Application is under GNU General Public License v3.0
============================================
-->

<!--
@author Shu Ling
 -->
 
<?php
$instructorEmail = "";
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
        if(empty(trim($_POST["instructorEmail"])))
        {
            $instructorEmail_err = "Please enter user email.";
        } else
        {
            $instructorEmail = trim($_POST["instructorEmail"]);
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
            $_SESSION["instructorEmail"] = '$instructorEmail';
           
            //direct user to homepage
            header("location: index.php");
            
        }else
        {
            //user id or password invalid
            $login_err = "Invalid email or password.";
        }
    }
    
?>