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
        "Width" => "18%"),
    "semester" =>
    array(
        "Title" => "Semester",
        "Width" => "10%"),
    "year" =>
    array(
        "Title" => "Year",
        "Width" => "15%"),
    "instructor" =>
    array(
        "Title" => "Instructor",
        "Width" => "35%"),
    "students" =>
    array(
        "Title" => "Students",
        "Width" => "7%"));

function callLog() {
    if (!empty($_SESSION["errorLog"])) {

        if ($_SESSION["errorLog"] == "noid") {
            $errorMsg = "Invalid Grade ID";
        }
        ?>
        <script>
            setTimeout(function (){
                Toast.fire({
                    icon: 'error',
                    html: '<b>Failed</b><br/><?php echo $errorMsg; ?>.'
                })
            },3000);
        </script>
        <?php
        unset($_SESSION["errorLog"]);
    }
    if (!empty($_SESSION["modifyLog"])) {

        if ($_SESSION["modifyLog"] == "creategrade") {
            $successMsg = "Created new grade.";
        }else if ($_SESSION["modifyLog"] == "editgrade") {
            $successMsg = "Edited an existing grade details.";
        }
        ?>
        <script>
            setTimeout(function (){
                Toast.fire({
                    icon: 'success',
                    html: '<b>Sucessful</b><br/><?php echo $successMsg; ?>.'
                })
            },3000);
        </script>
        <?php
        unset($_SESSION["modifyLog"]);
    }
}
