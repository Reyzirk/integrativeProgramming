<?php

/* 
 * =====================================================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * =====================================================================
 * 
 * @author Tang Khai Li
 */

require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ParentDB.php";

if (empty($_POST["parentID"])) {
    echo "fail";
} else {
    $id = eliminateExploit($_POST["parentID"]);
    try {
        $parentDB = new ParentDB();

        if ($parentDB == 0 && $parentDB == 0 && $parentDB == 0) {
            if ($parentDB->delete($id)) {
                echo "success";
            } else {
                echo "Unable to find the Parent.";
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