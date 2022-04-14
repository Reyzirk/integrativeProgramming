<?php
//Author: Poh Choo Meng
/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ExaminationDB.php";
if (empty($_POST["examID"])){
    echo "fail";
}else{
    $examid = eliminateExploit($_POST["examID"]);
    try{
        $examdb = new ExaminationDB();
        if ($examdb->validID($examid)){
            echo "success";
        }else{
            echo "Unable to find the examination by using the Exam ID given.";
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