<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of grades backend
 *
 * @author Choo Meng
 */
$dataArray = array(
    "grade" =>
    array(
        "Title" => "Grade",
        "Width" => "15%"),
    "minMark" =>
    array(
        "Title" => "Min Mark",
        "Width" => "35%"),
    "maxMark" =>
    array(
        "Title" => "Max Mark",
        "Width" => "35%"));

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
            },1500);
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
            },1500);
        </script>
        <?php
        unset($_SESSION["modifyLog"]);
    }
}