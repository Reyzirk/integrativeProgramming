<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of childclasses
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ExaminationDB.php";
if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: examinations.php');
}else{
    $id = $_GET["id"];
    $examDB = new ExaminationDB();
    if (!$examDB->validID($id)){
        $_SESSION["errorLog"] = "noid";
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: examinations2.php');
    }
}

$dataArray = array(
    "StudentID" =>
    array(
        "Title" => "Student ID",
        "Width" => "15%"),
    "StudentName" =>
    array(
        "Title" => "Student Name",
        "Width" => "25%"),
    "Mark" =>
    array(
        "Title" => "Marks",
        "Width" => "15%")
    );

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
    if (!empty($_SESSION["modifyLog"])) {

        if ($_SESSION["modifyLog"] == "assignexamresults") {
            $successMsg = "Assigned new student to the examination.";
        }
        ?>
        <script>
            setTimeout(function (){
                Toast.fire({
                    icon: 'success',
                    html: '<b>Sucessful</b><br/><?php echo $successMsg; ?>.'
                })
            },1500);
        </script>
        <?php
        unset($_SESSION["modifyLog"]);
    }
}
