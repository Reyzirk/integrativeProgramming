<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 * 
 * @author Tang Khai Li
 */

if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: childlist.php');
}
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Child.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ChildDB.php";
$id = $_GET["id"];
$childdb = new ChildDB();
$result = $childdb->getChildDetails($id);
if ($result == null){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: childlist.php');
}
