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
require_once str_replace("", "", dirname(__DIR__))."/Objects/Instructor.php";
require_once str_replace("", "", dirname(__DIR__))."/Database/InstructorDB.php";

$valid = true;
$_SESSION["login"] = false;

    session_start();
    if(isset($_SESSION["login"])&& $SESSION["login"] == false)
    {
        if($_SERVER["REQUEST_METHOD"] == "POST")
        {
            $db = new ParentDB();
            if(empty($_POST["Email"]))
            {
                $Email_err = "Please enter your email.";
                $valid = false;
            }else if (empty($_POST["password"]))
            {
                $password_err = "Incorrect password, please try again";
                $valid = false;
            }else if ($db.login(trim($_POST["$parentEmail, $password"]))){
                $password_err = "Incorrect Email or Password";
                header("lovation: index.php");
                $_SESSION["login"] = true;
            }
        }
    } else if (isset($_SESSION["login"]) && $SESSION["login"] == true)
        {
            header("location: index.php");
            exit;
        }
 ?>

<!--//$parentEmail = "";
//$password = "";
//
//    session_start();
//
//    $valid = true;
//    //check if user already logged in
//    if(isset($_SESSION["login"]) && $_SESSION["login"] == true)
//    {
//        header("location: index.php");
//        exit;
//    }
//    
//    //when submit form
//    if($_SERVER["REQUEST_METHOD"] == "POST")
//    {
//            //check if user id is empty
//        if(empty(trim($_POST["parentEmail"])))
//        {
//            $instructorEmail_err = "Please enter user email.";
//            $valid = false;
//        } else
//        {
//            $instructorEmail = trim($_POST["parentEmail"]);
//        }
//
//        //check if password is empty
//        if(empty(trim($_POST["password"])))
//        {
//            $password_err = "Please enter password";
//            $valid = false;
//        }else
//        {
//            $password = trim($_POST("password"));
//        }
//
//        //validate users' credentials
//        if(empty($instructorID_err) && (empty($password_err)))
//        {
//            //retrieve data form mySQL
//            
//            //compare if id and password correct
//                    
//            //store data into session
//            $_SESSION["login"] = 'true';
//            $_SESSION["parentEmail"] = '$parentEmail';
//           
//            //direct user to homepage
//            header("location: index.php");
//            
//        }else
//        {
//            //user id or password invalid
//            $login_err = "Invalid email or password.";
//            $valid = false;
//        }
//    }
//    
//?>-->