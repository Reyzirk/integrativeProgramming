<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/HomeworkDB.php";

if (empty($_POST["classID"])){
    echo "fail";
}else{
    $id = eliminateExploit($_POST["classID"]);
    try{
        $homeworkdb = new HomeworkDB();
        if ($homeworkdb->deleteWithClass($id)){
            echo "success";
        }else{
            echo "Unable to find the class.";
        }
    } catch (PDOException $ex) {
        if ($generalSection["maintenance"]==true){
            echo $ex->getMessage();
        }else{
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
