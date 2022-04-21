<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
/**
 * Description of examination
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ClassDB.php";
if (empty($_GET["id"])||empty($_GET["cid"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: examinationclasses.php');
}else{
    $id = $_GET["id"];
    $classDB = new ClassDB();
    if (!$classDB->validID($id)){
        $_SESSION["errorLog"] = "noid";
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: examinationclasses.php');
    }else{
        if (!$classDB->access($_SESSION["childID"],$id)){
            $_SESSION["errorLog"] = "noaccess";
            header('HTTP/1.1 307 Temporary Redirect');
            header('Location: examinationclasses.php');
        }
    }
}
$dataArray = array(
    "courseCode" =>
    array(
        "Title" => "Course Code",
        "Width" => "15%"),
    "instructorID" =>
    array(
        "Title" => "Examiner",
        "Width" => "18%"),
    "examStartTime" =>
    array(
        "Title" => "Exam Start Time",
        "Width" => "20%"),
    "examDuration" =>
    array(
        "Title" => "Exam Duration",
        "Width" => "10%"),
    "marks" =>
    array(
        "Title" => "Marks",
        "Width" => "10%"));

function callLog() {
    if (!empty($_SESSION["errorLog"])) {

        if ($_SESSION["errorLog"] == "noid") {
            $errorMsg = "Invalid Examination ID";
        }
        ?>
        <script>
            setTimeout(function (){
                Toast.fire({
                    icon: 'error',
                    html: '<b>Failed</b><br/><?php echo $errorMsg; ?>.'
                })
            },1500);
        </script>
        <?php
        unset($_SESSION["errorLog"]);
    }
    
}
