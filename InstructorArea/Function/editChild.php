<?php

/* 
 * =====================================================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * =====================================================================
 * 
 * @author Tang Khai Li
 */

require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Child.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/ChildClass.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ChildDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ChildClassDB.php";

if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: child.php');
} else{
    $id = $_GET["aID"];
    $childDB = new ChildDB();

    if (!empty($getChild)) {
        $storedValue["childID"] = $getChild->childID;
        $storedValue["parentID"] = $getParent->parentID;
        $storedValue["childName"] = $getChild->childName;
        $storedValue["childBirthDate"] = $getChild->childBirthDate;
        $storedValue["childIcNo"] = $getChild->childIcNo;
        $storedValue["childStatus"] = $getChild->childStatus;

    } else {
        $_SESSION["errorLog"] = "noid";
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: parent.php');
    }
}

if (isset($_POST["formDetect"])){
    $inputName = "nameC";
    $inputTitle = "Child Name";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> cannot be empty.";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (strlen($storedValue[$inputName]) > 100) {
            $error[$inputName] = "<b>$inputTitle</b> cannot contain more than 50 characters";
        }
    }
    
    $inputName = "birthDateC";
    $inputTitle = "Child Birth Date";
    if (empty($_POST[$inputName])){
        $error[$inputName] = "<b>$inputTitle</b> cannot empty.";
    }else{
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (DateTime::createFromFormat("Y-m-d", $storedValue[$inputName])==false){
            $error[$inputName] = "<b>$inputTitle</b> invalid type.";
        }
    }
    
    $inputName = "icC";
    $inputTitle = "Child IC No";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> cannot be empty.";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
        if (strlen($storedValue[$inputName]) > 13) {
            $error[$inputName] = "<b>$inputTitle</b> cannot contain more than 12 digits";
        }
    }
    
    $inputName = "statusC";
    $inputTitle = "Child Status";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> is not selected";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
    }
    
    if (empty($error)){
        $newChild = new Child(uniqid("E", true),$storedValue["nameC"],$storedValue["birthDateC"],
                $storedValue["icC"],$storedValue["statusC"]);
        
        $childDB = new ChildDB();
        if ($childDB->insert($newChild)){
            $_SESSION["modifyLog"] = "addChils";
            header('HTTP/1.1 307 Temporary Redirect');
            header('Location: child.php');
        }else{
            $_SESSION["errorLog"] = "sqlerror";
        }
    }
    
}

function eliminateExploit($str) {
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}

