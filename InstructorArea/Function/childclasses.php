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
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ClassDB.php";
if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: classes.php');
}else{
    $id = $_GET["id"];
    $classDB = new ClassDB();
    if (!$classDB->validID($id)){
        $_SESSION["errorLog"] = "noid";
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: classes.php');
    }
}

$dataArray = array(
    "No" =>
    array(
        "Title" => "No",
        "Width" => "10%"),
    "Name" =>
    array(
        "Title" => "Name",
        "Width" => "20%"),
    "ICNo" =>
    array(
        "Title" => "IC No",
        "Width" => "15%"),
    "ParentEmail" =>
    array(
        "Title" => "Parent Email",
        "Width" => "30%"),
    );

function callLog() {
    if (!empty($_SESSION["errorLog"])) {

        if ($_SESSION["errorLog"] == "noid") {
            $errorMsg = "Invalid Homework ID";
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

        if ($_SESSION["modifyLog"] == "assignchildclass") {
            $successMsg = "Assigned new child to the class.";
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
