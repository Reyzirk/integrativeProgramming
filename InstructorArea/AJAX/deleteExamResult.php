<?php
//Author: Poh Choo Meng
/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ExamResultDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/ExamResult.php";
if (empty($_POST["examID"])||empty($_POST["childID"])){
    echo "fail";
}else{
    $examid = eliminateExploit($_POST["examID"]);
    $childid = eliminateExploit($_POST["childID"]);
    $examresult = new ExamResult($examid,$childid,0);
    try{
        $resultdb = new ExamResultDB();
        if ($resultdb->delete($examresult)){
            echo "success";
        }else{
            echo "The child is not assigned to this examination.";
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

