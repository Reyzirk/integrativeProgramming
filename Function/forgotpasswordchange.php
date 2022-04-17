<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * author : Fong Shu Ling
 * 
 */

require_once dirname(__DIR__)."/Objects/Parents.php";
require_once dirname(__DIR__)."/Database/ParentDB.php";
require_once dirname(__DIR__)."/Database/resetPasswordDB.php";

$resetdb = new resetPasswordDB();
if (empty($_GET["email"])){
    header("location: login.php");
}
if (empty($_GET["resetCode"])){
    header("location: login.php");
}
$email = $_GET["email"];
$code = $_GET["resetCode"];
if (!$resetdb->exists($email, $code)){
     header("location: login.php");
}

if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $db = new ParentDB();
    
    if(empty($_POST["newPass"]))
    {
        $newPass_err = "Please enter passowrd";
        $valid = false;
    }else if(!(strlen($_POST["newPass"]) < 60))
    {
        $newPass_err = "Password can not more than 60 characters";
        $valid = false;
    } else 
    {
        $newPass = ($_POST["newPass"]);
    }
    
    if(empty($_POST["confirmPass"]))
    {
        $confirmPass_err = "Please enter your password again";
        $valid = false;
    }else
    {
        $confirmPass = ($_POST["confirmPass"]);
        
        if(empty($newPass_err) && ($newPass != $confirmPass))
        {
            $confirmPass_err = "Password did not match, please re-enter";
            $valid = false;
        }else
        {
            $hashed_password = password_hash($confirmPass, PASSWORD_DEFAULT);
            $db->resetPassword($_GET['email'], $hashed_password);
            $db->delete($email);
            header("location: login.php");
        }
    }
    
    
}

?>
