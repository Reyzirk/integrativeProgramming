<?php
//Author: Poh Choo Meng
/*
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

/**
 * Description of homeworks
 *
 * @author Choo Meng
 */
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ClassDB.php";
if (empty($_GET["id"])){
    $_SESSION["errorLog"] = "noid";
    header('HTTP/1.1 307 Temporary Redirect');
    header('Location: homeworkclasses.php');
}else{
    $id = $_GET["id"];
    $classDB = new ClassDB();
    if (!$classDB->validID($id)){
        $_SESSION["errorLog"] = "noid";
        header('HTTP/1.1 307 Temporary Redirect');
        header('Location: homeworkclasses.php');
    }else{
        if (!$classDB->access($_SESSION["childID"],$id)){
            $_SESSION["errorLog"] = "noaccess";
            header('HTTP/1.1 307 Temporary Redirect');
            header('Location: homeworkclasses.php');
        }
    }
}

$dataArray = array(
    "homeworkID" =>
    array(
        "Title" => "Homework ID",
        "Width" => "15%"),
    "date" =>
    array(
        "Title" => "Date",
        "Width" => "20%"),
    "homeworkDesc" =>
    array(
        "Title" => "Homework",
        "Width" => "50%"));

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
}
