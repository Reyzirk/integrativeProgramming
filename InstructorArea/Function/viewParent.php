<?php

/* 
 * =====================================================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * =====================================================================
 * 
 * InstructorArea/Functions/viewParent.php
 * 
 * @author Tang Khai Li
 */

if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: parent.php');
}

require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Parent.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ParentDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/InstructorDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Instructor.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Parent.php";

$parentDB = new ParentDB();
$id = $_GET["id"];

$getParent = $parentDB->details($id);
if (empty($getParent)){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: parent.php');
}
