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
require_once str_replace("InstructorArea", "", str_replace("Demo", "", str_replace("Function", "", dirname(__DIR__)))).'/Database/InstructorDB.php';
$instructorEmail = "";
$password = "";

    //check if user already logged in
    if(isset($_SESSION["instructorID"]))
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
            $password = trim($_POST["password"]);
        }

        //validate users' credentials
        if(empty($instructorEmail_err) && (empty($password_err)))
        {
            
            $db = new InstructorDB();
            $instructor = $db->checkLogin($instructorEmail, $password);
            if ($instructor!=null){
                $_SESSION["instructorID"] = $instructor->userID;
                $_SESSION["instructorName"] = $instructor->name;
                header("location: announcement.php");
                
            }else{
                $login_err = "Invalid email or password.";
            }
            
            
        }else
        {
            //user id or password invalid
            $login_err = "Invalid email or password.";
        }
    }
    
?>