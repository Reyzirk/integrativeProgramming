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
require_once dirname(__DIR__)."/Database/ParentDB.php";
$instructorEmail = "";
$password = "";

    //check if user already logged in
    if(isset($_SESSION["parentID"]))
    {
        header("location: announcement.php");
        exit;
    }
    
    //when submit form
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
            //check if user id is empty
        if(empty(trim($_POST["parentEmail"])))
        {
            $instructorEmail_err = "Please enter user email.";
        } else
        {
            $instructorEmail = trim($_POST["parentEmail"]);
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
            
            $db = new ParentDB();
            $parent = $db->login($instructorEmail);
            if ($parent!=null){
                if (password_verify($password, $parent->password)){
                    $_SESSION["parentID"] = $parent->userID;
                    $_SESSION["parentName"] = $parent->name;
                    header("location: announcement.php");
                }else{
                    $login_err = "Invalid email or password.";
                }

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