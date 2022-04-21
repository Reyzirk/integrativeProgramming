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

if (empty($_GET["childID"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: parent.php');
} else{
    $id = $_GET["childID"];
    $childDB = new ChildDB();
    $getChild = $childDB->getChildDetails($id);
    
    if ($getChild!=null) {
        $storedValue["childID"] = $getChild->childID;
        $storedValue["parentID"] = $getChild->parentID;
        $storedValue["childStatus"] = $getChild->status;
    } else {
        $_SESSION["errorLog"] = "noid";
        header('Location: parent.php');
    }
}

if (isset($_POST["submitBtn"])){
    $inputName = "childStatus";
    $inputTitle = "Child Status";
    if (empty($_POST[$inputName])) {
        $error[$inputName] = "<b>$inputTitle</b> is not selected";
    } else {
        $storedValue[$inputName] = eliminateExploit($_POST[$inputName]);
    }
    
    if (empty($error)){
        $childDB = new ChildDB();
        $status = $storedValue[$inputName];
        if ($childDB->updateStatus($id,$status)){
            $_SESSION["modifyLog"] = "addChild";
            header('HTTP/1.1 307 Temporary Redirect');
            header('Location: parent.php');
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

