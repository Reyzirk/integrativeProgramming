<?php
//Author: Oon Kheng Huang
/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: courses.php');
}
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/Homework.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/HomeworkDB.php";
$homeworkdb = new HomeworkDB();
$id = $_GET["id"];
$retrievedHomework = $homeworkdb->details($id);
if (empty($retrievedHomework)){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: classes.php');
}
$homeworkDB = new HomeworkDB();
if (!$homeworkDB->access($_SESSION["childID"],$id)){
    $_SESSION["errorLog"] = "noaccess";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: homeworkclasses.php');
}