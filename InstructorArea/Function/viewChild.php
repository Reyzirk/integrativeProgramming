<?php

/* 
 * =====================================================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * =====================================================================
 * 
 * @author Tang Khai Li
 */

if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: parent.php');
}

require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Child.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/ChildClass.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ParentDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/InstructorDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Instructor.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Objects/Parents.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__)) . "/Database/ChildDB.php";

$childDB = new ChildDB();
$id = eliminateExploit($_GET["id"]);
//$id = $_GET["id"];

$getChild = $childDB->getChildList($id);
if (empty($getChild)){
    die();
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: parent.php');
}

function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
