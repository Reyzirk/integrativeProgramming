<?php

/* 
 * =====================================================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * =====================================================================
 * 
 * @author Tang Khai Li
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Parent.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ParentDB.php";

$parentID = "P00001";

if (isset($_POST["formDetect"])){
    $inputName = "nameP";
    $inputTitle = "Parent Name";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> cannot be empty.";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (strlen($storedValue[$inputName]) > 100) {
            $error[$inputName] = "<b>$inputTitle</b> cannot contain more than 50 characters";
        }
    }
    
    $inputName = "genderP";
    $inputTitle = "Gender Parent";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> is not selected";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
    }
    
    $inputName = "birthDateP";
    $inputTitle = "Parent Birth Date";
    if (empty($_POST[$inputName])){
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (DateTime::createFromFormat("Y-m-d", $storedValue[$inputName])==false){
            $error[$inputName] = "<b>$inputTitle</b> invalid type.";
        }
    }
    
    $inputName = "emailP";
    $inputTitle = "Parent Email";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> cannot be empty.";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (strlen($storedValue[$inputName]) > 50) {
            $error[$inputName] = "<b>$inputTitle</b> cannot contain more than 50 characters";
        }
    }
    
    $inputName = "phoneP";
    $inputTitle = "Parent Phone No";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> cannot be empty.";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (strlen($storedValue[$inputName]) > 12) {
            $error[$inputName] = "<b>$inputTitle</b> cannot contain more than 11 digits";
        }
    }
    
    $inputName = "icP";
    $inputTitle = "Parent IC No";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> cannot be empty.";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (strlen($storedValue[$inputName]) > 13) {
            $error[$inputName] = "<b>$inputTitle</b> cannot contain more than 12 digits";
        }
    }
    
    $inputName = "typeP";
    $inputTitle = "Parent Type";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> is not selected";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
    }
    
    if (empty($error)){
        $newParent = new Parent(uniqid("E", true),$storedValue["nameP"],$storedValue["genderP"],
                $storedValue["birthDateP"],$storedValue["phoneP"],$storedValue["icP"],$storedValue["typeP"]);
        
        $parentDB = new ParentDB();
        if ($parentDB->insert($newParent)){
            $_SESSION["modifyLog"] = "addParent";
            header('HTTP/1.1 307 Temporary Redirect');
            header('Location: parent.php');
        }else{
            $_SESSION["errorLog"] = "sqlerror";
        }
    }
    
}

function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
        
