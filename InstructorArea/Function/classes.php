<?php

/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of classes
 *
 * @author Choo Meng
 */
$dataArray = array(
    "classID" =>
    array(
        "Title" => "Class ID",
        "Width" => "15%"),
    "semester" =>
    array(
        "Title" => "Semester",
        "Width" => "12%"),
    "year" =>
    array(
        "Title" => "Year",
        "Width" => "14%"),
    "instructor" =>
    array(
        "Title" => "Instructor",
        "Width" => "20%"),
    "classDuration" =>
    array(
        "Title" => "Class Duration",
        "Width" => "20%"),
    "students" =>
    array(
        "Title" => "Students",
        "Width" => "80px"));

function callLog() {
    if (!empty($_SESSION["errorLog"])) {

        if ($_SESSION["errorLog"] == "noid") {
            $errorMsg = "Invalid Class ID";
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

        if ($_SESSION["modifyLog"] == "createclass") {
            $successMsg = "Created new class.";
        }else if ($_SESSION["modifyLog"] == "editclass") {
            $successMsg = "Edited an existing class details.";
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
