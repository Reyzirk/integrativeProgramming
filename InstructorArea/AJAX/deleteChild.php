<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */

require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ChildDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ChildClassDB.php";

if (empty($_POST["childID"])) {
    echo "fail";
} else {
    $id = eliminateExploit($_POST["childID"]);
    try {
        $childDB = new ChildDB();
        $childClassDB = new ChildClassDB();

        if ($childDB == 0 && $childDB == 0 && $childDB == 0) {
            if ($childDB->delete($id)) {
                echo "success";
            } else {
                echo "Unable to find the Child.";
            }
        } 
    } catch (PDOException $ex) {
        if ($generalSection["maintenance"] == true) {
            echo $ex->getMessage();
        } else {
            callPDOExceptionLog($ex);
        }
    }
}

function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}