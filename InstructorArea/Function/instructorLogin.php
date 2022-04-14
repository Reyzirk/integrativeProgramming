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
require_once dirname(__DIR__)."/../Database/InstructorDB.php";
$email = "";
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
        if(empty(trim($_POST["email"])))
        {
            $email_err = "Please enter user email.";
        } else
        {
            $email = trim($_POST["email"]);
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
        if(empty($instructorID_err) && (empty($password_err)))
        {
            
            $db = new ParentDB();
            $instructor = $db->login($email);
            if ($db!=null){
                if (password_verify($password, $parent->password)){
                    $_SESSION["parentID"] = $parent->userID;
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