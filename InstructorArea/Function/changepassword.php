<?php
//Author: Fong Shu Ling
/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/User.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Instructor.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/InstructorDB.php";

if(isset($_POST["formDetect"])){
    $instructorID = $_SESSION["instructorID"]; //$_SESSION["instructorID"]; <----------------------------------Reminder: parent ID session
    
    $storedValue["confirmPass"] = $_POST["confirmPass"];
    $storedValue["newPass"] = $_POST["newPass"];
    $storedValue["currentPass"] = $_POST["currentPass"];
    
    //Check if empty
    if(empty($_POST["confirmPass"])){
        $error["confirmPass"] = "Please enter the confirm password"; 
    }
    
    if(empty($_POST["newPass"])){
        $error["newPass"] = "Please enter the new password"; 
    }
    
    if(empty($_POST["currentPass"])){
        $error["currentPass"] = "Please enter the current password"; 
    }
    
    if(empty($error)){
        $confirmPass = $_POST["confirmPass"];
        $newPass = $_POST["newPass"];
        $currentPass = $_POST["currentPass"];

        //Check if not match
        if($newPass != $confirmPass){
            $error["newPass"] = "Password not match"; 
            $error["confirmPass"] = "Password not match";  
        }else{
            $instructorDB = new InstructorDB();
            
            //Check current password incorrect
            if(!$instructorDB->checkPassword($_SESSION["instructorID"], $currentPass)){
                $error["currentPass"] = "Wrong password";
            }else{
                if($instructorDB->updatePassword($instructorID, $newPass)){
                    $_SESSION["modifyLog"] = "changepassword";
                    header('HTTP/1.1 307 Temporary Redirect');
                    header('Location: parent.php');
                }else{
                    $_SESSION["errorLog"] = "sqlerror";
                }
                
            }
        }
    }
    
   
    
  
}

