<?php

/* 
 * ============================================
 * Copyright 2022 Omega International Junior School. All Right Reserved.
 * Web Application is under GNU General Public License v3.0
 * ============================================
 */
require_once "AJAXErrorHandler.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ExamResultDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Database/ChildDB.php";
require_once str_replace("InstructorArea", "", dirname(__DIR__))."/Objects/ExamResult.php";

if (empty($_POST["childID"])||empty($_POST["examID"])||empty($_POST["mark"])){
    echo "fail";
}else{
    $id = eliminateExploit($_POST["childID"]);
    $examid = eliminateExploit($_POST["examID"]);
    $error = false;
    try{
        if (is_numeric(eliminateExploit($_POST["mark"]))){
            $mark = doubleval(eliminateExploit($_POST["mark"]));
            if ($mark < 0 || $mark > 100){
                echo "<b>Mark</b> must between 0 to 100.";
                $error = true;
            }
        }else{
            echo "<b>Mark</b> must decimal.";
            $error = true;
        }
        
    } catch (Exception $ex) {
        echo "<b>Mark</b> must decimal.";
        $error = true;
    }
    if (!$error){
        try{
            $childdb = new ChildDB();
            if ($childdb->validID($id)){
                $resultdb = new ExamResultDB();
                $examresult = new ExamResult($examid,$id,$mark);
                if ($resultdb->validID($examresult)){
                    $resultdb->update($examresult);
                    echo "success";
                }else{
                    echo "The child not assigned to this examination.";
                    
                }
            }else{
                echo "Unable to find the child by using the child ID given.";
            }
        } catch (PDOException $ex) {
            if ($generalSection["maintenance"]==true){
                echo $ex->getMessage();
            }else{
                callPDOExceptionLog($ex);
            }

        }
    }
    
}
function eliminateExploit($str){
    $str = trim($str);
    $str = stripcslashes($str);
    $str = htmlspecialchars($str);
    return $str;
}
