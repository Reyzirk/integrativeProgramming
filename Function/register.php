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
 $parentEmail = "";
 $password = "";
 $confirm_password = "";
 $parentName = "";
 $parentICNo = "";
 
 if($_SERVER["REQUEST_METHOD"] == "POST")
 {
     //check validation of user ID
     if(empty(trim($_POST["parentEmail"])) )
     {
         $parentID_err = "Please enter email.";
     }else if(!preg_match(trim($_POST["$parentEmail_err"],'^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$' )))
     {
         $parentEmail_err = "User email doesn't have the correct format. Please re-enter!";
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
    
    if(empty(trim($_POST["parentPhoneNo"]))){
        $parentPhoneNo_err = "Please re-enter the phone number";
    }else{
        $parentPhoneNo = trim($_POST["parentPhoneNo"]);
    }
    
    //validate IC number
    if(empty(trim($_POST["parentIcNo"]))){
        $parentPhoneNo_err = "Please re-enter the IC number";
    }else{
        $parentPhoneNo = trim($_POST["parentICNo"]);
    }
    
    //validate parent's name
    if(empty(trim($_POST["parentName"]))){
        $parentParentName_err = "Please re-enter your name";
    }else{
        $parentParentName = trim($_POST["parentName"]);
    }
 }
 ?>